<div class="form-group">
    {!! Form::label('APP_NAME', trans('settings.application.name2') . ' *') !!}
    {!! Form::text('APP_NAME', env('APP_NAME'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_URL', trans('settings.application.url') . ' *') !!}
    {!! Form::text('APP_URL', env('APP_URL'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_EMAIL', trans('settings.application.from.email') . ' *') !!}
    {!! Form::email('APP_EMAIL', env('APP_EMAIL'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_FROM', trans('settings.application.from.name') . ' *') !!}
    {!! Form::text('APP_FROM', env('APP_FROM'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('NOTIFICATIONS', trans('settings.application.notifications') . ' *') !!}
    {!! Form::select('NOTIFICATIONS', ['false' => 'No', 'true' => 'Yes'], (env('NOTIFICATIONS') == 1) ? 'true' : 'false', ['class' => 'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_REGISTER', trans('settings.application.registration') . ' *') !!}
    {!! Form::select('APP_REGISTER', ['false' => 'No', 'true' => 'Yes'], (env('APP_REGISTER') == 1) ? 'true' : 'false', ['class' => 'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_EDITOR', trans('settings.application.templateEditor') . ' *') !!}
    {!! Form::select('APP_EDITOR', ['textarea' => 'Textarea', 'html' => 'HTML Editor'], env('APP_EDITOR'), ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}

