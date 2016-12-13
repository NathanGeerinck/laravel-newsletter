<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        return view('lists.index');
    }

    public function show()
    {
        return view('lists.show');
    }

    public function new()
    {
        return view('lists.new');
    }
}
