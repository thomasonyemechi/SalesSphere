<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToModel;

class ItemImport implements ToModel
{
    public function model(array $collection)
    {
        // Define how to create a model from the Excel row data
        $name = $collection[0];
        $check = Item::where(['name' => $name])->count();
        if ($check == 0) {
            $price = is_int($collection[2]) ? $collection[2] : 0 ;
            return new Item([
                'name' => $name,
                'brand' => $collection[1],
                'price' => $price,
                'category_id' => 1
            ]);
        }
    }
}
