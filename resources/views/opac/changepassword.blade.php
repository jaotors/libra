<div class="modal fade modal-change-pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="box-container add-user">
                <h2 class="title">Change Password</h2>
                {{Form::open(['url' => '/admin/changepassword'])}}
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{Form::label('old_password','Old Password', ['class' => 'control-label'])}}
                                {{Form::password('old_password', ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('new_password', 'New Password', ['class' => 'control-label'])}}
                                {{Form::password('new_password', ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('repeat_password', 'Repeat Password', ['class' => 'control-label'])}}
                                {{Form::password('repeat_password', ['class' => 'form-control'])}}
                            </div>
                        </div>
                    </div>
                    <p class="btn-container two-buttons">
                        {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
                        <a data-dismiss="modal" aria-label="Close" class="btn btn-danger">Back</a>
                    </p>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
