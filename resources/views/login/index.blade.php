@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">Ingresar al módulo habeas data</div>
              <div class="panel-body">
              
                <form action="{{URL::to('ingresar')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="pw">Vuelva a escribir la contraseña</label>
                        <input type="password" name="password" class="form-control" id="pw" placeholder="Contraseña" autofocus required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif                        
                    </div>

                        @if(Session::has('errorLogin'))
                                <div class="alert alert-danger">
                                    {{ Session::get('errorLogin') }}
                                </div>
                        @endif

                    <br>
                    <input type="hidden" value="{{$email}}" name="email">
                    <div align="center">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Entrar al módulo de Habeas data {{$id}}
                        </button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" align="center">
        <img src="{{asset('images/load.gif')}}" alt="Cargando">
        <p>Espere...</p>
      </div>
    </div>
  </div>
</div>

@stop
@push('scripts')
    <script type="text/javascript">
        $(function () {

            $('#myModal').modal('show')

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var env = '{{ env('APP_ENV') ? env('APP_ENV') : 'server' }}';
            var id = '{{ $id ? $id : '0' }}';
            console.log('APP_ENV w: ', env );

            if(env == 'local'){
                console.log("ambiente local");

                $.post('{!! route('loginDirecto') !!}', {id: id }, function(data){
                    if(data.status){
                        $('#myModal').modal('hide');
                        location.reload();
                    }else{
                        $('#myModal').modal('hide');
                        console.log("agun error");
                    }
                });    

            }else{
                console.log("ambiente server");
                $.get('http://190.145.89.228/annarnetpruebas/index.php/auth/valida', function(response, status, request) {
                    console.log("response: ",response);
                    if(response==1){
                        $.post('{!! route('loginDirecto') !!}', {id: id }, function(data){
                            console.log("retunr data: ", data);
                            if(data.status){
                                $('#myModal').modal('hide');
                                location.reload();
                            }else{
                                $('#myModal').modal('hide');
                                console.log("agun error");
                            }
                        }); 
                    }
                });
            }
        });
    </script>
@endpush