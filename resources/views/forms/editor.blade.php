<div class="form-group">

    {{--@if(env('APP_EDITOR') == 'markdown')--}}

        {{--{!! Form::label('editor', 'Content *') !!}--}}
        {{--{!! Form::textarea('editor', null, ['class' => 'form-control']) !!}--}}

        {{--@section('javascript')--}}

            {{--<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>--}}
            {{--<script>--}}
                {{--var simplemde = new SimpleMDE({ element: $("#editor")[0] });--}}
            {{--</script>--}}

        {{--@endsection--}}

        {{--@section('css')--}}

            {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">--}}

        {{--@endsection--}}

    {{--@else--}}

        {{--{!! Form::label('editor', 'Content *') !!}--}}
        {{--{!! Form::textarea('editor', null, ['class' => 'form-control']) !!}--}}

    {{--@endif--}}

    {!! Form::label('editor', 'Content *') !!}
    {!! Form::textarea('editor', null, ['class' => 'form-control']) !!}
</div>