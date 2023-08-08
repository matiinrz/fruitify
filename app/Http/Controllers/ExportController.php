<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{

    public function index(Request $request)
    {
        ini_set('memory_limit', '4096M');
        ini_set('post_max_size', '210M');
        set_time_limit(3600);
        $export = $request->input('export');
        $date = now()->format('Y-m-d H:i:s');
        $path = "exports/" . class_basename($export) . " $date.xlsx";
        $excel = Excel::store(new $export(collect($request->input('arguments'))), $path, 'local');
        return response()->json(['path' => $path, 'excel' => $excel]);
    }
}
