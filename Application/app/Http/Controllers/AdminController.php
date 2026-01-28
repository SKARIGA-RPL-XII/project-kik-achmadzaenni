<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Admin Dashboard";
        $content = view('admin.dashboard');
        return view('admin.index', compact('title', 'content'));
    }

    public function profile() 
    {
        $title = "Admin Profile";
        $content = view('admin.profile');
        return view('admin.index', compact('title', 'content'));
    }

    public function menu()
    {
        $title = "Admin Menu";
        $content = view('admin.master.menu');
        return view('admin.index', compact('title', 'content'));
    }
    public function user()
    {
        $title = "Admin User";
        $content = view('admin.master.user');
        return view('admin.index', compact('title', 'content'));
    }
}
