@extends('homepage.layout')

@section('content')
    <div class="homepage-container">
        <section class="announcement">
            <h2 class="section-title">Announcements</h2>
            <ul class="sec-list">
                @foreach($announcements as $announcement)
                    <li>
                        <p class="title">{{ $announcement->title }}</p>
                        <p class="context">{{ $announcement->context }}</p>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@stop
