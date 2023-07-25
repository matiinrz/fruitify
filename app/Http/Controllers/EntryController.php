<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index()
    {
        return response()->json(Entry::query()->with('fruit')->orderByDesc('created_at')->paginate());
    }

    public function store(EntryRequest $request)
    {

        $fruits = json_decode($request->input('type'));
        foreach ($fruits as $fruit) {
            $entry = new Entry();
            $entry->plate = $request->input('plate');
            $entry->entry_date = $request->input('entry_date');
            $entry->destination = $request->input('destination');
            $entry->destination = $request->input('destination_type');
            $entry->destination = $request->input('origin');
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
