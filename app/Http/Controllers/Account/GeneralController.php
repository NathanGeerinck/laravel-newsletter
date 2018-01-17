<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountGeneralUpdateRequest;

class GeneralController extends Controller
{
    public function index()
    {
        $account = auth()->user();

        return view('account.general', compact('account'));
    }

    public function update(AccountGeneralUpdateRequest $request)
    {
        $request->user()->update($request->all());

        notify()->flash(trans('general.woohoo'), 'success', [
            'timer' => 2000,
            'text' => trans('general.success.update'),
        ]);

        return redirect()->back();
    }
}
