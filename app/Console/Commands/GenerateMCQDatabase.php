<?php

namespace App\Console\Commands;

use League\Csv\Reader;
use App\Models\McqtItem;
use League\Csv\Statement;
use App\Models\McqtCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateMCQDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mcqt:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate MCQT database from the testbank files.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Generating MCQT database...');
        $this->newLine();
        $this->generate();
        return 0;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function generate()
    {
        $this->call('migrate:fresh');

        $categories = collect(Storage::disk('testbanks')->directories())->sort();

        foreach ($categories as $key => $category) {
            $category_files = Storage::disk('testbanks')->files($category);
            $mcqt_category = McqtCategory::create([
                'name' => basename($category),
            ]);
            $this->info(basename($category));
            foreach ($category_files as $index => $file) {
                try {
                    $csv = Reader::createFromPath(storage_path('app/banks_categorized/' . $file));
                    $csv->setHeaderOffset(0);
                } catch (Exception $e) {
                    echo $e->getMessage(), PHP_EOL;
                }
                $stmt = Statement::create();
                $records = $stmt->process($csv);

                $this->info(basename($file));
                $bar = $this->output->createProgressBar(count($records));
                $bar->start();


                foreach ($records as $record) {
                    $choices = collect([
                        $this->sanitize($record['A']),
                        $this->sanitize($record['B']),
                        $this->sanitize($record['C']),
                        $this->sanitize($record['D']),
                    ]);
                    $matches = [];
                    if (preg_match('/Figure [\d+](\.[\d+])?/i', $record['Question']) || preg_match('/Figure [\d+](\.[\d+])?/i', $record['A']) || preg_match('/Figure [\d+](\.[\d+])?/i', $record['B']) || preg_match('/Figure [\d+](\.[\d+])?/i', $record['C']) || preg_match('/Figure [\d+](\.[\d+])?/i', $record['D'])) {
                        continue;
                    }

                    if (preg_match('/<img/i', $record['Question']) || preg_match('/<img/i', $record['A']) || preg_match('/<img/i', $record['B']) || preg_match('/<img/i', $record['C']) || preg_match('/<img/i', $record['D'])) {
                        continue;
                    }
                    preg_match('/(option a|option b|option c|option d)/', $this->sanitize(strtolower($record['Answer'])), $matches);
                    try {
                        McqtItem::create([
                            'mcqt_category_id' => $mcqt_category->id,
                            'question' => $this->sanitize($record['Question']),
                            'choices' => $choices,
                            'answer' => match ($matches[0]) {
                                'option a' => 0,
                                'option b' => 1,
                                'option c' => 2,
                                'option d' => 3,
                            },
                        ]);
                    } catch (\Throwable $th) {
                        info(basename($file));
                        info($this->sanitize($record['Answer']));
                    }
                    $bar->advance();
                }
                $bar->finish();
                $this->newLine(2);
            }
            $this->newLine(2);
        }
    }

    public function sanitize($string)
    {
        $string = str_replace(['<span lang="EN-US">', '</span>', '<span lang=\"EN-US\">', '<span style="text-decoration: underline;">'], "", $string);
        $string = htmlentities($string, null, 'utf-8');
        $content = str_replace("&nbsp;", "", $string);
        $content = html_entity_decode($content);
        return trim(preg_replace('/^(\()?[a-z0-9]+(\.|\))+?/mi', '', $content));
    }
}
