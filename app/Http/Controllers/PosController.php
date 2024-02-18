<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\SalesSummary;
use Illuminate\Http\Request;

class PosController extends Controller
{
    


    public function printReceipt($trno)
    {
        $sales_summary = SalesSummary::with(['customer', 'sales'])->findorfail($trno);
        $org = Organization::first();
        return view('receipt', compact(['trno', 'sales_summary', 'org']));
    }
}
