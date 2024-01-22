<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Http\Requests\UpdateEntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Entry::query()
            ->with('fruit', 'hall', 'city', 'province', 'stall')
            ->when($request->input('province_id'), function ($query, $param) {
                $query->where('province_id', $param);
            })->when($request->input('city_id'), function ($query, $param) {
                $query->where('city_id', $param);
            })->when($request->input('stall_id'), function ($query, $param) {
                $query->where('stall_id', $param);
            })->when($request->input('hall_id'), function ($query, $param) {
                $query->where('hall_id', $param);
            })->when($request->input('fruit_id'), function ($query, $param) {
                $query->where('fruit_id', $param);
            })
            ->when($request->input('created_at_to'), function ($query, $created_at_from) {
                $query->whereDate('entry_date', '<=', "$created_at_from");
            })
            ->when($request->input('created_at_from'), function ($query, $created_at_to) {
                $query->whereDate('entry_date', '>=', "$created_at_to");
            })
            ->orderByDesc('created_at')
            ->paginate());
    }

    public function show($id)
    {
        return response()->json(Entry::query()->with('fruit', 'hall', 'city', 'province', 'stall')->findOrFail($id));
    }

    public function store(EntryRequest $request)
    {

        $fruits = json_decode($request->input('type'));
        foreach ($fruits as $fruit) {
            $entry = new Entry();
            $entry->plate = $request->input('plate');
            if ($request->hasFile('plate_image')) {
                $entry->plate_image = $request->file('plate_image')->store('entry');
            }
            $entry->province_id = $request->input('province_id');
            $entry->city_id = $request->input('city_id');
            $entry->stall_id = $request->input('stall_id');
            $entry->hall_id = $request->input('hall_id');
            $entry->entry_date = $request->input('entry_date');
            $entry->price = $request->input('price');
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

    public function update(UpdateEntryRequest $request, $id)
    {
        /* @var Entry $entry */
        $entry = Entry::query()->findOrFail($id);
        $entry->plate = $request->input('plate');
        if ($request->hasFile('plate_image')) {
            $entry->plate_image = $request->file('plate_image')->store('entry');
        }
        $entry->province_id = $request->input('province_id');
        $entry->city_id = $request->input('city_id');
        $entry->stall_id = $request->input('stall_id');
        $entry->hall_id = $request->input('hall_id');
        $entry->entry_date = $request->input('entry_date');
        $entry->price = $request->input('price');
        $entry->weight = $request->input('weight');
        $entry->fruit_id = $request->input('fruit_id');
        $entry->user_id = auth()->id();
        if ($request->hasFile('image')) {
            $entry->image = $request->file('image')->store('entry');
        }
        $entry->save();
        return response()->json(['message' => 'success']);
    }
}
