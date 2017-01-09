{{--@if(Session::get('success'))--}}
    {{--<div class="alert alert-dismissible alert-success">--}}
        {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
        {{--<b>Success!</b> {!! Session::get('success') !!}--}}
    {{--</div>--}}
{{--@endif--}}
@if (notify()->ready())
    @section('javascript')
        <script>
            swal({
                title: "{!! notify()->message() !!}",
                text: "{!! notify()->option('text') !!}",
                type: "{{ notify()->type() }}",
                @if (notify()->option('timer'))
                timer: {{ notify()->option('timer') }},
                showConfirmButton: false
                @endif
            });
        </script>
    @endsection
@endif