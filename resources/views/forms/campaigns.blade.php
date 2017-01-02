<div class="form-group">
    {!! Form::label('name', 'Name *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('subject', 'Subject *') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('mailing_lists', 'Mailing list *') !!}
    {!! Form::select('mailing_lists[]', $lists, (request()->is('campaigns/edit*') || request()->is('campaigns/clone*')) ? $mailingLists_arr : 'null', ['class' => 'chosen-select', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('template_id', 'Template *') !!}
    {!! Form::select('template_id', $templates, null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}

@section('javascript')
    <script>
        $(".chosen-select").chosen();
    </script>
@endsection
