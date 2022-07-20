<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqtCategory extends Model
{
    use HasFactory;

    public function mcqt_items()
    {
        return $this->hasMany(McqtItem::class);
    }
}
