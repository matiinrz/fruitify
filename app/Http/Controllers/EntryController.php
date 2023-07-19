<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index()
    {
        return response()->json(Entry::query()->paginate());
    }

    public function store(EntryRequest $request)
    {
        $entry = new Entry();
        $entry->plate = $request->input('plate');
        $entry->type = $request->input('type');
        $entry->entry_date = $request->input('entry_date');
        $entry->user_id = auth()->id();
        if ($request->hasFile('image')) {
            $entry->image = $request->file('image')->store('entry');
        }
        $entry->save();
        return response()->json($entry);
    }
}
