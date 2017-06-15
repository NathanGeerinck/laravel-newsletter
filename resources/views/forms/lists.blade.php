<div class="form-group">
    {!! Form::label('name', trans('forms.name') . ' *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', trans('forms.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('public', trans('forms.public/private')) !!}
    {!! Form::select('public', ['1' => 'Public', '0' => 'Private'], null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}