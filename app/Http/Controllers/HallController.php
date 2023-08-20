<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitRequest;
use App\Http\Requests\HallRequest;
use App\Models\Fruit;
use App\Models\Hall;
use App\Models\Stall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            Hall::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                })->paginate()
        );
    }

    public function store(HallRequest $request)
    {
        $hall = new Hall();
        $hall->name = $request->input('name');
        $hall->save();
        return response()->json($hall);
    }

    public function show(string $id)
    {
        $hall = Hall::query()->findOrFail($id);
        return response()->json($hall);
    }

    public function update(HallRequest $request, string $id)
    {
        /* @var Hall $hall */
        $hall = Hall::query()->findOrFail($id);
        $hall->name = $request->input('name');
        $hall->save();
        return response()->json($hall);
    }

    public function destroy(string $id)
    {
        $hall = Hall::query()->findOrFail($id);
        $hall->delete();
        return response()->json(['message' => 'success']);
    }
}
