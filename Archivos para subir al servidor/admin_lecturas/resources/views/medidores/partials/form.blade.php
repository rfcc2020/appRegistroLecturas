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
	{{ Form::select('sector', array('La unión' => 'La Unión', 'Portete' => 'Portete','Pedregal' => 'Pedregal','Rayoloma' => 'Rayoloma'),$medidor->sector, ['class' => 'form-control'])}}

</div>
<div class="form-group">
	{{ Form::label('Imagen', 'Imagen') }}
	{{ Form::file('imagen', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::hidden('persona_id', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>