@if (Session::has('info_message'))
<div class="modal fade message-info" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
    @if (Session::has('alert-class'))
        <div class="alert {{ Session::get('alert-class') }}">
    @else
        <div class="alert alert-success">
    @endif
        {{Session::get('info_message')}}
        </div>
        </div>
    </div>
</div>
@endif
