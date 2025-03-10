<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'occasion' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'year' => 'required|integer',
            'month' => 'required|integer',
            'day' => 'required|integer',
        ]);

        Event::create([
            'occasion' => $request->input('occasion'),
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'month' => $request->input('month'),
            'day' => $request->input('day'),
        ]);

        return response()->json(['message' => 'Event saved successfully'], 200);
    }
}