<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyTwoFactorRequest;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    public function index()
    {
        $account = auth()->user();

        return view('account.2fa.index', compact('account'));
    }

    public function enable(Request $request)
    {
        $account = $request->user();
        $account->generate2faKey();

        $google2fa = new Google2FA();

        $google2fa_url = $google2fa->getQRCodeGoogleUrl(
            env('APP_NAME'),
            $account->email,
            $account->google2fa_secret
        );

        return view('account.2fa.enable', compact('account', 'google2fa_url'));
    }

    public function verify(VerifyTwoFactorRequest $request)
    {
        if ($request->user()->verifyKey($request->input('key'))) {
//            $this->backupcodes_generate();

//            return redirect()->action('TwoFactorController@backupcodes_view');
            return redirect()->route('account.2fa');
        }

        return route('account.2fa.enable')->withErrors(['key' => 'The key you entered isn\'t valid.']);
    }

    public function disable(Request $request)
    {
        $account = $request->user();
        $account->google2fa_secret = null;
        $account->save();

        return redirect()->route('account.2fa');
    }
}