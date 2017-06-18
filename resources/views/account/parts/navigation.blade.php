<div class="btn-group" role="group" aria-label="...">
    <a href="{{ route('account.general') }}" type="button" class="btn btn-default @if(request()->is('account')) active @endif">{{ trans('account.general.name') }}</a>
    <a href="{{ route('account.password') }}" class="btn btn-default @if(request()->is('account/password*')) active @endif">{{ trans('account.password.name') }}</a>
</div>