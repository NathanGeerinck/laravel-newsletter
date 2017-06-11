<div class="btn-group" role="group" aria-label="...">
    <a href="{{ route('settings.application') }}" type="button" class="btn btn-default @if(request()->is('settings')) active @endif">{{ trans('settings.application.name') }}</a>
    <a href="{{ route('settings.mail') }}" class="btn btn-default @if(request()->is('settings/mail*')) active @endif">{{ trans('settings.mail.name') }}</a>
    {{--<a href="{{ route('settings.users') }}" class="btn btn-default @if(request()->is('settings/users*')) active @endif">Users</a>--}}
</div>