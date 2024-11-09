<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Expenses;
use App\Models\ExpensesCategory;
use App\Models\Login;
use App\Models\Restock;
use App\Models\Sales;
use App\Models\SalesSummary;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Faker\Factory as Faker;


class AdminController extends Controller
{
    function renderIndex(Request $request)
    {

        $date = ($request->date) ? $request->date : date('F');
        $month = date('Y-m-d', strtotime($date));
        $mth = date('m', strtotime($month));
        $first_day = date("Y-m-d", strtotime(date("Y-m-d", strtotime($month)) . ", first day of this month"));
        $last_day =  date("Y-m-d", strtotime(date("Y-m-d", strtotime($month)) . ", last day of this month"));

        $restock_total = Restock::whereBetween('created_at', [$first_day, $last_day])->sum('price');
        $restock_count = Restock::whereBetween('created_at', [$first_day, $last_day])->count();
        // sales info
        $sales_total = Sales::whereBetween('created_at', [$first_day, $last_day])->sum('price');
        $sales_count = Sales::whereBetween('created_at', [$first_day, $last_day])->count();

        $expense_total = Expenses::whereBetween('created_at', [$first_day, $last_day])->sum('amount');

        $expense_categories = ExpensesCategory::count();
        $clients = Client::count();
        $suppliers = Supplier::count();

        $sales_history = SalesSummary::with(['sales'])->orderby('id','desc')->limit(15)->get();
        $logins = Login::with(['staff:id,name'])->orderby('id', 'desc')->limit(10)->get();

        return view('admin.index', compact([
            'expense_total', 'first_day', 'last_day', 'restock_total', 'restock_count', 'sales_history',
            'sales_total', 'sales_count', 'expense_categories', 'clients', 'suppliers', 'mth', 'logins',
        ]));
    }


    function todaySalesIndex(Request $request)
    {
        // $sales = Sales
        return view('admin.today_sales');
    }


    function getExpenseGraphInfo(Request $request)
    {
        
        $expense_months = [];
        $expense_totals = [];
        $colors = []; $faker = Faker::create();
        for($i = 1; $i<= date('m'); $i++) {
            $expense_months[] = $monthName = date('F', mktime(0, 0, 0, $i, 10));
            $from = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d', mktime(0, 0, 0, $i, 10)))) . ", first day of this month"));
            $to =  date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('F', mktime(0, 0, 0, $i, 10)))) . ", last day of this month"));
            $expense_totals[] = Expenses::whereBetween('created_at', [$from, $to])->sum('amount');
            $colors[] = $faker->hexColor();
        }

        $expense_chart = [
            'month' => $expense_months,
            'expense' => $expense_totals,
            'color' => $colors
        ];

        return response([
            'data' => $expense_chart
        ]);
    }
}
