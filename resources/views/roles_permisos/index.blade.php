@extends('layouts.master')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading"> 
        <i class="fa fa-bars" aria-hidden="true"></i> lista de usuarios
    </div>
    <div class="panel-body">
        <p>Usuarios que pertenecen al modulo de tratamiento de datos</p>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>{{ $message }}</h6>
            </div>
        @endif 

        @if ($errors->has('roles'))
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span>Un usuario debe tener por lo menos un rol</span><br>
                <strong>{{ $errors->first('roles') }}</strong>
            </div>
        @endif
        <a href="{{URL::route('roles')}}" class=" mdl-js-ripple-effect">
             <i class="fa fa-key" aria-hidden="true"></i>  Gestionar Permisos de Roles
        </a>


    </div>
    <table class="table table-striped table-bordered table-hover" id="tabla_users">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->nom_user_t4}}</td>
                    <td>{{$user->email_t4}}</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#rolesModal" data-userid="{{$user->id}}" data-uroles="{{$user->roles}}"  data-roles="{{$roles}}" data-titulo="{{ ucwords($user->nom_user_t4) }}">Roles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- Modal Roles -->
<div class="modal fade" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Gestionar roles para: <span></span> </h4>
      </div>
      <div class="modal-body">
        <p>Lista de Roles</p>
        <form action="{{ route('saveRol') }}" role="form" method="POST">
                {{ csrf_field() }}
            <div class="lista_roles">
            </div>
            <br>
            <input type="hidden" value="" name="user" >
            <input type="submit" data-loading-text="Enviando..."  class="btn btn-success save" value="Guardar" name="save">
            
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


$('#tabla_users').DataTable({
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


$('#rolesModal').on('show.bs.modal', function (event) {
  var button    = $(event.relatedTarget); 
  var titulo    = button.data('titulo');
  var userRoles = button.data('uroles');
  var roles     = button.data('roles');
  var userid    = button.data('userid');

  console.log("Uroles: ",userRoles);
  console.log("roles: ",roles);
  console.log("userid: ",userid);

  $("input[name='user']").val(userid);

  $('.lista_roles').empty();
  var idUR = [];

  $.each(userRoles, function(key, value){
      idUR.push(value.id)
  });

  $.each(roles, function(key, value){
      var comp = userRoles[key];
      var check = '';
      if(idUR.contains(value.id)){
          check = 'checked';
      }
      $('.lista_roles').append('<div class="checkbox"><label><input type="checkbox" name="roles[]" value="'+value.name+'" '+check+'> '+MaysPrimera(value.name.toLowerCase()) +' </label></div>');
  });

  var modal = $(this)
  modal.find('.modal-title > span').text(titulo)

});

});
</script>
@endpush