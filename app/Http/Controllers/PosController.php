<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Sales;
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


    public function posIndex(Request $request)
    {
        if (!$request->trno) {
            return redirect('/pos?trno=' . rand(111111111, 99999999999999));
        }

        $sales_id = 0;

        if ($request->sales_id) {
            $sales_id = $request->sales_id;
        }

        return view('pos.pos', compact(['sales_id']));
    }


    function getSales($sales_id)
    {
        $sales_summary = SalesSummary::find($sales_id);
        $sales = Sales::with(['item'])->where(['summary_id' => $sales_summary->id])->get();

        foreach($sales as $sale) {
            $sale->item->stock_qty = itemQty($sale->item->id);
        }

        return response([
            'sumary' => $sales_summary,
            'sales' => $sales
        ]);
    }
}
