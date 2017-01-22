@if (count($errors) > 0)
<div class="modal fade message-error" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif