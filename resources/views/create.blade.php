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
<form method="POST" action="{{ route('create-task') }} " enctype="multipart/form-data">
  @csrf
    <div class="contact mt-2 p-4">
        <div class="row">
              <h2 class="text-center">Voeg hier een taak toe</h2>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="titel">Titel</label>
                      <input id="titel" type="text" name="titel" class="form-control">
                  </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="points">C punten</label>
                        <input id="points" type="number" name="points" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="places">Aantal plaatsen</label>
                        <input id="places" type="number" name="places" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Beschrijving</label>
                        <textarea id="description" type="description" name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="tag_ids">Tags </label>
                      <select name="tag_ids[]" id="tag_ids" multiple class="select2">
                          @foreach($tags as $tag)
                              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                          @endforeach
                      </select>
                      <p>houd CTRL ingedrukt om meerdere te kiezen</p>
                  </div>
              </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="image"></label>
                        <input type="file" name="image" >
                    </div>
                  </div class="mb-20">      
                        <input type="submit" class="btn btn-lg btn-primary mt-3" value="Aanbod afronden">
            </div>
        </div>
</form>
@endsection