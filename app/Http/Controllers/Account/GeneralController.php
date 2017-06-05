<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\AccountGeneralUpdateRequest;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function index()
    {
        $account = auth()->user();

        return view('account.general', compact('account'));
    }

    public function update(AccountGeneralUpdateRequest $request)
    {
        auth()->user()->update($request->all());

        notify()->flash($request->username, 'success', [
            'timer' => 2000,
            'text' => 'Successfully updated!',
        ]);

        return redirect()->back();
    }
}
