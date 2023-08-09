<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $entry_weight = DB::table('entry')->select(DB::raw('select * SUM(weight) as weight_sum'))->get();
        return response()->json([
            'entry' => $entry_weight
        ]);
    }
}
