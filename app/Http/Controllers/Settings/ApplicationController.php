<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brotzka\DotenvEditor\DotenvEditor;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('settings.application');
    }

    public function update(Request $request)
    {
        $env = new DotenvEditor;
        $env->changeEnv($request->all());

        return redirect()->route('settings.application')->withSuccess('Saved the Application settings successfully!');
    }
}