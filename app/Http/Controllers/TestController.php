<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Faker\Factory as Faker;


class TestController extends Controller
{
    function loadProduct()
    {
        $faker = Faker::create();
        foreach (range(1, 200) as $index) {

            $word = $faker->word;
            $count = Item::where(['name' => $word])->count();

            if($count == 0) {
                Item::create([
                'category_id' => 1,
                'name' => $word,
                'price' => $faker->numberBetween($min = 10, $max = 100000),
                'description' => $faker->paragraph($nb = 2)
            ]);
            }

            
        }

        return 'done';
    }
}
