<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    
    public function __construct()
    {
    }

    public function index()
    {
        $user = Auth()->User();
        return view('admin.index', compact('user'));
    }
}
