@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">lectura</div>

                <div class="panel-body">                                        
                    <p><strong>Fecha</strong>      {{ $lectura->fecha }}</p>
                    <p><strong>Nombre</strong>      {{ $lectura->nombre }}</p>
                    <p><strong>Apellido</strong>    {{ $lectura->apellido }}</p>
                    <p><strong>Codigo medidor</strong>  {{ $lectura->codigo }}</p>
                    <p><strong>Anterior</strong>    {{ $lectura->anterior }}</p>
                    <p><strong>Actual</strong>      {{ $lectura->actual }}</p>
                    <p><strong>Consumo</strong>  {{ $lectura->consumo }}</p>
                    <p><strong>Básico</strong>  {{ $lectura->basico }}</p>
                    <p><strong>Exceso</strong>  {{ $lectura->exceso }}</p>
                    <p><strong>Observacion</strong>  {{ $lectura->observacion }}</p>
                    <img class="card-img-top" src="http://localhost/admin_lecturas/public/images/{{$lectura->imagen}}" alt="">
                    <p><strong>Latitud</strong>  {{ $lectura->latitud }}</p>
                    <p><strong>Longitud</strong>  {{ $lectura->longitud }}</p>
                    <p><strong>Estado</strong>  {{ $lectura->estado }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection