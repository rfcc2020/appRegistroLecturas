@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medidor</div>

                <div class="panel-body">                                        
                    <p><strong>Código</strong>      {{ $medidor->codigo }}</p>
                    <p><strong>Número</strong>      {{ $medidor->numero }}</p>
                    <p><strong>Marca</strong>      {{ $medidor->marca }}</p>
                    <p><strong>Modelo</strong>      {{ $medidor->modelo }}</p>
                    <p><strong>Sector</strong>      {{ $medidor->sector }}</p>
                    <img class="card-img-top" src="http://localhost/admin_lecturas/public/images/{{$medidor->imagen}}" alt="">
                    <p><strong>Persona</strong>    {{ $medidor->persona_id }}</p>
                    <p><strong>Latitud</strong>    {{ $medidor->latitud }}</p>
                    <p><strong>Longitud</strong>    {{ $medidor->longitud }}</p>
                    <p><strong>Estado</strong>  {{ $medidor->estado }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection