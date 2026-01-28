<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $title = "User Dashboard";
        $content = view('user.dashboard');
        return view('user.index', compact('title', 'content'));
    }

    public function profile()
    {
        $title = "User Profile";
        $content = view('user.profile');
        return view('user.index', compact('title', 'content'));
    }
}
