<?php

namespace App\Http\Controllers;

use App\Imports\ItemImport;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    public function importItems(Request $request)
    {
        // Validate the uploaded file
        Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls',
        ])->validate();



        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file

        Excel::import(new ItemImport, $file);



        return back()->with('success', 'Items imported successfully!');
    }
}
