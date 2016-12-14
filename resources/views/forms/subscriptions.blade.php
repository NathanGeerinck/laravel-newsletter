<div class="form-group">
    {!! Form::label('email', 'Email *') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('country', 'Country') !!}
    {!! Form::select('country', countries(), null, ['class' => 'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('mailing_list_id', 'List') !!}
    {!! Form::select('mailing_list_id', $lists, null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
