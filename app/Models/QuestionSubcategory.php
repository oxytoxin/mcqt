<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSubcategory extends Model
{
    use HasFactory;

    public function question_category()
    {
        return $this->belongsTo(QuestionCategory::class);
    }

    public function question_items()
    {
        return $this->hasMany(QuestionItem::class);
    }
}
