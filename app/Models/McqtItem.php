<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqtItem extends Model
{
    use HasFactory;

    protected $casts = [
        'choices' => AsArrayObject::class,
    ];

    public function mcqt_category()
    {
        return $this->belongsTo(McqtCategory::class);
    }
}
