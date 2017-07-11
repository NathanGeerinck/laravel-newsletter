<div class="form-group">
    {!! Form::label('username', trans('account.general.full_name') . ' *') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', trans('account.general.email') . ' *') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}
