@extends('admin.layout')

@section('content')
    <div class="flex-container">
        <div class="box-container">
            <h2 class="title">Settings</h2>
            <div class="box-content">
                @include('errors')
                @include('info')
                <table class="settings-table table data-table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                <td>{{$setting->title}}</td>
                                <td>
                                    {{$setting->value}} 
                                    @if($setting->id == 3 || $setting->id == 4)
                                        Days
                                    @elseif($setting->id == 5 || $setting->id == 6)
                                        Pesos
                                    @endif
                                </td>
                                <td>
                                    <a class="edit" href="/admin/settings/{{$setting->id}}"><span class="glyphicon glyphicon-pencil"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
