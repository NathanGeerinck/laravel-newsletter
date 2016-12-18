<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\MailSettingsUpdateRequest;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function index()
    {
        return view('settings.mail');
    }

    public function update(MailSettingsUpdateRequest $request)
    {
        $env = new DotenvEditor();
        $env->changeEnv($request->all());

        return redirect()->route('settings.mail');
    }
}