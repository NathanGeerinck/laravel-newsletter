<div class="form-group">
    {!! Form::label('username', trans('account.general.full_name') . ' *') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', trans('account.general.email') . ' *') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('language', trans('account.general.language') . ' *') !!}
    {!! Form::select('language', ['en' => trans('language.en'), 'nl' => trans('language.nl')], null, ['class' => 'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('notifications', trans('account.general.notifications') . ' *') !!}
    {!! Form::select('notifications', [0 => 'No', 1 => 'Yes'], null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}