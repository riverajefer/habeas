<html>
    <table>
        <tbody>
            <tr>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Tipo de documento</th>
                <th>Número de documento</th>
                <th>Fecha de nacimiento</th>
                <th>Profesión</th>
                <th>Cargo</th>
                <th>Empresa</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Área</th>
                <th>Procedencia del registro</th>
                <th>Creado por</th>
                <th>Modificado por</th>
                <th>Estado</th>  
                <th>Fecha de creación</th>  
                <th>Fecha de modificación</th>  
            </tr>
            @foreach($registros as $registro)
                <tr>
                    <td>{{$registro->nombre}}</td>
                    <td>{{$registro->primer_apellido}}</td>
                    <td>{{$registro->segundo_apellido}}</td>
                    <td>{{$registro->tipo_documento}}</td>
                    <td>{{$registro->doc}}</td>
                    <td>{{$registro->fecha_nacimiento}}</td>
                    <td>{{$registro->profesion}}</td>
                    <td>{{$registro->cargo}}</td>
                    <td>{{$registro->empresa}}</td>
                    <td>{{$registro->telefono}}</td>
                    <td>{{$registro->email}}</td>
                    <td>{{$registro->municipio->ndepartamento->nombre or ''}}</td>
                    <td>{{$registro->municipio->nombre_municipio or ''}}</td>
                    <td>{{$registro->area->titulo or 'sin seleccionar'}}</td>
                    <td>{{$registro->procedencia}}</td>
                    <td>{{$registro->creadoPor->nombre or ''}}</td>
                    <td>{{$registro->modificadoPor->nombre or ''}}</td>
                    <td>{{$registro->estado ? 'Activo': 'Dado de baja'}}</td>
                    <td>{{$registro->created_at}}</td>
                    <td>{{$registro->updated_at}}</td>
                </tr> 
            @endforeach
        </tbody>
    </table>
</html>