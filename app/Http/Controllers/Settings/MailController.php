<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Http\Requests\MailSettingsUpdateRequest;

/**
 * Class MailController
 * @package App\Http\Controllers\Settings
 */
class MailController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.mail');
    }

    /**
     * @param MailSettingsUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MailSettingsUpdateRequest $request)
    {
        $env = new DotenvEditor;
        $env->changeEnv($request->all());

        notify()->flash('Woohooo!', 'success', [
            'timer' => 2000,
            'text' => 'Settings successfully updated!',
        ]);

        return redirect()->route('settings.mail');
    }
}
