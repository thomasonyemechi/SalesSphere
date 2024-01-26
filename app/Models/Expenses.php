<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'remark', 'expenses_category_id'
    ];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function category()
    {
        return $this->belongsTo(ExpensesCategory::class, 'expenses_category_id');
    }



    
}
