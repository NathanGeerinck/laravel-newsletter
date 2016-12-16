@extends('layouts.app')

@section('title', 'Templates (' . $templates->total() . ')')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('title')
                <div class="pull-right">
                    <div class="btn-group btn-group-xs">
                        <a href="{{ route('templates.new') }}" type="button" class="btn btn-default">Create template</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                {!! Form::model(request()->all(), ['route' => 'templates.filter', 'method' => 'get']) !!}
                    <div class="input-group">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                        <div class="input-group-btn">
                            {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table" id="exceptions">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 15%">ID</th>
                            <th style="width: 50%;">Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($templates as $template)
                            <tr>
                                <td class="text-center">{{ $template->id }}</td>
                                <td>{{ $template->name }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        <a href="{{ route('templates.preview', $template) }}" class="btn btn-default" target="_blank"><i class="fa fa-eye-slash"></i></a>
                                        <a href="{{ route('templates.show', $template) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('templates.edit', $template) }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('templates.clone', $template) }}" class="btn btn-default"><i class="fa fa-clone"></i></a>
                                        <a class="btn btn-default"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">{{ $templates->links() }}</div>
            </div>
        </div>
    </div>
@endsection