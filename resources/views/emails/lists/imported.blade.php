@component('mail::message')
{{ trans('emails.lists.imported.text', ['list' => $list->name]) }}


@component('mail::button', ['url' => route('lists.show', $list)])
{{ trans('emails.lists.imported.button', ['list' => $list->name]) }}
@endcomponent

@endcomponent