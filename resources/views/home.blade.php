@extends('layouts.base')

@section('content')

<div class="headTextEventList">
    <h1>C punten opdrachten</h1>
</div>
@if (session()->has('message'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('message') }}
    </div>
@endif

<style>
    .card-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .card-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }

        .carousel-indicators {
            display: none;
        }

        .carousel-inner {
            width: fit-content;
            margin: 0 auto;
        }

        .swipe-text {
            text-align: center;
            font-size: 14px;
            margin-top: 1rem;
        }

        .card-wrapper .card {
            margin-bottom: 20px;
            
        }
        
    }

    .tag {
    background-color: #e8e8e8;
    border-radius: 4px;
    padding: 2px 6px;
    margin-right: 5px;
    font-weight: bold;
    color: #333;
}


</style>

<script>
  // Controleren of het apparaat een mobiel apparaat is
  function isMobileDevice() {
      return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
  }
</script>
<form action="{{ route('filtered') }}" method="GET">
    @csrf
    <div class="form-group">
        <label for="tags">Filter op tags:</label>
        <div class="btn-group-toggle" data-toggle="buttons">
            @foreach ($tags as $tag)
                <label class="btn btn-outline-primary {{ in_array($tag->name, request('tags', [])) ? 'active' : '' }}"  style=" margin-bottom: 20px; margin-right: 10px;">
                    <input type="checkbox" name="tags[]" value="{{ $tag->name }}" autocomplete="off" {{ in_array($tag->name, request('tags', [])) ? 'checked' : '' }}>
                    {{ $tag->name }}
                </label>
            @endforeach
            <button style=" margin-bottom: 20px;" type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

<div class="card-wrapper container-sm">
    <div id="carouselExampleControls" class="carousel carousel-dark slide">
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
                                <div class="card-body" style="height: 200px">
                                    <h3 class="card-title">{{ $task->titel }}</h3>
                                    <p class="card-text">{{ Illuminate\Support\Str::of($task->description)->limit(150) }}</p>
                                    <div class="tags">
                                        @foreach($tasktags[$task->id] as $key => $tag)
                                            <span class="tag">{{ $tag->name }}</span>
                                            @if($key !== count($tasktags[$task->id]) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="card-footer">
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
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script>
    if (isMobileDevice()) {
        var cardWrapper = document.querySelector('.card-wrapper');
        var swipeText = document.createElement('div');
        swipeText.classList.add('swipe-text');
        swipeText.innerText = 'Swipe om meer kaarten te zien';
        cardWrapper.appendChild(swipeText);
    }
</script>

@endsection
