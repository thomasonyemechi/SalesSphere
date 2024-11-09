<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnSummary extends Model
{
    use HasFactory;

    protected $guarded;

    function returns()
    {
        return $this->hasMany(ItemReturn::class, 'summary_id');
    }
}
