<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqtItem extends Model
{
    use HasFactory;

    protected $casts = [
        'choices' => 'array',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
