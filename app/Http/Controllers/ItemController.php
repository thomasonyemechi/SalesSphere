<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Restock;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    function productSearch(Request $request)
    {
        return redirect('/item/add?search=' . $request->search_product);
    }

    function addItemIndex(Request $request)
    {

        if ($request->search) {
            $items = Item::where('name', 'like', "%$request->search%")->paginate(25);
        } else {
            $items = Item::orderby('id', 'desc')->paginate(25);
        }

        $categories = Category::get();
        return view('pos.add_item', compact(['items', 'categories']));
    }


    function searchItem(Request $request)
    {
        $items = Item::where('name', 'like', "%$request->s%")->limit(20)->get(['name', 'price', 'id']);
        foreach ($items as $item) {
            $item['quantity'] = itemQty($item->id);
        }
        return response($items);
    }


    function getItems()
    {
        $items = Item::get(['id', 'name', 'price']);
        return response([
            'results' => $items
        ]);
    }


    public function addItem(Request $request)
    {
        Validator::make($request->all(), [
            'category_id' => 'integer|required|exists:categories,id',
            'name' => 'string|min:3|required',
            'price' => 'integer|required|min:10',
            'description' => '',
            'brand' => 'string'
        ])->validate();

        $check  = Item::where(['name' => $request->name, 'brand' => $request->brand])->count();

        if ($check > 0) {
            return back()->withInput($request->input())->with('error', 'Duplicate item');
        }

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'brand' => $request->brand
        ]);

        return back()->with('success', 'Item has been added successfuly');
    }


    function updateItemPrice(Request $request)
    {

        Item::where('id', $request->id)->update([
            'price' => $request->price
        ]);

        return back()->with('success', 'Item price has been changed');
    }


    function updateItem(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'integer|required|exists:items,id',
            'name' => 'string|min:3|required',
            'price' => 'integer|required|min:10',
            'description' => 'string',
        ])->validate();

        Item::where('id', $request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'brand' => $request->brand
        ]);
        return back()->with('success', 'Item info has been updated');
    }




    function adminStockProfile(Request $request, $item)
    {
        $item = Item::findorfail($item);

        $item->quantity = itemQty($item->id);


        $recent_sales = Sales::where(['item_id' => $item->id])->orderby('id', 'desc')->limit(10)->get();
        $restock_histories = Restock::where(['item_id' => $item->id])->orderby('id', 'desc')->limit(10)->get();

        return view('admin.item_profile', compact(['item', 'restock_histories', 'recent_sales']));
    }
}
