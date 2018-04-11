<div class="form-group">
    {!! Form::label('username', trans('account.general.full_name') . ' *') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', trans('account.general.email') . ' *') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('preferences[language]', trans('account.general.language') . ' *') !!}
    {!! Form::select('preferences[language]', ['en' => trans('language.en'), 'nl' => trans('language.nl')], null, ['class' => 'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('preferences[notifications]', trans('account.general.notifications') . ' *') !!}
    {!! Form::select('preferences[notifications]', [0 => 'No', 1 => 'Yes'], null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}
