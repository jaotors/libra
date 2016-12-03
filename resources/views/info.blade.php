@if (Session::has('info_message'))
    <div class="alert alert-success">
        {{Session::get('info_message')}}
    </div>
@endif
