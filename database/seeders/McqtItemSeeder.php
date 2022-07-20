<?php

namespace Database\Seeders;

use App\Models\McqtCategory;
use App\Models\McqtItem;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class McqtItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(Storage::disk('testbanks')->directories())->sort();

        foreach ($categories as $key => $category) {
            $category_files = Storage::disk('testbanks')->files($category);
            $mcqt_category = McqtCategory::create([
                'name' => basename($category),
            ]);
            foreach ($category_files as $index => $file) {
                try {
                    $csv = Reader::createFromPath(storage_path('app/banks_categorized/' . $file));
                    $csv->setHeaderOffset(0);
                } catch (Exception $e) {
                    echo $e->getMessage(), PHP_EOL;
                }
                $stmt = Statement::create();
                $records = $stmt->process($csv);
                foreach ($records as $key => $record) {
                    $choices = collect([
                        $this->sanitize($record['A']),
                        $this->sanitize($record['B']),
                        $this->sanitize($record['C']),
                        $this->sanitize($record['D']),
                    ]);
                    McqtItem::create([
                        'mcqt_category_id' => $mcqt_category->id,
                        'question' => $this->sanitize($record['Question']),
                        'choices' => $choices,
                        'answer' => match ($this->sanitize($record['Answer'])) {
                            'Option A' => 0,
                            'Option B' => 1,
                            'Option C' => 2,
                            'Option D' => 3,
                        },
                    ]);
                }
            }
        }
    }

    public function sanitize($string)
    {
        $string = htmlentities($string, null, 'utf-8');
        $content = str_replace("&nbsp;", "", $string);
        $content = html_entity_decode($content);
        return trim(preg_replace('/^(\()?[a-z0-9]+(\.|\))+? /mi', '', $content));
    }
}
