<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemReturn extends Model
{
    use HasFactory;
    protected $guarded;

    function item()
    {
        return $this->belongsTo(Item::class);
    }
}
