@extends('layouts.app', ['activePage' => 'dns', 'titlePage' => __('Ajout DNS')])

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    // Hide inputs by default
    $("#input_cname").hide();
    $("#input_ip").hide();
    $('#type').on('change', function() {
      var demovalue = $(this).val();
      if (demovalue === "A") {
        $("#input_cname").hide();
        $("#input_ip").show();
      } else {
        $("#input_ip").hide();
        $("#input_cname").show();
      }
    });
  });
</script>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('dns.createData') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('post')
          <div class="card">
            <div class="card-header card-header-primary">
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
                <label class="col-sm-2 col-form-label">{{ __('Nom') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nom') }}" required="true" aria-required="true" />
                    @if ($errors->has('name'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Type') }}</label>
                <div class="form-group">
                  <select id="type" name="type" class="custom-select">
                    @if(isset($type))
                    <option selected>Enregistrements {{$type}}</option>
                    @else
                    <option selected>Enregistrements</option>
                    @endif

                    <option value="A">Enregistrements A</option>
                    <option value="CNAME">Enregistrements CNAME</option>
                  </select>
                  <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
              </div>

              <div class="row" id="input_ip">
                <label class="col-sm-2 col-form-label">{{ __('Adresse IP') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('ip') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" id="input-ip" type="text" placeholder="{{ __('Adresse IP') }}" />
                    @if ($errors->has('ip'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('ip') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row" id="input_cname">
                <label class="col-sm-2 col-form-label">{{ __('Alias') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('cname') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('cname') ? ' is-invalid' : '' }}" name="cname" id="input-cname" type="text" placeholder="{{ __('Alias') }}" />
                    @if ($errors->has('cname'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('cname') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Ajouter') }}</input>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection