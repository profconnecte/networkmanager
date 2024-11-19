@extends('layouts.app', ['activePage' => 'Tableau De Bord', 'titlePage' => __('dashboard')])

@section('content')
  <div class="content">
    <!--Ce code HTML correspond à la page de l'application après connexion--> 
    <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <div class="card card-stats" style="background-color:#2FDFBB">
            
              
              <p style="text-align:center; padding-right:5px;padding-left:5px;font-weight:bold;color:#F0F0F0"> <br>
              Nombre d'élément(s) de type A :</p>
              <center><h3 class="card-title" style="font-weight:bold;color:#F0F0F0"> {!! $nb_ip !!}
                
              </h3><p style="font-weight:bold;color:#F0F0F0"> Élément(s)</p></center>
            
            <div class="card-footer">
              <div class="stats">
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card card-stats" style="background-color:#B359E2">
            
              
              <p style="text-align:center; padding-right:5px;padding-left:5px;font-weight:bold;color:#F0F0F0"> <br>
              Nombre d'élément(s) de type CNAME :</p>
              <center><h3 class="card-title" style="font-weight:bold;color:#F0F0F0"> {!! $nbCname !!}
                
              </h3><p style="font-weight:bold;color:#F0F0F0"> Élément(s)</p></center>
            
            <div class="card-footer">
              <div class="stats">
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card card-stats" style="background-color:#5F98FF">
            
              
              <p style="text-align:center; padding-right:5px;padding-left:5px;font-weight:bold;color:#F0F0F0"> <br>
              Nombre d'élément(s) de type PTR :</p>
              <center><h3 class="card-title" style="font-weight:bold;color:#F0F0F0"> {!! $nbPTR !!}
                
              </h3><p style="font-weight:bold;color:#F0F0F0"> Élément(s)</p></center>
            
            <div class="card-footer">
              <div class="stats">
              </div>
            </div>
          </div>
        </div>
     </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush