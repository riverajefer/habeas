<html>
<style>
.tr_inactivo{
    background-color:#F5A9A9;
}
</style>
    <table border="1">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Tipo Doc</th>
                <th>Documento</th>
                <th>Fecha nacimiento</th>
                <th>Email personal</th>
                <th>Teléfono personal</th>
                <th>Celular personal</th>
                <th>Área</th>
                <th>Profesión</th>
                <th>Cargo</th>
                <th>Empresa</th>
                <th>Teléfono corporativo</th>
                <th>Email corporativo</th>
                <th>Celular corporativo</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>SN</th>
                <th>Asesor comercial</th>
                <th>Estado del cliente</th>
                <th>Tipo de registro</th>
                <th>Menor de 18</th>
                <th>Responsable</th>
                <th>Operario</th>
                <th>Procedencia</th>
                <th>Creado Por</th>
                <th>Modificado Por</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Fecha de modificación</th>
                <th>Comentarios </th>
            </tr>
            @foreach($registros as $registro)
                <tr class="{{$registro->estado ? 'tr_activo_': 'tr_inactivo'}}">
                    <td>{{$registro->id}}</td>
                    <td>{{$registro->nombre}}</td>
                    <td>{{$registro->primer_apellido}}</td>
                    <td>{{$registro->segundo_apellido}}</td>
                    <td>{{$registro->tipo_documento}}</td>
                    <td>{{$registro->doc}}</td>
                    <td>{{$registro->fecha_nacimiento}}</td>
                    <td>{{$registro->email}}</td>
                    <td>{{$registro->telefono_personal}}</td>
                    <td>{{$registro->celular_personal}}</td>
                    <td>{{$registro->area->titulo or 'sin seleccionar'}}</td>
                    <td>{{$registro->profesion}}</td>
                    <td>{{$registro->cargo}}</td>
                    <td>{{$registro->empresa}}</td>
                    <td>{{$registro->telefono_corporativo}}</td>
                    <td>{{$registro->email_corporativo}}</td>
                    <td>{{$registro->celular_corporativo}}</td>
                    <td>{{$registro->municipio->ndepartamento->nombre or ''}}</td>
                    <td>{{$registro->municipio->nombre_municipio or ''}}</td>
                    <td>{{$registro->direccion}}</td>
                    <td>{{$registro->sn}}</td>
                    <td>Asesor comercial</td>
                    <td>{{$registro->estado_cliente}}</td>
                    <td>{{$registro->tipoRegistro->titulo or ''}}</td>
                    <td>{{$registro->menor_de_18 ? 'SI':'NO' }}</td>
                    <td>{{$registro->area->m_responsable->nombre}}</td>
                    <td>{{$registro->area->m_operario->nombre}}</td>
                    <td>{{$registro->procedencia}}</td>
                    <td>{{$registro->creadoPor->nombre or ''}}</td>
                    <td>{{$registro->modificadoPor->nombre or ''}}</td>
                    <td>{{$registro->estado ? 'Activo': 'Dado de baja'}}</td>
                    <td>{{$registro->created_at}}</td>
                    <td>{{$registro->updated_at}}</td>
                    <td>{{$registro->comentarios or 'Sin comentarios'}}</td>
                </tr> 
            @endforeach
        </tbody>
    </table>
</html>