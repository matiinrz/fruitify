<?php

namespace App\Http\Controllers;

use App\Http\Requests\EgressRequest;
use App\Models\Egress;
use Illuminate\Http\Request;

class EgressController extends Controller
{
    public function index()
    {
        return response()->json(Egress::query()->with('fruit')->orderByDesc('created_at')->paginate());
    }

    public function store(EgressRequest $request)
    {

        $fruits = json_decode($request->input('type'));
        foreach ($fruits as $fruit) {

            $entry = new Egress();
            $entry->plate = $request->input('plate');
            $entry->user_id = auth()->id();
            $entry->entry_date = $request->input('entry_date');
            $entry->destination = $request->input('destination');
            $entry->weight = $fruit['weight'];
            $entry->fruit_id = $fruit['fruit_id'];
            $entry->user_id = auth()->id();
            if ($request->hasFile('image')) {
                $entry->image = $request->file('image')->store('entry');
            }
            $entry->save();
        }
        return response()->json(['message' => 'success']);
    }
}
