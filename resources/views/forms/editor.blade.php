<div class="form-group">

    @if(env('APP_EDITOR') == 'html')

        {!! Form::label($name, trans('forms.content') . ' *') !!}
        {!! Form::textarea($name, null, ['class' => 'form-control', 'id' => $name]) !!}

        @section('javascript')

            <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
            <script>
                CKEDITOR.replace( '{{ $name }}' );
            </script>

        @endsection

    @else

        {!! Form::label($name, trans('forms.content') . ' *') !!}
        {!! Form::textarea($name, null, ['class' => 'form-control']) !!}

    @endif

</div>