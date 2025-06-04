<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c_kalender extends Controller
{
    public function index()
    {
        $events = [
            [
                'title' => 'Latihan Basket',
                'start' => '2025-04-17',
                'end'   => '2025-04-17',
            ],
            [
                'title' => 'Lomba Pramuka',
                'start' => '2025-04-20',
                'end'   => '2025-04-22',
            ],
        ];

        return view('calendar', compact('events'));
    }
}
