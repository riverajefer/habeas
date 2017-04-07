<div>
	<h4>
		Hola: 
		{{$registro->nombre}} {{$registro->primer_apellido}} 
	</h4>
	<p>
		Gracias por registrar sus datos en Annardx.
	</p>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<a href="{{URL::to('formulario/baja/'.$registro->id)}}" style="color:#ccc;">
		<em>Cancelar suscripción</em>
	</a>


</div>