<div class="btn-group" role="group" aria-label="...">
    <a href="{{ route('account.general') }}" type="button" class="btn btn-default @if(request()->is('account')) active @endif">{{ trans('account.general.name') }}</a>
    <a href="{{ route('account.password') }}" class="btn btn-default @if(request()->is('account/password*')) active @endif">{{ trans('account.password.name') }}</a>
    <a href="{{ route('account.2fa') }}" class="btn btn-default @if(request()->is('account/2fa*')) active @endif">{{ trans('account.2fa.name') }}</a>
</div>