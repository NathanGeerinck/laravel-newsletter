<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brotzka\DotenvEditor\DotenvEditor;

/**
 * Class ApplicationController
 * @package App\Http\Controllers\Settings
 */
class ApplicationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.application');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $env = new DotenvEditor;
        $env->changeEnv($request->all());

        notify()->flash('Woohooo!', 'success', [
            'timer' => 2000,
            'text' => 'Settings successfully updated!',
        ]);

        return redirect()->route('settings.application');
    }
}