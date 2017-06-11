@component('mail::message')
{{ trans('emails.2fa.enabled.text') }}

@component('mail::button', ['url' => 'https://support.google.com/accounts/answer/1066447'])
    {{ trans('emails.2fa.enabled.button') }}
@endcomponent

{{ trans('emails.2fa.enabled.backupcodes') }}

@foreach($backupCodes as $backupCode)
    {{ $backupCode['code'] }}
@endforeach
@endcomponent