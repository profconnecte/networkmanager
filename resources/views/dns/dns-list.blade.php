@extends('layouts.app', ['activePage' => 'dns', 'titlePage' => __('Liste des enregistrements DNS')])

@section('content')
<div class="content">

    <div class="col ml-5" style="width: 100%;">
        <div style="width: 50%; height: 100px; float: left;"> 
        <a href="{{ route('dns.ajout')}}" class="btn btn-success">Ajouter un nouvel enregistrement</a>
        </div>
        <div style="margin-left: 50%; height: 100px;"> 
            
        </div>


  <div class="container-fluid">
  @if(isset($nameDns) && isset($result))
    <div class="row">
      <div class="col-12">
        {!! $resultat !!}
      </div>
    </div>
  @endif
    <div class="col-12 ml-0">
      <div class="card">
          <div class="card-header card-header-text card-header-primary"></div>
          <div class="card-body">
              Sur cette page vous pouvez sélectionné les enregistrements de la zone cub.org, vous pouvez donc ajouter, modifier et supprimer des enregistrements.
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-2.5 ml-4">
        <p> </p>
        <p>Affichez les informations de </p>
      </div>
      <div class="col-6 ">
      @csrf
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  
            @if(isset($type))
            {{$type}}
            @else
            Enregistrements
            @endif
  
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('dns.display', ['records' => 'zone'] )}}">Zone</a>
            <a class="dropdown-item" href="{{ route('dns.display', ['records' => 'enregistrements a'] )}}">Enregistrements A</a>
            <a class="dropdown-item" href="{{ route('dns.display', ['records' => 'enregistrements cname'] )}}">Enregistrements CNAME</a>
        </div>
      </div>
      </div>
 <!-- ancien bouton enregistrement-->
    </div>
    <div class="row">
      <div class="col-12">

          <br/>

          @csrf
          <div class="card-body">

            @if(isset($type) && $type == 'zone')

            <p class="alert success">{!! $RecupZone !!}</p>

            @endif
            
            
            @if(isset($type) && $type == 'enregistrements a')
            <h3> Enregistrements de type A </h3>

              <div class="tab-pane">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Nom</th>
                      <th>Adresse IP</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @include('partials.enregistrement', ['tab' => $tabEnregistrement])
                    
                  </tbody>
                </table>
              </div>
              @endif
              @if(isset($type) && $type == 'enregistrements cname')
              <h3> Enregistrements de type cname </h3>
              <div class="tab-pane">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Name</th>
                      <th>Cname</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @include('partials.enregistrement', ['tab' => $tabEnregistrement])
                  </tbody>
                </table>
              </div>
              @endif
              </div>
            </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection