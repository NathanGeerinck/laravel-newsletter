@component('mail::message')
{{ trans('emails.campaigns.send.text', ['campaign' => $campaign->name, 'subscribers' => count($subscriptions)]) }}

{{ trans('emails.campaigns.send.closing') }}

@endcomponent
