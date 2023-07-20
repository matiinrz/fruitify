<?php

namespace App\Http\Controllers;

use App\Http\Requests\EgressRequest;
use App\Models\Egress;
use Illuminate\Http\Request;

class EgressController extends Controller
{
    public function index()
    {
        return response()->json(Egress::query()->orderByDesc('created_at')->paginate());
    }

    public function store(EgressRequest $request)
    {
        $entry = new Egress();
        $entry->plate = $request->input('plate');
        $entry->type = $request->input('type');
        $entry->user_id = auth()->id();
        $entry->entry_date = $request->input('entry_date');
        $entry->destination = $request->input('destination');
        if ($request->hasFile('image')) {
            $entry->image = $request->file('image')->store('entry');
        }
        $entry->save();
        return response()->json($entry);
    }
}
