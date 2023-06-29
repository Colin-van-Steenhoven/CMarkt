@extends('layouts.base')
@section('content')
<img src="img/NL-sticker.jpg" alt="">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('eddit-tasks', $tasks->id)}}"   enctype="multipart/form-data">
  @csrf
  <div class="mt-2 p-4">
    <div class="row">
          <h2 class="text-center">Verander hier een taak</h2>
            <div class="col-md-6">
              <div class="form-group">
                      <label for="titel">Titel</label>
                      <input id="titel" type="text" name="titel" value="{{ $tasks->titel }}" class="form-control">
                  </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="points">C punten</label>
                        <input id="points" type="number" name="points" value="{{ $tasks->points }}" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="places">Aantal plaatsen</label>
                        <input id="places" type="number" name="places" value="{{ $tasks->places }}" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Beschrijving</label>
                        <textarea id="description" type="description" name="description" class="form-control">{{ $tasks->description }}</textarea>
                    </div>
                </div>
                         
                        <input type="submit" class="btn btn-lg btn-primary mt-3"  value="Aanbod afronden">
                </div>
            </div>
</form>
@endsection