<div class="form-group">
    {!! Form::label('file', trans('lists.file'), ['class' => 'control-label']) !!}
    {!! Form::file('file', ['required']) !!}
</div>

{!! Form::submit(trans('lists.import'), ['class' => 'btn btn-default']) !!}