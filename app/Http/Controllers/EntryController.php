<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index()
    {
        return response()->json(Entry::query()
            ->with('fruit', 'hall', 'city', 'province', 'stall')
            ->orderByDesc('created_at')
            ->paginate());
    }

    public function store(EntryRequest $request)
    {

        $fruits = json_decode($request->input('type'));
        foreach ($fruits as $fruit) {
            $entry = new Entry();
            $entry->plate = $request->input('plate');
            $entry->province_id = $request->input('province_id');
            $entry->city_id = $request->input('city_id');
            $entry->stall_id = $request->input('stall_id');
            $entry->hall_id = $request->input('hall_id');
            $entry->weight = $fruit->weight;
            $entry->fruit_id = $fruit->fruit_id;
            $entry->user_id = auth()->id();
            if ($request->hasFile('image')) {
                $entry->image = $request->file('image')->store('entry');
            }
            $entry->save();
        }
        return response()->json(['message' => 'success']);
    }
}
