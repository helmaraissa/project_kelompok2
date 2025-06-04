<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_lomba;

class c_home extends Controller
{
    public function index()
    {
        $lomba = m_lomba::latest()->get(); // atau tambahkan ->take(6) jika ingin dibatasi
        return view('v_home', compact('lomba'));
    }
}
