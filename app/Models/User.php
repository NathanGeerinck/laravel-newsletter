<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use PragmaRX\Google2FA\Google2FA;

/**
 * @property mixed google2fa_secret
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'language',
        'notifications_on',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscription()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mailingList()
    {
        return $this->hasMany(MailingList::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function template()
    {
        return $this->hasMany(Template::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function generate2faKey()
    {
        if (!$this->google2fa_secret) {
            $google2fa = new Google2FA();

            $this->google2fa_secret = $google2fa->generateSecretKey();
            $this->save();
        }
    }

    public function verifyKey($secret)
    {
        $google2fa = new Google2FA();

        return $google2fa->verifyKey($this->google2fa_secret, $secret);
    }

    public function twoFactorBackupCodes()
    {
        return $this->hasMany(TwofactorBackupCodes::class, 'user_id');
    }
}