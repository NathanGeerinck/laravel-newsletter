@extends('layouts.app')

@section('title', 'New template')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('templates.index') }}" type="button" class="btn btn-default">Back to overview</a>
                        <a href="https://github.com/NathanGeerinck/Laravel-Newsletter/wiki/Templates" target="_blank" type="button" class="btn btn-default"><i class="fa fa-info-circle"></i> </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {!! Form::model((request()->is('templates/clone*')) ? $template : 'null', ['route' => ['templates.create']]) !!}

                @include('forms.templates')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover(
                'html', true
            )
        })
    </script>
@endsection