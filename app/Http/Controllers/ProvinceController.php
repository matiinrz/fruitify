<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Province::query()
            ->where('status', 'active')
            ->when($request->input('search', false), function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->get());
    }
}
