<!--ce code html correspond à la page d'accueil de l'application avant connexion-->

@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Network Manager')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <br/><br/><br/>
          <h1 class="text-white text-center">{{ __('Bienvenue sur l\'interface d\'administration des services réseaux de CUB ') }}</h1> <!--ce code html correspond à la page d'accueil de l'application avant la connexion-->
      </div>
  </div>
</div>
@endsection
