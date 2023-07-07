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





</style>

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







@endsection
