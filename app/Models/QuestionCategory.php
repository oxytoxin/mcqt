<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;

    public function question_source()
    {
        return $this->belongsTo(QuestionSource::class);
    }

    public function question_subcategories()
    {
        return $this->hasMany(QuestionSubcategory::class);
    }
}
