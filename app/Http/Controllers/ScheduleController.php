<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Validator;

class ScheduleController extends Controller
{
    // Show the calendar view
        public function index()
        {
            $events = array();
            $bookings = Schedule::all();
            foreach($bookings as $booking) {
                $color = '#3498db';
                

                $events[] = [
                    'id'   => $booking->id,
                    'title' => $booking->title,
                    'description' => $booking->description,
                    'start' => $booking->start_date,
                    'end' => $booking->end_date,
                    'color' => $color
                ];
            }
            return view('calendars.schedule', ['events' => $events]);
        }



            public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string',
            ]);

            $booking = Schedule::create([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            $color = ($booking->title == 'Test') ? '#924ACE' : null;

            return response()->json([
                'id' => $booking->id,
                'title' => $booking->title,
                'description' => $booking->description,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'color' => $color,
            ]);
        }



        public function update(Request $request, $id)
        {
            $booking = Schedule::find($id);
            if (!$booking) {
                return response()->json(['error' => 'Unable to locate the event'], 404);
            }

            $booking->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
            ]);

            return response()->json('Event updated');
        }



    public function destroy($id)
    {
        $booking = Schedule::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}