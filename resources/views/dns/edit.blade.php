@extends('layouts.app', ['activePage' => 'dns', 'titlePage' => __('Editer DNS')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('dns.update')}}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            
            <div class="card ">
              <div class="card-header card-header-primary">
              @if(isset($typeEnre) && $typeEnre == 'Zone')              
                <h4 class="card-title">{{ __('Modifier une zone') }}</h4>
                <p class="card-category">{{ __('Informations de la zone') }}</p>
                
              @endif

              @if(isset($typeEnre) && $typeEnre == 'a')              
                <h4 class="card-title">{{ __('Modifier un enregistrement de type A') }}</h4>
                <p class="card-category">{{ __('Informations de l\'enregistrement') }}</p>

              @endif
              @if(isset($typeEnre) && $typeEnre == 'cname')              
                <h4 class="card-title">{{ __('Modifier un enregistrement de type CNAME') }}</h4>
                <p class="card-category">{{ __('Informations de l\'enregistrement') }}</p>
              @endif
              @if(isset($typeEnre) && $typeEnre == 'ptr')              
                <h4 class="card-title">{{ __('Modifier un enregistrement de type PTR') }}</h4>
                <p class="card-category">{{ __('Informations de l\'enregistrement') }}</p>
              @endif
                
               
              </div>
              <div class="card-body ">
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
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nom') }}" value="{{ $name }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                      <input type ="hidden" name="lastElement" value="{{ $elementSpecial }}"/>
                      <input type ="hidden" name="type" value="{{ $typeEnre }}"/>
                    </div>
                  </div>
                </div>.
                <!----------->
                @if(isset($typeEnre) && $typeEnre == 'a')
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Adresse IP') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('ip') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" id="input-ip" type="text" placeholder="{{ __('') }}" value="{{ $elementSpecial }}" required="true" />
                      @if ($errors->has('ip'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('ip') }}</span>
                      @endif
                @endif

                @if(isset($typeEnre) && $typeEnre == 'cname')
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('cname') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('ip') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="cnamu" id="input-ip" type="text" placeholder="{{ __('') }}" value="{{ $elementSpecial }}" required />
                      @if ($errors->has('ip'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('ip') }}</span>
                      @endif
                @endif 
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
              
                <button type="submit" class="btn btn-primary">{{ __('Modifier') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection