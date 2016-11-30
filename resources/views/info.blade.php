@if (Session::has('info_message'))
    <div class="alert alert-info">
        {{Session::get('info_message')}}
    </div>
@endif
