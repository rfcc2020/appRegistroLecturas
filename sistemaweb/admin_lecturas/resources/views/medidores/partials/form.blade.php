<div class="form-group">
	{{ Form::label('Codigo', 'Codigo') }}
	{{ Form::text('codigo', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Número', 'Número') }}
	{{ Form::text('numero', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Marca', 'Marca') }}
	{{ Form::text('marca', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Modelo', 'Modelo') }}
	{{ Form::text('modelo', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Sector', 'Sector') }}
	{{ Form::select('sector', array('la union' => 'La Unión', 'portete' => 'Portete','pedregal' => 'Pedregal','rayoloma' => 'Rayoloma'), 'S', ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('Imagen', 'Imagen') }}
	{{ Form::file('imagen', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::label('idpersona', 'Id del Abonado') }}
	{{ Form::text('persona_id', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>