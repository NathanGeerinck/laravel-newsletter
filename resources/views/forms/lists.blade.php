<div class="form-group">
    {!! Form::label('name', 'Name *') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('public', 'Public/Private') !!}
    {!! Form::select('public', ['1' => 'Public', '0' => 'Private'], null, ['class' => 'chosen-select']) !!}
</div>

{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}

@section('javascript')
    <script>
        $(".chosen-select").chosen();
    </script>
@endsection