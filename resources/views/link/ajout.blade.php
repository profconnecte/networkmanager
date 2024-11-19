@extends('layouts.app', ['activePage' => 'Services de CUB', 'titlePage' => __('Ajout link')])

@section('content')
<br> <br> <br>
<form method="post" action="{{ route('link.create') }}">
          @csrf
          @method('post')
          <div class="card">
            <div class="card-header card-header-danger">
              <h4 class="card-title">{{ __('Ajouter un Enregistrement') }}</h4>
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
                  <div class="form-group{{ $errors->has('nomSite') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('nomSite') ? ' is-invalid' : '' }}" name="nomSite" type="text" placeholder="{{ __('Nom du site') }}" required="true" aria-required="true" />

                  </div>
                </div>
              </div>

              <div class="row" id="input_ip">
                <label class="col-sm-2 col-form-label">{{ __(' Lien') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('lien') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('lien') ? ' is-invalid' : '' }}" name="lien" type="text" placeholder="{{ __('Lien') }}" />
                  </div>
                </div>
              </div>
              
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-danger">{{ __('Ajouter') }}</input>
              </div>
            </div>
        </form>
@endsection