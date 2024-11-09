<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Restock;
use App\Models\RestockSummary;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    function restockIndex()
    {
        // return view('admin.re_stock');
    }


    function restockHistoryIndex(Request $request, $date='')
    {
        $date = isset($request->date) ? $request->date : '';
        $day = ($date) ? date('Y-m-d', strtotime($date)) : date('Y-m-d');
        $total_restock = RestockSummary::where('created_at', 'like', "%$day%")->count();
        $amount = RestockSummary::where('created_at', 'like', "%$day%")->sum('total');
        $restocks = RestockSummary::with(['restocks', 'supplier'])->where('created_at', 'like', "%$day%")->orderBy('id', 'desc')->paginate(25);

        return view('admin.restock_history', compact(['day', 'total_restock', 'amount', 'restocks']));
    }


    function deleteRestock($restock_summary)
    {

        // return $restock_summary;

        $restock_summary = RestockSummary::with(['restocks'])->find($restock_summary);
        if ($restock_summary) {
            foreach ($restock_summary->restocks as $restock) {
                Stock::where(['action' => 'restock', 'summary_id' => $restock->id])->delete();
                Restock::where('id', $restock->id)->delete();
            }
            $restock_summary->delete();
        } 


        return back()->with('success', 'Restock has been deleted and stock quantity has been updated');
    }


    function restockItem(Request $request)
    {


        $supplier_id = $this->updateOrCreateSupplier($request->customer_phone);


        $summary = RestockSummary::create([
            'supplier_id' => $supplier_id,
            'total' => 0,
            'amount_paid' => 0,
            'payment_mode' => $request->mode
        ]);


        $cart_total = 0;

        foreach ($request->items as $item) {
            $price = $item['price'];
            $item_id = $item['id'];
            $qty = $item['qty'];
            $item_total = ($price * $qty);

            $cart_total += $item_total;


            $res = Restock::create([
                'summary_id' => $summary->id,
                'item_id' => $item_id,
                'quantity' => $qty,
                'price' => $price
            ]);



            Item::where('id', $item_id)->update([
                'price' => $price
            ]);



            Stock::create([
                'item_id' => $item_id,
                'customer_id' => $supplier_id,
                'summary_id' => $res->id,
                'price' => $price,
                'quantity' => $qty,
                'total' => $item_total,
                'action' => 'restock',
                'user_id' => auth()->user()->id
            ]);
        }

        $summary->update([
            'total' => $cart_total
        ]);

        return response([
            'message' => 'Restock completed',
            'sales_id' => $summary->id,
            'status' => true
        ]);
    }



    function updateOrCreateSupplier($phone)
    {
        $sup = Supplier::updateOrCreate([
            'phone' => $phone
        ]);

        return $sup->id;
    }
}
