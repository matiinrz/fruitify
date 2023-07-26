<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitRequest;
use App\Models\Fruit;
use App\Models\Stall;
use Illuminate\Http\Request;

class StallController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            Stall::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                })->paginate()
        );
    }

    public function store(Request $request)
    {
        $stall = new Stall();
        $stall->name = $request->input('name');
        $stall->save();
        return response()->json($stall);
    }

    public function show(string $id)
    {
        $stall = Stall::query()->findOrFail($id);
        return response()->json($stall);
    }

    public function update(FruitRequest $request, string $id)
    {
        /* @var Stall $stall */
        $stall = Stall::query()->findOrFail($id);
        $stall->name = $request->input('name');
        $stall->save();
        return response()->json($stall);
    }

    public function destroy(string $id)
    {
        $stall = Stall::query()->findOrFail($id);
        $stall->delete();
        return response()->json(['message' => 'success']);
    }
}
