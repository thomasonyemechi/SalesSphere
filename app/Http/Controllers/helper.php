<?php

use App\Models\Stock;

function def()
{
    return true;
}


function money($money)
{
    return '₦ ' . number_format($money);
}

function itemQty($id)
{
    return Stock::where(['item_id' => $id])->sum('quantity');
}


function itemAction($action)
{
    $bg = '';

    if($action == 'sales') {
        $bg = 'bg-success';
    }else if($action == 'return') {
        $bg = 'bg-danger';
    }else if($action == 'restock') {
        $bg = 'bg-primary';
    }



    return $bg;
}


function formatDate($date)
{
    return date('j M Y | h:i a', strtotime($date));
}