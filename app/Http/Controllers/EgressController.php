<?php

namespace App\Http\Controllers;

use App\Http\Requests\EgressRequest;
use App\Models\Egress;
use Illuminate\Http\Request;

class EgressController extends Controller
{
    public function index()
    {
        return response()->json(Egress::query()
            ->with('fruit','hall','city','province','stall')
            ->orderByDesc('created_at')
            ->paginate());
    }

    public function store(EgressRequest $request)
    {

        $fruits = json_decode($request->input('type'));
        foreach ($fruits as $fruit) {

            $entry = new Egress();
            $entry->plate = $request->input('plate');
            $entry->user_id = auth()->id();
            $entry->entry_date = $request->input('entry_date');
            $entry->province_id = $request->input('province_id');
            $entry->city_id = $request->input('city_id');
            $entry->stall_id = $request->input('stall_id');
            $entry->hall_id = $request->input('hall_id');
            $entry->entry_date = $request->input('entry_date');
            $entry->weight = $fruit->weight;
            $entry->fruit_id = $fruit->fruit_id;
            if ($request->hasFile('image')) {
                $entry->image = $request->file('image')->store('entry');
            }
            $entry->save();
        }
        return response()->json(['message' => 'success']);
    }
}
