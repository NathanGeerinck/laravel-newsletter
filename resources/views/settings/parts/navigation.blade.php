<div class="btn-group" role="group" aria-label="...">
    <a href="{{ route('settings.index') }}" type="button" class="btn btn-default @if(request()->is('settings')) active @endif">Application</a>
    <a href="{{ route('settings.users') }}" class="btn btn-default @if(request()->is('settings/users*')) active @endif">Users</a>
</div>