 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Libra</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="sidenav">
                    <h1 class="logo"><a href="/"><img src="{{ secure_asset('images/logo.png') }}" alt="LCCT"></a></h1>
                    <ul class="nav">
                        <li><a href="#"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>Dashboard</a></li>
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>Books</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>Penalty</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>Reports</a></li>
                    </ul>
                </div>
                <div class="main">
                    <div class="modal fade modal-test" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="box-container add-user">
                                <h2 class="title">Add User Information</h2>
                                <div class="box-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="student_no">Student Number</label>
                                                <input type="text" class="form-control" id="student_no">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="first_name">First Name</label>
                                                <input type="text" class="form-control" id="first_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="role">Role</label>
                                                <select name="role" class="form-control" id="role">
                                                    <option value="1">Admin</option>
                                                    <option value="2">Secretary</option>
                                                    <option value="3">Student</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email</label>
                                                <input type="text" class="form-control" id="email">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="password">Password</label>
                                                <input type="text" class="form-control" id="password">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="rep-password">Repeat Password</label>
                                                <input type="text" class="form-control" id="rep-password">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="department">Department</label>
                                                <select name="department" class="form-control" id="department">
                                                    <option value="1">CCSS</option>
                                                    <option value="2">BA</option>
                                                    <option value="3">CAS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="btn-container"><a class="btn btn-primary" href="">Submit</a></p>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-container">
                        <div class="box-container user-list">
                            <h2 class="title add">User List <a href="#"><span class="glyphicon glyphicon-plus"></span></a></h2>
                            <div class="box-content">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Role</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Rachelle</td>
                                            <td>Aton</td>
                                            <td>Admin</td>
                                            <td>CE</td>
                                            <td>
                                                <a class="delete" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                                                <a class="edit" data-toggle="modal" data-target=".modal-test" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Joshua</td>
                                            <td>Turingan</td>
                                            <td>Student</td>
                                            <td>CCSS</td>
                                            <td>
                                                <a class="delete" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                                                <a class="edit" data-toggle="modal" data-target=".modal-test" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Joshua</td>
                                            <td>Turingan</td>
                                            <td>Student</td>
                                            <td>CCSS</td>
                                            <td>
                                                <a class="delete" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                                                <a class="edit" data-toggle="modal" data-target=".modal-test" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Joshua</td>
                                            <td>Turingan</td>
                                            <td>Student</td>
                                            <td>CCSS</td>
                                            <td>
                                                <a class="delete" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                                                <a class="edit" data-toggle="modal" data-target=".modal-test" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Joshua</td>
                                            <td>Turingan</td>
                                            <td>Student</td>
                                            <td>CCSS</td>
                                            <td>
                                                <a class="delete" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                                                <a class="edit" data-toggle="modal" data-target=".modal-test" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Joshua</td>
                                            <td>Turingan</td>
                                            <td>Student</td>
                                            <td>CCSS</td>
                                            <td>
                                                <a class="delete" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                                                <a class="edit" data-toggle="modal" data-target=".modal-test" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-container add-user">
                            <h2 class="title">Add User Information</h2>
                            <div class="box-content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="student_no">Student Number</label>
                                            <input type="text" class="form-control" id="student_no">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="role">Role</label>
                                            <select name="role" class="form-control" id="role">
                                                <option value="1">Admin</option>
                                                <option value="2">Secretary</option>
                                                <option value="3">Student</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email</label>
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="password">Password</label>
                                            <input type="text" class="form-control" id="password">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="rep-password">Repeat Password</label>
                                            <input type="text" class="form-control" id="rep-password">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="department">Department</label>
                                            <select name="department" class="form-control" id="department">
                                                <option value="1">CCSS</option>
                                                <option value="2">BA</option>
                                                <option value="3">CAS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <p class="btn-container"><a class="btn btn-primary" href="">Submit</a></p>
                            </div>
                        </div>

                        <div class="box-container add-book">
                            <h2 class="title">Add Book Information</h2>
                            <div class="box-content">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="title">Title</label>
                                        <input type="text" class="form-control" id="title">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="year">Year</label>
                                        <input type="text" class="form-control" id="year">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="isbn">ISBN</label>
                                        <input type="text" class="form-control" id="isbn">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="author">AUTHOR</label>
                                        <input type="text" class="form-control" id="author">
                                    </div>
                                </div>
                                <p class="btn-container"><a class="btn btn-primary" href="">Submit</a></p>
                            </div>
                        </div>

                        <div class="box-container add-book-user">
                            <h2 class="title">Add Book User</h2>
                            <div class="box-content">
                                <div class="form-group">
                                    <label class="control-label" for="title">Book</label>
                                    <input type="text" class="form-control" id="title">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="year">User</label>
                                    <input type="text" class="form-control" id="year">
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="return_date">Return Date</label>
                                    <input type="date" class="form-control" id="return_date">
                                </div>
                                <p class="btn-container"><a class="btn btn-primary" href="">Submit</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ secure_asset('js/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('js/bootstrap.min.js') }}"></script>
</html>
