@component('mail::message')
{{ trans('emails.password.updated.text') }}

{{ trans('emails.password.updated.closing') }}

@component('mail::button', ['url' => route('account.2fa.enable')])
{{ trans('emails.password.updated.button') }}
@endcomponent

@endcomponent
