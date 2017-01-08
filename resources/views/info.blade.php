@if (Session::has('info_message'))
    @if (Session::has('alert-class'))
        <div class="alert {{ Session::get('alert-class') }}">
    @else
        <div class="alert alert-success">
    @endif
        {{Session::get('info_message')}}
    </div>
@endif
