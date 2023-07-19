<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index()
    {
        return response()->json(Entry::query()->paginate());
    }

    public function store(Request $request)
    {
        $entry = new Entry();
        $entry->plate = $request->input('plate');
        $entry->weight = $request->input('weight');
        $entry->type = $request->input('type');
        $entry->user_id = auth()->id();
        if ($request->hasFile('picture')) {
            $entry->image = $request->file('picture')->store('entry');
        }
        $entry->save();
        return response()->json($entry);
    }
}
