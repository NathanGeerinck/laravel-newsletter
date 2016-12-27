@if(Session::get('success'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <b>Success!</b> {!! Session::get('success') !!}
    </div>
@endif