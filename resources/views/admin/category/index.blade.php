@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container add-user">
            <h2 class="title">Add Category Information</h2>
            {{Form::open(['url' => '/admin/categories'])}}
            <div class="box-content">
                @include('errors')
                @include('info')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('name','Category Name', ['class' => 'control-label'])}}
                            {{Form::text('name', null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
                <p class="btn-container">
                {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
                </p>
            </div>
            {{Form::close()}}
        </div>
        <div class="box-container user-list">
            <h2 class="title">Category List</h2>
            <div class="box-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->created_at}}</td>
                                <td>
                                    <a class="edit" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a class="delete" href="/admin/category/{{$category->id}}/delete"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$categories->links()}}
            </div>
        </div>
    </div>
@endsection
