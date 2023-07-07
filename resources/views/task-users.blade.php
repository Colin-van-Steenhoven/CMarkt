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
<p>
    Aantal te behalen C-punten: {{ $tasks->points }}
</p>

<h2>Assigned Users</h2>
<table class="table">
    <thead>
        <tr>
            <th>Gebruiker</th>
            <th>Punten gekregen</th>
            <th>Actie</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($assignedUsers as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->points }}</td>
            <td>
                <form method="post" action="{{ route('add-points', $tasks->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="input-group">
                        <input type="number" name="points" min="0" class="form-control">
                        <button type="submit" class="btn btn-primary">Toewijzen</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
