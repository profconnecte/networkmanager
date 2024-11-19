@extends('layouts.app', ['activePage' => 'Services de CUB', 'titlePage' => __('Edit link')])
@section('content')
<br> <br> <br>
<form method="post" action="{{ route('link.update', ['id' => $link->id]) }}">
  @csrf
  @method('post')
  <div class="card">
    <div class="card-header card-header-danger">
      <h4 class="card-title">{{ __('Modifier un Enregistrement') }}</h4>
    </div>

    <div class="card-body">
      @if (session('status'))
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span>{{ session('status') }}</span>
          </div>
        </div>
      </div>
      @endif

      <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Nom du site') }}</label>
        <div class="col-sm-7">
          <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nomSite" type="text" placeholder="{{ __('Nom du site') }}" value="{{ $link->nomSite }}" required="true" aria-required="true" />
          </div>
        </div>
      </div>

      <div class="row" id="input_ip">
        <label class="col-sm-2 col-form-label">{{ __(' Lien') }}</label>
        <div class="col-sm-7">
          <div class="form-group{{ $errors->has('ip') ? ' has-danger' : '' }}">
            <input class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="lien" type="text" placeholder="{{ __('Lien') }}" value="{{ $link->lien }}" />
          </div>
        </div>
      </div>

      <div class="card-footer ml-auto mr-auto">
        <button type="submit" class="btn btn-danger">{{ __('Modifier') }}</input>
      </div>
    </div>
</form>
@endsection