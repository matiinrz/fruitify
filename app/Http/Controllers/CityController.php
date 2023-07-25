<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json(City::query()
            ->where('status', 'active')
            ->when($request->input('province_id', false), function ($query, $province_id) {
                $query->where('province_id', $province_id);
            })
            ->when($request->input('search', false), function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->get());
    }
}
