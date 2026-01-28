<?php

namespace App\Http\Controllers;

class PenjualController extends Controller
{
    public function index()
    {
        $title = "Penjual Dashboard";
        $content = view('penjual.dashboard');
        return view('penjual.index', compact('title', 'content'));
    }

    public function profile()
    {
        $title = "Penjual Profile";
        $content = view('penjual.profile');
        return view('penjual.index', compact('title', 'content'));
    }
}
