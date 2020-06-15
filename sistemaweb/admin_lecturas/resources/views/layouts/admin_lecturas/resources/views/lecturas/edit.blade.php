@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Requerimientos</div>

                <div class="panel-body">                    
                    {!! Form::model($requerimiento, ['route' => ['requerimientos.update', $requerimiento->id],
                    'method' => 'PUT']) !!}

                        @include('requerimientos.partials.form')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection