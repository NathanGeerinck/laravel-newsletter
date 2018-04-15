<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Http\Requests\MailSettingsUpdateRequest;

/**
 * Class MailController.
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
     * @throws \Brotzka\DotenvEditor\Exceptions\DotEnvException
     */
    public function update(MailSettingsUpdateRequest $request)
    {
        $env = new DotenvEditor;
        $env->changeEnv([
            'MAIL_DRIVER' => $request->input('MAIL_DRIVER'),
            'MAIL_PORT' => $request->input('MAIL_PORT'),
            'MAIL_HOST' => $request->input('MAIL_HOST'),
            'MAIL_USERNAME' => $request->input('MAIL_USERNAME'),
            'MAIL_PASSWORD' => $request->input('MAIL_PASSWORD'),
        ]);

        notify()->flash(trans('general.woohoo'), 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->route('settings.mail');
    }
}
