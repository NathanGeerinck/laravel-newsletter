<div class="form-group">
    {!! Form::label('MAIL_DRIVER', 'Driver *') !!}
    {!! Form::text('MAIL_DRIVER', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => 'smtp']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_HOST', 'Host *') !!}
    {!! Form::text('MAIL_HOST', env('MAIL_HOST'), ['class' => 'form-control', 'placeholder' => 'smtp.example.com']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_PORT', 'Port *') !!}
    {!! Form::text('MAIL_PORT', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => '2525']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_USERNAME', 'Username *') !!}
    {!! Form::text('MAIL_USERNAME', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => 'info@test.com']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_PASSWORD', 'Password *') !!}
    {!! Form::text('MAIL_PASSWORD', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => 'MySuPERs4fePasSw0rD']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}