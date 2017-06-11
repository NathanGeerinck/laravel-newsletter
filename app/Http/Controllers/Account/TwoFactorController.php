<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyTwoFactorRequest;
use App\Mail\DisabledTwoFactor;
use App\Mail\EnabledTwoFactor;
use Illuminate\Http\Request;
use Mail;
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
            $this->backupCodes_generate();

            if(env('NOTIFICATIONS') == true) {
                Mail::to($request->user())->queue(new EnabledTwoFactor($request->user()->twoFactorBackupCodes()->get()->toArray()));
            }

            return redirect()->route('account.2fa');
        }

        return back()->withErrors('The key you entered isn\'t valid.');
    }

    public function disable(Request $request)
    {
        $account = $request->user();
        $account->google2fa_secret = null;
        $account->twoFactorBackupCodes()->truncate();
        $account->save();

        if(env('NOTIFICATIONS') == true) {
            Mail::to($request->user())->queue(new DisabledTwoFactor());
        }

        return redirect()->route('account.2fa');
    }

    public function backupCodes_generate()
    {
        auth()->user()->twoFactorBackupCodes()->truncate();

        $number = 0;
        while ($number <= 4) {
            $code = rand(0, 9).rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9).rand(0, 9);
            auth()->user()->twoFactorBackupCodes()->create([
                'display_code' => $code,
                'code' => str_replace(' ', '', $code),
            ]);
            $number++;
        }
    }
}