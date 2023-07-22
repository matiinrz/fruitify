<?php

namespace App\Http\Controllers;

use App\Http\Requests\FruitRequest;
use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            Fruit::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'LIKE', "%$search%");
                })->paginate()
        );
    }

    public function store(FruitRequest $request)
    {
        $fruit = new Fruit();
        $fruit->name = $request->input('name');
        if ($request->hasFile('image')) {
            $fruit->image = $request->file('image')->store('fruit');
        }
        $fruit->save();
        return response()->json($fruit);
    }

    public function show(string $id)
    {
        $fruit = Fruit::query()->findOrFail($id);
        return response()->json($fruit);
    }

    public function update(FruitRequest $request, string $id)
    {
        /* @var Fruit $fruit */
        $fruit = Fruit::query()->findOrFail($id);
        $fruit->name = $request->input('name');
        if ($request->hasFile('image')) {
            $fruit->image = $request->file('image')->store('fruit');
        }
        $fruit->save();
    }

    public function destroy(string $id)
    {
        $fruit = Fruit::query()->findOrFail($id);
        $fruit->delete();
        return response()->json(['message' => 'success']);
    }
}
