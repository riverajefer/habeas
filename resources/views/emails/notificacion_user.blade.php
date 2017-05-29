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

	<p>Dar clic en el siguiente enlace para cancelar suscripción</p>
	<a href="{{URL::to('formulario/baja/'.$registro->id)}}" style="color:#a5a0a0;">
		<em>Cancelar suscripción</em>
	</a>


</div>