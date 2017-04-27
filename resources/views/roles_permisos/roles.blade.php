@extends('layouts.master')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading"> 
        <i class="fa fa-bars" aria-hidden="true"></i> lista de roles
    </div>
    <div class="panel-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>{{ $message }}</h6>
            </div>
        @endif          

        @if ($errors->has('permisos'))
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span>Un rol debe tener por lo menos un permiso</span><br>
                <strong>{{ $errors->first('permisos') }}</strong>
            </div>
        @endif   

        <a href="{{URL::route('usuarios')}}" class=" mdl-js-ripple-effect">
             <i class="fa fa-user-o" aria-hidden="true"></i> Gestionar Roles-Usuarios
        </a>

    </div>
    <table class="table table-striped table-bordered table-hover" id="tabla_roles">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Permisos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $rol)
                <tr>
                    <td>{{$rol->id}}</td>
                    <td>{{ ucwords($rol->name) }}</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#permisosModal" data-rolid="{{$rol->id}}" data-rolpermisos="{{$rol->permissions}}"  data-permisos="{{$permisos}}" data-titulo="{{ ucwords($rol->name) }}">Permisos</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal Permisos -->
<div class="modal fade" id="permisosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Gestionar permisos para: <span></span> </h4>
      </div>
      <div class="modal-body">
        <p>Lista de Permisos</p>
        <form action="{{ route('savePermisosRol') }}" role="form" method="POST">
                {{ csrf_field() }}
            <div class="lista_permisos">
            </div>
            <br>
            <input type="hidden" value="" name="rol" >
            <input type="submit" data-loading-text="Enviando..." class="btn btn-success save " value="Guardar" name="save">
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn"  data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>



@stop

@push('scripts')
<script>

$(function() {


$('.save').click(function() {
    var btn = $(this);
    btn.button('loading');
    btn.val(btn.data("loading-text")); setTimeout(function() {
        btn.val('reset');
    }, 2000);
});

$('#tabla_roles').DataTable({
    "language": {
        "url": '//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json'
    },        
});

function MaysPrimera(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}

Array.prototype.contains = function(obj) {
    var i = this.length;
    while (i--) {
        if (this[i] === obj) {
            return true;
        }
    }
    return false;
}




$('#permisosModal').on('show.bs.modal', function (event) {
  var button    = $(event.relatedTarget); 
  var titulo    = button.data('titulo');
  var rolPermisos = button.data('rolpermisos');
  var permisos     = button.data('permisos');
  var rolid    = button.data('rolid');

  console.log("rolPermisos: ",rolPermisos);
  console.log("permisos: ",permisos);
  console.log("rolid: ",rolid);

  $("input[name='rol']").val(rolid);

  $('.lista_permisos').empty();
  var idRol = [];

  $.each(rolPermisos, function(key, value){
      idRol.push(value.id)
  });

  $.each(permisos, function(key, value){
      var check = '';
      if(idRol.contains(value.id)){
          check = 'checked';
      }
      $('.lista_permisos').append('<div class="checkbox"><label><input type="checkbox" name="permisos[]" value="'+value.name+'" '+check+'> '+MaysPrimera(value.name.toLowerCase()) +' </label></div>');
  });
  var modal = $(this)
  modal.find('.modal-title > span').text(titulo)

});


});
</script>
@endpush