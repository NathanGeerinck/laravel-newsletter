<div class="form-group">
    {!! Form::label('file', 'Choose a file (xls, xlsx and csv)', ['class' => 'control-label']) !!}
    {!! Form::file('file', ['required']) !!}
</div>

{!! Form::submit('Import', ['class' => 'btn btn-default']) !!}