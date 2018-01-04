<div class="form-group">
    {!! Form::label('username', trans('account.general.full_name') . ' *') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', trans('account.general.email') . ' *') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<<<<<<< HEAD
<div class="form-group">
    {!! Form::label('language', trans('account.general.language') . ' *') !!}
    {!! Form::select('language', ['en' => trans('language.en'), 'nl' => trans('language.nl')], null, ['class' => 'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('notifications_on', trans('account.general.notifications') . ' *') !!}
    {!! Form::select('notifications_on', [0 => 'No', 1 => 'Yes'], null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}
=======
{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}
>>>>>>> b0e1377f1ad00213e56fe3570925e8f049a4895a
