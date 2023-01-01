<?php

namespace App\Console\Commands;

use App\Models\McqtItem;
use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class SeedQuestionFromSourceIB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'questions:ib';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds questions form IB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $category_paths = Storage::disk('question_data')->directories('ib');

        foreach ($category_paths as $category_path) {
            $this->output->writeln("From $category_path");
            $parts = explode('/', $category_path);
            $category_name = end($parts);
            $category = Category::create([
                'question_source_id' => 2,
                'name' => $category_name,
            ]);

            $subcategory_paths = Storage::disk('question_data')->directories(
                $category_path
            );

            foreach ($subcategory_paths as $subcategory_path) {
                $this->output->writeln("Seeding $subcategory_path");
                $parts = explode('/', $subcategory_path);
                $subcategory_name = end($parts);
                $subcategory = Subcategory::create([
                    'question_category_id' => $category->id,
                    'name' => $subcategory_name,
                ]);

                $files = Storage::disk('question_data')->files($subcategory_path);
                $this->output->progressStart();

                foreach ($files as $file_path) {
                    $rows = SimpleExcelReader::create(
                        storage_path('question_data/' . $file_path)
                    )
                        ->getRows();
                    $rows->each(function ($data) use ($subcategory) {
                        $choices = [];
                        if (filled($data["A"])) {
                            $choices[] = $data["A"];
                        }
                        if (filled($data["B"])) {
                            $choices[] = $data["B"];
                        }
                        if (filled($data["C"])) {
                            $choices[] = $data["C"];
                        }
                        if (filled($data["D"])) {
                            $choices[] = $data["D"];
                        }
                        if (filled($data["E"])) {
                            $choices[] = $data["E"];
                        }
                        $answer = match ($data['answer']) {
                            'A' => 0,
                            'B' => 1,
                            'C' => 2,
                            'D' => 3,
                            'E' => 4,
                        };
                        McqtItem::create([
                            'question_subcategory_id' => $subcategory->id,
                            'question' => $data['question'],
                            'choices' => json_encode($choices),
                            'answer' => $answer,
                            'explanation' => $data['explanation'] ?? null
                        ]);
                        $this->output->progressAdvance();
                    });
                }
                $this->output->writeln("Done");
                $this->output->writeln("");
            }
        }
        return Command::SUCCESS;
    }
}
