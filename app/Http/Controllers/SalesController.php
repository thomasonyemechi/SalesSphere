<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Item;
use App\Models\ItemReturn;
use App\Models\returnSummary;
use App\Models\Sales;
use App\Models\SalesSummary;
use App\Models\Stock;
use Illuminate\Http\Request;

class SalesController extends StockController
{



    function makeSales(Request $request)
    {
        $customer_id = $this->updateOrCreateClient($request->customer_phone);


        $summary = SalesSummary::create([
            'customer_id' => $customer_id,
            'total' => 0,
            'user_id' => auth()->user()->id,
            'payment_mode' => $request->mode
        ]);



        $cart_total = 0;


        if ($request->delete_id > 0) {
            ///////deleting sales if exist
            $sales_summary = SalesSummary::with(['sales'])->find($request->delete_id);
            if ($sales_summary) {
                foreach ($sales_summary->sales as $sale) {
                    Stock::where(['action' => 'sales', 'summary_id' => $sale->id])->delete();
                    Sales::where('id', $sale->id)->delete();
                }
                $sales_summary->delete();
            }
        }

        foreach ($request->items as $item) {
            $price = $item['price'];
            $item_id = $item['id'];
            $qty = $item['qty'];
            $item_total = ($price * $qty);

            $cart_total += $item_total;


            $res = Sales::create([
                'summary_id' => $summary->id,
                'item_id' => $item_id,
                'quantity' => $qty,
                'price' => $price
            ]);

            // updatePrice =
            Item::where('id', $item_id)->update([
                'price' => $price
            ]);


            Stock::create([
                'item_id' => $item_id,
                'customer_id' => $customer_id,
                'summary_id' => $res->id,
                'price' => $price,
                'quantity' => -$qty,
                'total' => $item_total,
                'action' => 'sales',
                'user_id' => auth()->user()->id
            ]);
        }



        $summary->update([
            'total' => $cart_total
        ]);

        return response([
            'message' => 'Sales has been logged',
            'sales_id' => $summary->id,
            'status' => true
        ]);
    }



    function updateOrCreateClient($phone)
    {
        $client = Client::updateOrCreate([
            'phone' => $phone
        ]);

        return $client->id;
    }


    function todaySales(Request $request, $id = 0, $date = '')
    {
        $id = ($id) ? $id : auth()->user()->id;

        $date = isset($request->date) ? $request->date : '';
        $day = ($date) ? date('Y-m-d', strtotime($date)) : date('Y-m-d');


        $total_sales = SalesSummary::where(['user_id' => $id])->where('created_at', 'like', "%$day%")->count();
        $amount = SalesSummary::where(['user_id' => $id])->where('created_at', 'like', "%$day%")->sum('total');
        $sales = SalesSummary::with(['sales', 'customer'])->where('created_at', 'like', "%$day%")->orderBy('id', 'desc')->paginate(25);
        $returns = returnSummary::with(['returns'])->where('created_at', 'like', "%$day%")->orderBy('id', 'desc')->paginate(25);

        return view('pos.today_sales', compact(['total_sales', 'amount', 'sales', 'day', 'returns']));
    }


    function purchasingIndex()
    {
        return view('pos.purchasing');
    }



    function returnItem(Request $request)
    {

        $customer_id = $this->updateOrCreateClient($request->customer_phone);


        $summary = returnSummary::create([
            'customer_id' => $customer_id,
            'total' => 0,
            'user_id' => auth()->user()->id
        ]);
        $cart_total = 0;

        foreach ($request->items as $item) {
            $price = $item['price'];
            $item_id = $item['id'];
            $qty = $item['qty'];
            $item_total = ($price * $qty);

            $cart_total += $item_total;


            $res = ItemReturn::create([
                'summary_id' => $summary->id,
                'item_id' => $item_id,
                'quantity' => $qty,
                'price' => $price
            ]);


            Stock::create([
                'item_id' => $item_id,
                'customer_id' => $customer_id,
                'summary_id' => $res->id,
                'price' => $price,
                'quantity' => $qty,
                'total' => $item_total,
                'action' => 'return',
                'user_id' => auth()->user()->id
            ]);
        }

        $summary->update([
            'total' => $cart_total
        ]);

        return response([
            'message' => 'Items has been returned',
            'sales_id' => $summary->id,
            'status' => true
        ]);
    }
}
