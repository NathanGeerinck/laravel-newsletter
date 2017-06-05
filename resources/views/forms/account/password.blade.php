<div class="form-group">
    {!! Form::label('old_password', trans('account.password.old') . ' *') !!}
    {!! Form::password('old_password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('new_password', trans('account.password.new') . ' *') !!}
    {!! Form::password('new_password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('new_password_confirmation', trans('account.password.new_confirm') . ' *') !!}
    {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}
