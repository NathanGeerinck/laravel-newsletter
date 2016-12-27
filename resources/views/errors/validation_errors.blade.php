@if(session()->get('errors'))
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        @foreach(session()->get('errors')->all() as $error)
            <div>{{ ucfirst($error) }}</div>
        @endforeach
    </div>
@endif