@extends('layouts.base')

@section('content')

<div class="headTextEventList">
    <h1>Mijn gemaakte taken</h1>
</div>
@if (session()->has('message'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

<div class="card-wrapper container-sm">
    <div class="row row-cols-1 row-cols-md-4">
        @foreach ($tasks->chunk(4) as $chunk)
            @foreach ($chunk as $task)
                <div class="col mb-4">
                    <div class="card" style="width: 18rem;">
                        @if ($task->image != "")
                            <img src="{{ url('public/Image/'.$task->image) }}" class="card-img-top" alt="Card image">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder image">
                        @endif
                        <div class="card-body" style="height: 200px">
                            <h3 class="card-title">{{ $task->titel }}</h3>
                            <a href="{{ route('details',$task->id) }}" class="btn btn-dark mb-3 btn-border btn-send col-md-12 text-center">Meer info</a>
                            <a href="{{ route('eddit-tasks',$task->id) }}" class="btn btn-dark  mb-3 btn-border btn-send col-md-12 text-center">Bewerk taak</a>
                            <a href="{{ route('delete-task',$task->id) }}" class="btn btn-dark btn-border btn-send col-md-12 text-center">Delete taak</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@endsection
