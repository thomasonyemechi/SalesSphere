<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesSummary extends Model
{
    use HasFactory;
    protected $guarded;

    function customer()
    {
        return $this->belongsTo(Client::class, 'customer_id');
    }


    function sales()
    {
        return $this->hasMany(Sales::class, 'summary_id');
    }

}
