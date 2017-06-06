<div class="form-group">
    {!! Form::label('email', trans('forms.email') . ' *') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', trans('forms.name') . ' *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('country', trans('forms.country') . ' *') !!}
    {!! Form::select('country', countries(), null, ['class' => 'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('mailing_list_id', trans('forms.list') . ' *') !!}
    {!! Form::select('mailing_list_id', $lists, null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
