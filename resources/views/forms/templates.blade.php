<div class="form-group">
    {!! Form::label('name', 'Name *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@include('forms.editor')

<p><strong>Available variables:</strong> %subject%, %email%, %name%, %country%, %unsubscribe_link%</p>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}