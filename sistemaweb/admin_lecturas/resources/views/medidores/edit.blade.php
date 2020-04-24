@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Medidores</div>

                <div class="panel-body">                    
                    {!! Form::model($medidor, ['route' => ['medidores.update', $medidor->id],
                    'method' => 'PUT','files' => 'true']) !!}

                        @include('medidores.partials.form')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection