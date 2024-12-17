<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/load_product', [TestController::class, 'loadProduct']);



Route::get('/login', function () {
    if (auth()->user()) {
        return redirect('/pos?trno=' . rand(111111111, 99999999999))->with('success', 'You are already logged in');
    }
    return view('login');
})->name('login');


Route::get('/items', [ItemController::class, 'getItems']);
Route::get('/search', [ItemController::class, 'searchItem']);
Route::get('/get_hours', [StaffController::class, 'modifyHours']);
Route::post('/search_product', [ItemController::class, 'productSearch']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/receipt/{trno}', [PosController::class, 'printReceipt']);



Route::group(['middleware' => ['auth']], function () {


    Route::post('/upload-excel', [ExcelImportController::class, 'importItems']);
    Route::get('/pos', [PosController::class, 'posIndex']);
    Route::get('/get_sales/{sales_id}', [PosController::class, 'getSales']);


    Route::post('/make_sales', [SalesController::class, 'makeSales']);
    Route::post('/return_items', [SalesController::class, 'returnItem']);
    Route::get('/purchasing', [SalesController::class, 'purchasingIndex']);
    Route::get('/today_sales/{id?}/{date?}', [SalesController::class, 'todaySales']);

    Route::group(['prefix' => 'item'], function () {
        Route::get('/add', [ItemController::class, 'addItemIndex']);
        Route::post('/add', [ItemController::class, 'addItem']);
        Route::post('/update', [ItemController::class, 'updateItem']);
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/add', [CategoryController::class, 'index']);
        Route::post('/add', [CategoryController::class, 'addCategory']);
    });





    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
        Route::get('/dashboard', [AdminController::class, 'renderIndex']);
        Route::get('/get_expense_graph_info', [AdminController::class, 'getExpenseGraphInfo']);


        Route::get('/add_staff', [StaffController::class, 'createStaffIndex']);
        Route::get('/staffs', [StaffController::class, 'viewAllStaff']);
        Route::post('/add_staff', [StaffController::class, 'createStaff']);



        Route::get('/expenses-overview', [ExpensesController::class, 'expensesIndex']);
        Route::get('/expenses-add', [ExpensesController::class, 'addIndex']);
        Route::post('/create-expenses-category', [ExpensesController::class, 'addExpensesCategory']);
        Route::post('/create-expenses', [ExpensesController::class, 'createExpense']);
        Route::get('/delete_expenses_category/{id}', [ExpensesController::class, 'deleExpenseCategory']);

        Route::get('/stock-profile/{item?}', [ItemController::class, 'adminStockProfile']);


        Route::get('/staff/{id}', [StaffController::class, 'staffProfileIndex']);
        Route::get('/today-sales', [AdminController::class, 'todaySalesIndex']);




        Route::group(['prefix' => 'stock'], function () {
            Route::get('/restock', [StockController::class, 'restockIndex']);
            Route::get('/delete/{restock_summary}', [StockController::class, 'deleteRestock']);
            Route::post('/restock', [StockController::class, 'restockItem']);
        });


        Route::get('/restock-history/{date?}', [StockController::class, 'restockHistoryIndex']);
    });
});
