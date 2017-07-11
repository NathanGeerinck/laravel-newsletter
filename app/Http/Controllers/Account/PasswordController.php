<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\AccountPasswordUpdateRequest;
use App\Http\Controllers\Controller;
use App\Mail\PasswordUpdated;
use Hash;
use Mail;

class PasswordController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $account = auth()->user();

        return view('account.password', compact('account'));
    }

    public function update(AccountPasswordUpdateRequest $request)
    {
        $check = Hash::check($request->input('old_password'), auth()->user()->password);

        if (!$check) {
            return redirect()->back()->withErrors(['Your current password is incorrect!']);
        }

        $user = $request->user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        if($user->notifications == true) {
            Mail::to($user)->queue(new PasswordUpdated());
        }

        notify()->flash('Password', 'success', [
            'timer' => 2000,
            'text' => 'Successfully updated!',
        ]);

        return redirect()->back();
    }
}
