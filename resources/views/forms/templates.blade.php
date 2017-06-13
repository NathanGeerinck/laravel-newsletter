<div class="form-group">
    {!! Form::label('name', trans('forms.name') . ' *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@include('forms.editor', ['name' => 'content'])

<p><strong>{{ trans('templates.available_variables') }}</strong> %subject%, %email%, %name%, %country%, %unsubscribe_link%</p>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}