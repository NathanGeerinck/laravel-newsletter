<div class="form-group">
    {!! Form::label('name', 'Name *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@include('forms.editor')



{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}