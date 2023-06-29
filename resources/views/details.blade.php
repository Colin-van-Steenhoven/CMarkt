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
                <img id="detailImage" src="{{ url('public/Image/'.$tasks->image) }}" class="img-fluid w-100 d-flex align-items-center" alt="Background Image" style="max-height: 300px; object-fit: cover;">
                <h2 class="position-absolute bg-dark mt-1 top-50 start-50 translate-middle text-center fw-bold">
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
    <p class=" bg-success d-inline-block rounded text-light">Je staat al ingeschreven</p>
    <a href="{{ route('remove_from_task', $tasks->id) }}" class="btn btn-primary">Aanmelden voor deze activiteit</a>
@else
    <a href="{{ route('assign_to_task', $tasks->id) }}" class="btn btn-primary">Aanmelden voor deze activiteit</a>
@endif

@endsection
