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
{{-- <p class="user-points">Your Points: 
    @if (Auth::user()->cpoints =! null)
    {{ Auth::user()->cpoints }}
    
    @elseif (Auth::user()->cpoints == null)
    Nog geen C punten verdiend
    @endif
</p> --}}
<div class="row card-margin">
    @foreach ($tasks as $task)
        <div class="card bg mb-3 mx-auto" style="width: 17rem;">
            @if ($task->image != "")
                            <img class="card-img-top" src="{{ url('public/Image/'.$task->image) }}">
                    @else
                        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
                    @endif
            
            <div class="card-body">
            <h5 class="card-title text-center">{{ $task->titel }}</h5>
            <p class="card-text text-center">{{ $task->description }}</p>
            <a href="#" class="btn btn-dark btn-border btn-send col-md-12 text-center">Meer info</a>
            </div>
        </div>
    @endforeach
</div>
@endsection