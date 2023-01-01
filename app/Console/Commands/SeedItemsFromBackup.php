<?php

namespace App\Console\Commands;

use App\Models\Source;
use App\Models\Category;
use App\Models\McqtItem;
use App\Models\Subcategory;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class SeedItemsFromBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed backed up items after refactoring';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rows = SimpleExcelReader::create(storage_path('backup/sources.csv'))->getRows();

        $rows->each(function ($data) {
            Source::create([
                'id' => $data['id'],
                'name' => $data['name'],
            ]);
        });

        $rows = SimpleExcelReader::create(storage_path('backup/categories.csv'))->getRows();

        $rows->each(function ($data) {
            Category::create([
                'id' => $data['id'],
                'source_id' => $data['question_source_id'],
                'name' => $data['name'],
            ]);
        });

        $rows = SimpleExcelReader::create(storage_path('backup/subcategories.csv'))->getRows();

        $rows->each(function ($data) {
            Subcategory::create([
                'id' => $data['id'],
                'category_id' => $data['question_category_id'],
                'name' => $data['name'],
            ]);
        });

        $rows = SimpleExcelReader::create(storage_path('backup/mcqt_items.csv'))->getRows();

        $rows->each(function ($data) {
            McqtItem::create([
                'id' => $data['id'],
                'subcategory_id' => $data['question_subcategory_id'],
                'question' => $data['question'],
                'choices' => json_decode($data['choices']),
                'answer' => $data['answer'],
                'explanation' => $data['explanation'],
            ]);
        });
        return Command::SUCCESS;
    }
}
