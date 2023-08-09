<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
//        $entry_weight = Entry::query()->get()->groupBy('fruit_id');
        $entry_weight = DB::table('fruit')
            ->select('fruit.name', 'A.weight')
            ->join(DB::raw('(select fruit_id, SUM(weight) as weight
             from entry group by fruit_id ORDER BY SUM(weight) DESC
             limit 10) A'), 'fruit.id', '=', 'A.fruit_id')
            ->get();

        $egress_weight = DB::table('fruit')
            ->select('fruit.name', 'A.weight')
            ->join(DB::raw('(select fruit_id, SUM(weight) as weight
             from egress group by fruit_id ORDER BY SUM(weight)
             DESC limit 10) A'), 'fruit.id', '=', 'A.fruit_id')
            ->get();
        return response()->json([
            'entry' => $entry_weight,
            'egress' => $egress_weight,
        ]);
    }
}
