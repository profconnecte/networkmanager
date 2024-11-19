@extends('layouts.app', ['activePage' => 'Services de CUB', 'titlePage' => __('link')])

@section('content')
</br> </br> </br> </br>
<div class="col12-md-6">
    <div class="card">
        <div class="card-header card-header-danger">
            <h4 class="card-title"><i class="material-icons">language</i> Liens vers les différents services : </h4>
        </div>
    <div class="tab-pane">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Nom du site</th>
                    <th>lien</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($link as $link)
                <tr>
                    <th class="text-center">{{htmlspecialchars($loop->iteration)}}</th>
                    <th>{{ $link->nomSite }}</th>
                    <th><a href="{{ $link->lien }}">{{ $link->lien }}</a></th>
                    <th class="td-actions text-left"><a href="/link/edit/{{ $link->id }}" class="btn btn-success btn-round"><i class="material-icons">edit</i></a>
                        <a href='/link/delete/{{ $link->nomSite }}'class="btn btn-danger btn-round"><i class="material-icons">delete</i></a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        </br>
    <a href="{{Route('link.ajout')}}" class="btn btn-danger">Ajout d'un nouvel enregistrement</a>       
</div>
@endsection