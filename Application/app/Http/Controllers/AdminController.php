<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $title = "Admin Dashboard";
        $content = view('admin.dashboard');
        return view('admin.index', compact('title', 'content'));
    }
}
