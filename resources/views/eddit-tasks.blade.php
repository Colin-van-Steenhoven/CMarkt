@extends('layouts.base')
@section('content')
<img src="img/NL-sticker.jpg" alt="">
<form method="POST"   enctype="multipart/form-data">
  @csrf
    <div class="container contact">
        <div class="row">
            <div class="col-md-9">
              <h2>Voeg hier een taak toe</h2>
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
                  
                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-lg btn-primary mt-3" value="Aanbod afronden">
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection