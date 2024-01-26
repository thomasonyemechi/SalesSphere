<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description'
    ];


    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function expenses()
    {
        return $this->hasMany(Expenses::class, 'expenses_category_id');
    }

}
