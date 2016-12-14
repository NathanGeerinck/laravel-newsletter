@extends('layouts.app')

@section('title', 'Edit list: ' . $list->name)

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
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
                {!! Form::model($list, ['route' => ['lists.update', $list]]) !!}
                    <div class="form-group ">
                        {!! Form::label('name', 'Name *') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group ">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection