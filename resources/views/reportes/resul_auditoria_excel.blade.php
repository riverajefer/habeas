<table>
    <thead>
        <tr>
            <th>Id Registro</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Campo modificado</th>
            <th>Valor antes</th>
            <th>Valor despúes</th>
        </tr>
    </thead>
<tbody>
    @forelse ($auditoria as $audit)
        @if($audit->event!='created' and ($audit->user!=Null))                        
            @foreach ($audit->getModified() as $attribute => $modified)
                <tr>
                    <td>
                        {{$audit->auditable_id}}
                    </td>
                    <td>
                        {{ $audit->created_at }} 
                    </td>
                    <td> 
                        {{ $audit->user->nombre }} 
                    </td>
                    <td>
                        {{ strtoupper(MyFuncs::fn_atributo($attribute, $audit, $modified)->atributo) }}
                    </td>
                    <td>
                        {!!MyFuncs::fn_atributo($attribute, $audit, $modified)->old!!}
                    </td>
                    <td>
                        {!!MyFuncs::fn_atributo($attribute, $audit, $modified)->new!!}
                    </td>
                </tr>
            @endforeach
        @endif    
        @empty
        <p>@lang('post.unavailable_audits')</p>
    @endforelse
    </tbody>
</table>