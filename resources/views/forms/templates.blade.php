<div class="form-group">
    {!! Form::label('name', 'Name *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('content', 'Content *') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}