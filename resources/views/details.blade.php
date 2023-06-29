@extends('layouts.base')

@section('content')
@if (session()->has('message'))

<div class="alert alert-info" role="alert">
    {{ session()->get('message') }}
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="position-relative bg-dark text-white">
                <img src="{{ url('public/Image/'.$tasks->image) }}" class="img-fluid w-100 d-flex align-items-center" alt="Background Image" style="max-height: 300px; object-fit: cover;">
                <h2 class="position-absolute bg-dark mt- top-50 start-50 mt-1 translate-middle text-center fw-bold">
                    {{ $tasks->titel }}
                </h2>
            </div>
        </div>
    </div>
</div>

<p>
    {{ $tasks->description }}
</p>
<p>
    Aantal C-punten: {{ $tasks->points }}
</p>
@if ($tasks->users->contains(Auth::user())) 
    <p class=" bg-success">Je staat al ingeschreven</p>
@else
    <a href="{{ route('assign_to_task', $tasks->id) }}" class="btn btn-primary">Aanmelden voor deze activiteit</a>
@endif

@endsection
