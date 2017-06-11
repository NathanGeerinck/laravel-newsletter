<div class="form-group">

    @if(env('APP_EDITOR') == 'html')

        {!! Form::label('editor', trans('forms.content') . ' *') !!}
        {!! Form::textarea('editor', null, ['class' => 'form-control', 'id' => 'editor']) !!}

        @section('javascript')

            <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
            <script>
                CKEDITOR.replace( 'editor' );
            </script>

        @endsection

    @else

        {!! Form::label('editor', trans('forms.content') . ' *') !!}
        {!! Form::textarea('editor', null, ['class' => 'form-control']) !!}

    @endif

</div>