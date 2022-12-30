<?php

namespace Database\Seeders;

use App\Models\QuestionSource;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuestionSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionSource::create([
            'name' => 'Source 1'
        ]);
        QuestionSource::create([
            'name' => 'Source 2'
        ]);
    }
}
