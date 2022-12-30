<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSource extends Model
{
    use HasFactory;

    public function question_categories()
    {
        return $this->hasMany(QuestionCategory::class);
    }
}
