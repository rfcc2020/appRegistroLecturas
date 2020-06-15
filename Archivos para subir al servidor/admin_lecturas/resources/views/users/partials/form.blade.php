<div class="form-group">
	{{ Form::label('name', 'Nombre del usuario') }}
	{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
	{{ Form::label('email', 'Email del usuario') }}
	{{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) }}
</div>
<hr>
<h3>Lista de Sectores</h3>
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($sectores as $sector)
		@if (in_array($sector,$sectores_usr))
	    <li>
	        <label>

	        {{ Form::checkbox('sectores[]', $sector,1) }}
	        {{ $sector }}
	        </label>
	    </li>
	    @else
	    <li>
	        <label>

	        {{ Form::checkbox('sectores[]', $sector,0) }}
	        {{ $sector }}
	        </label>
	    </li>
	    @endif
	    @endforeach
    </ul>
</div>
<hr>
<h3>Lista de roles</h3>
<div class="form-group">
	<ul class="list-unstyled">
		@foreach($roles as $role)
	    <li>
	        <label>
	        {{ Form::checkbox('roles[]', $role->id, null) }}
	        {{ $role->name }}
	        <em>({{ $role->description }})</em>
	        </label>
	    </li>
	    @endforeach
    </ul>
</div>
<div class="form-group">
	{{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
</div>