@extends('layouts.base')

@section('content')

<div class="headTextEventList">
    <h1>C punten opdrachten </h1>
</div>
@if (session()->has('message'))

    <div class="alert alert-info" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

<style>
    .carousel-control-prev,
    .carousel-control-next {
      width: 2%;
      top: auto;
      bottom: 50%;
      transform: translateY(50%);
      font-size: 1.5rem;
    }

    .carousel-control-next-icon,
    .carousel-control-prev-icon {
      height: 30px;
      width: 30px;
    }
    .card-img-top {
    width: 100%;
    height: 200px; /* Pas dit aan naar de gewenste hoogte */
    object-fit: cover;
  }
  </style>
<div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="8000">
    <div class="carousel-inner">
      @foreach ($tasks->chunk(4) as $index => $chunk)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
          <div class="card-wrapper container-sm d-flex justify-content-around">
            @foreach ($chunk as $task)
              <div class="card" style="width: 18rem;">
                @if ($task->image != "")
                  <img src="{{ url('public/Image/'.$task->image) }}" class="card-img-top" alt="Card image">
                @else
                  <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder image">
                @endif
                <div class="card-body">
                  <h5 class="card-title">{{ $task->titel }}</h5>
                  <p class="card-text">{{ $task->description }}</p>
                  <a href="{{ route('details',$task->id) }}" class="btn btn-dark btn-border btn-send col-md-12 text-center">Meer info</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@endsection