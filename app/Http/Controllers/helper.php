<?php

use App\Models\Stock;

function def()
{
    return true;
}


function money($money)
{
    return '$ ' . number_format($money, 2);
}

function itemQty($id)
{
    return Stock::where(['item_id' => $id])->sum('quantity');
}

