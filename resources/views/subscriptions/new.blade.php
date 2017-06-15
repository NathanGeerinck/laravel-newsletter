@extends('layouts.app')

@section('title', trans('subscriptions.clone'))

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('subscriptions.index') }}" type="button" class="btn btn-default">{{ trans('general.back') }}</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {!! Form::model((request()->is('subscriptions/clone*')) ? $subscription : 'null', ['route' => ['subscriptions.create']]) !!}

                @include('forms.subscriptions')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection