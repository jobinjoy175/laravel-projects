@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Statistics</h1>
    <h2>Average Events Per User: {{ $averageEventsPerUser }}</h2>
    <h3>Events Created by Each User</h3>
    <ul class="list-group">
        @foreach ($users as $user)
            <li class="list-group-item">
                <strong>{{ $user['name'] }}:</strong> {{ $user['average'] }} events
            </li>
        @endforeach
    </ul>
</div>
@endsection