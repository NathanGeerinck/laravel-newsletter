@extends('layouts.app')

@section('title', trans('lists.import') . ': ' . $list->name)

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('lists.index') }}" type="button" class="btn btn-default">{{ trans('general.back') }}</a>
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

