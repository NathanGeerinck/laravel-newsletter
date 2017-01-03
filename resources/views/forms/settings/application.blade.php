<div class="form-group">
    {!! Form::label('APP_URL', 'URL *') !!}
    {!! Form::text('APP_URL', env('APP_URL'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_EMAIL', 'From (email) *') !!}
    {!! Form::email('APP_EMAIL', env('APP_EMAIL'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_FROM', 'From (name) *') !!}
    {!! Form::text('APP_FROM', env('APP_FROM'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('APP_REGISTER', 'Registration *') !!}
    {!! Form::select('APP_REGISTER', ['false' => 'No', 'true' => 'Yes'], (env('APP_REGISTER') == 1) ? 'true' : 'false', ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}