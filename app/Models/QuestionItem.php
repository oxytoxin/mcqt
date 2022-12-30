<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionItem extends Model
{
    use HasFactory;

    protected $casts = [
        'choices' => 'array',
    ];

    public function question_subcategory()
    {
        return $this->belongsTo(QuestionSubcategory::class);
    }
}
