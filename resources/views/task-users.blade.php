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
                <h2 class="position-absolute bg-dark mt-1 top-50 start-50 translate-middle text-center fw-bold">
                    {{ $tasks->titel }}
                </h2>
            </div>
        </div>
    </div>
</div>



<h2>Assigned Users</h2>
<ul>
    @foreach ($assignedUsers as $user)
        <li>{{ $user->name }}</li>
        <form method="post" action="{{ route('add-points', $tasks->id) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <label for="pointsInput">Points:</label>
            <input type="number" name="points" min="0">
            <button type="submit">Assign</button>
        </form>
    @endforeach
</ul>









@endsection