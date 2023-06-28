@extends('layouts.app')

@section('content')
<img src="img/NL-sticker.jpg" alt="">
<form method="POST" action="{{ route('save-Car-form') }} " enctype="multipart/form-data">
  @csrf
    <div class="container contact">
        <div class="row">
          
            <div class="col-md-3">
                <div class="contact-info">
                    
                    <h2>Voeg hier een taak toe</h2>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="Titel">Titel</label>
                      <input id="Titel" type="text" name="Titel" class="form-control">
                  </div>
              </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="points">C punten</label>
                        <input id="points" type="text" name="points" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="Detail">Beschrijving</label>
                        <textarea id="Detail" type="description" name="Detail" class="form-control"></textarea>
                    </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="photo"></label>
                        <input type="file" name="photo" >
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