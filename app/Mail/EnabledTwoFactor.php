<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnabledTwoFactor extends Mailable
{
    use Queueable, SerializesModels;

    public $twofactorBackupCodes;

    public function __construct($twofactorBackupCodes)
    {
        $this->twofactorBackupCodes = $twofactorBackupCodes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.account.2fa.enabled')
            ->subject(trans('emails.2fa.enabled.subject'))
            ->with(['backupCodes' => $this->twofactorBackupCodes]);
    }
}
