<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\ApplicationSettingsUpdateRequest;
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
     * @param ApplicationSettingsUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ApplicationSettingsUpdateRequest $request)
    {
        $env = new DotenvEditor;
        $env->changeEnv([
            'APP_NAME' => '"' . $request->input('APP_NAME') . '"',
            'APP_URL' => $request->input('APP_URL'),
            'APP_EMAIL' => $request->input('APP_EMAIL'),
            'APP_FROM' => '"' . $request->input('APP_FROM') . '"',
            'APP_REGISTER' => $request->input('APP_REGISTER'),
            'APP_EDITOR' => $request->input('APP_EDITOR'),
            'NOTIFICATIONS' => $request->input('NOTIFICATIONS'),
        ]);

        app()->setLocale($request->input('APP_LANGUAGE'));

        notify()->flash(trans('general.woohoo'), 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->route('settings.application');
    }
}