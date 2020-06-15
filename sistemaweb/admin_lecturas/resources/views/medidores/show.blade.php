@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medidor de consumo de agua</div>

                <div class="panel-body">                                        
                    <p><strong>Código</strong>      {{ $medidor->codigo }}</p>
                    <p><strong>Número</strong>      {{ $medidor->numero }}</p>
                    <p><strong>Marca</strong>      {{ $medidor->marca }}</p>
                    <p><strong>Modelo</strong>      {{ $medidor->modelo }}</p>
                    <p><strong>Sector</strong>      {{ $medidor->sector }}</p>
                    <img class="card-img-top" src="http://localhost/admin_lecturas/public/images/{{$medidor->imagen}}" alt="">
                    <p><strong>CI</strong>    {{ $abonado->cedula }}</p>
                    <p><strong>Nombre</strong>    {{ $abonado->nombre }}</p>
                    <p><strong>Apellido</strong>    {{ $abonado->apellido }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection