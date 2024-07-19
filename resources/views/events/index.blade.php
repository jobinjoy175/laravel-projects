@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Events</h1>
    <form id="search-form" method="GET" action="{{ route('events.index') }}">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" name="search" placeholder="Search events name">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" name="start_date">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" name="end_date">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <ul class="list-group">
        @foreach ($events as $event)
            <li class="list-group-item">
                <h5>{{ $event->name }}</h5>
                <p><strong>Start Date:</strong> {{ $event->start_date }}</p>
                <p><strong>End Date:</strong> {{ $event->end_date }}</p>
            </li>
        @endforeach
    </ul>

    <div class="mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center">
                @if ($events->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $events->previousPageUrl() }}" aria-label="Previous">Previous</a>
                    </li>
                @endif

                @if ($events->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $events->nextPageUrl() }}" aria-label="Next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>

@endsection