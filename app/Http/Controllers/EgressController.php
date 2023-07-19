<?php

namespace App\Http\Controllers;

use App\Models\Egress;
use Illuminate\Http\Request;

class EgressController extends Controller
{
    public function index()
    {
        return response()->json(Egress::query()->paginate());
    }

    public function store(Request $request)
    {
        $entry = new Egress();
        $entry->plate = $request->input('plate');
        $entry->weight = $request->input('weight');
        $entry->type = $request->input('type');
        $entry->user_id = auth()->id();
        $entry->destination = $request->input('destination');
        if ($request->hasFile('picture')) {
            $entry->image = $request->file('picture')->store('entry');
        }
        $entry->save();
        return response()->json($entry);
    }
}
