<div>
	<h4>
		Actualización o Registro  de datos para el usuario: 
		{{$registro->nombre}} {{$registro->primer_apellido}} 
	</h4>
	<ul>	
		<li>
			Empresa: {{$registro->empresa or ''}}
		</li>
		<li>
			Fecha: {{$registro->created_at}}
		</li>
		<li>
			Area de Interes: {{$registro->area->titulo}}
		</li>
		<li>
			Verifique la información para la respectiva gestión, 
			<a href="http://190.145.89.228/habeas/public/registros/{{$registro->id}}">Aquí</a>
		</li>
	</ul>
</div>