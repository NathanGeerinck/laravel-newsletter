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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ApplicationSettingsUpdateRequest $request)
    {
        $env = new DotenvEditor;
        $env->changeEnv([
            'APP_NAME' => '"' . $request->APP_NAME . '"',
            'APP_URL' => $request->APP_URL,
            'APP_EMAIL' => $request->APP_EMAIL,
            'APP_FROM' => '"' . $request->APP_FROM . '"',
            'APP_REGISTER' => $request->APP_REGISTER,
            'APP_EDITOR' => $request->APP_EDITOR,
        ]);

        notify()->flash('Woohooo!', 'success', [
            'timer' => 2000,
            'text' => 'Settings successfully updated!',
        ]);

        return redirect()->route('settings.application');
    }
}
