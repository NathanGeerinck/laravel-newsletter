<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\GeneralUpdateRequest;

class GeneralController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $account = auth()->user();

        return view('account.general', compact('account'));
    }

    /**
     * @param GeneralUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GeneralUpdateRequest $request)
    {
        $request->user()->update($request->all());

        notify()->flash(trans('general.woohoo'), 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->back();
    }
}
