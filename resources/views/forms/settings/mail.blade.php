<div class="form-group">
    {!! Form::label('MAIL_DRIVER', trans('settings.mail.driver') . ' *') !!}
    {!! Form::text('MAIL_DRIVER', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => 'smtp']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_HOST', trans('settings.mail.host') . ' *') !!}
    {!! Form::text('MAIL_HOST', env('MAIL_HOST'), ['class' => 'form-control', 'placeholder' => 'smtp.example.com']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_PORT', trans('settings.mail.port') . ' *') !!}
    {!! Form::text('MAIL_PORT', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => '2525']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_USERNAME', trans('settings.mail.username') . ' *') !!}
    {!! Form::text('MAIL_USERNAME', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => 'info@test.com']) !!}
</div>

<div class="form-group">
    {!! Form::label('MAIL_PASSWORD', trans('settings.mail.password') . ' *') !!}
    {!! Form::text('MAIL_PASSWORD', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => 'MySuPERs4fePasSw0rD']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}