@extends('layouts.base')

@section('content')
@if (session()->has('message'))

<div class="alert alert-info" role="alert">
    {{ session()->get('message') }}
</div>
@endif
@if ($tasks->users->contains(Auth::user()))
    <p class=" bg-success rounded text-light">Je staat al ingeschreven</p>
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

<h4 class="poop">
    {{ $tasks->description }}
</h4>
<p>
    Aantal te behalen C-punten: {{ $tasks->points }}
</p>
<h2>Assigned Users</h2>
<ul>
    @foreach ($assignedUsers as $user)
        <li>{{ $user->name }}</li>
        
    @endforeach
</ul>
@if ($tasks->users->contains(Auth::user())) 
    
    <a href="{{ route('remove_from_task', $tasks->id) }}" class="btn btn-primary">Uitschijven voor deze activiteit</a>
@else
    <a href="{{ route('assign_to_task', $tasks->id) }}" class="btn btn-primary">Inschrijven voor deze activiteit</a>
@endif

@endsection
