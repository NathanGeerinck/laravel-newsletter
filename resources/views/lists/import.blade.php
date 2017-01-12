@extends('layouts.app')

@section('title', 'Import subscriptions: ' . $list->name)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('lists.index') }}" type="button" class="btn btn-default">Back to overview</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => ['lists.import', $list], 'files' => true]) !!}

                @include('forms.lists.import')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

