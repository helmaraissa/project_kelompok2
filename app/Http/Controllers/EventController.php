<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        return view('v_calendar');
    }

    public function getEvents() {
        $events =Event::all(['title', 'start_date as start']);
        return response()->json($events);
    }
}
