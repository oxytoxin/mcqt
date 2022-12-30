<?php

namespace App\Console\Commands;

use App\Models\QuestionItem;
use Illuminate\Console\Command;
use App\Models\QuestionCategory;
use App\Models\QuestionSubcategory;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class SeedQuestionFromSourcePB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'questions:pb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds questions from PB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $category_paths = Storage::disk('question_data')->directories('pb');
        foreach ($category_paths as $category_path) {
            $this->output->writeln("From $category_path");
            $parts = explode('/', $category_path);
            $category_name = end($parts);
            $category = QuestionCategory::create([
                'question_source_id' => 1,
                'name' => $category_name,
            ]);

            $subcategory_paths = Storage::disk('question_data')->files($category_path);
            foreach ($subcategory_paths as $subcategory_path) {
                $this->output->writeln("Seeding $subcategory_path");

                $parts = explode('/', $subcategory_path);
                $subcategory_name = end($parts);
                $subcategory = QuestionSubcategory::create([
                    'question_category_id' => $category->id,
                    'name' => str_replace(".csv", "", $subcategory_name),
                ]);
                $rows = SimpleExcelReader::create(
                    storage_path('question_data/' . $subcategory_path)
                )
                    ->getRows();
                $this->output->progressStart();
                $rows->each(function ($data) use ($subcategory) {
                    QuestionItem::create([
                        'question_subcategory_id' => $subcategory->id,
                        'question' => $data['question'],
                        'choices' => $data['choices'],
                        'answer' => $data['answer'],
                        'explanation' => $data['explanation'] ?? null,
                    ]);
                    $this->output->progressAdvance();
                });
                $this->output->writeln("Done");
                $this->output->writeln("");
            }
        }
        return Command::SUCCESS;
    }
}
