<div>
	<h4>
		Evento:  {{$evento or 'Nuevo Registro'}}
		Usuario: {{$registro->nombre}} {{$registro->primer_apellido}} 
	</h4>
	<ul>	
		<li>
			Empresa: {{$registro->empresa or ''}}
		</li>
		<li>
			Fecha: {{$registro->created_at}}
		</li>
		<li>
			Área: {{$registro->area->titulo}}
		</li>
		<li>	
			<b>ORIGEN:</b> {{$origen or 'USUARIO'}}
		</li>
		<li>
			Ver Registro, 
			<a href="{{URL::to('registros/'.$registro->id)}}">Aquí</a><br>
		</li>
	</ul>
</div>