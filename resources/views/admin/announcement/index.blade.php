@extends('admin.layout')

@section('content')
    @include('errors')
    @include('info')
    <div class="flex-container">
        <div class="box-container user-list">
            <h2 class="title">Announcement List</h2>
            <div class="box-content">
                <table class="table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Access Number </th>
                            <th>Title</th>
                            <th>Context</th>
                            <th>Announce Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as announcement)
                            <tr>
                                <td>{{str_pad($announcement->id, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$announcement->title}}</td>
                                <td>{{$announcement->context}}</td>
                                <td>{{$announcement->announce_date}}</td>
                                <td>{{$announcement->remarks}}</td>
                                <td>
                                    <a class="edit" href="/admin/announcement/{{$book->id}}"><span class="glyphicon glyphicon-repeat"></span></a>
                                    <a class="delete" href="/admin/announcement/{{$announcement->id}}/delete"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
