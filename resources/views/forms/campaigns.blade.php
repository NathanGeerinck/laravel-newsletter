<div class="form-group">
    {!! Form::label('name', trans('forms.name') . ' *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('subject', trans('forms.subject') . ' *') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('mailing_lists', trans('forms.mailing_lists') . ' *') !!}
    {!! Form::select('mailing_lists[]', $lists, (request()->is('campaigns/edit*') || request()->is('campaigns/clone*')) ? $mailingLists : 'null', ['class' => 'chosen-select', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('template_id', trans('forms.template') . ' *') !!}
    {!! Form::select('template_id', $templates, null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit(trans('forms.save'), ['class' => 'btn btn-default']) !!}