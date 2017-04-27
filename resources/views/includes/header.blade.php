<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" rel="home" href="http://190.145.89.228/annarnetpruebas/index.php/home" title="AnnarNet">
            <img class="img-brand"  src="{{asset('images/annar_net.png')}}">
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{URL::to('registros')}}"><b>INICIO</b></a></li>
      </ul>

      @if(Auth::check())
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> REGISTROS <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{URL::to('registros')}}">  <i class="fa fa-list" aria-hidden="true"></i> lista de registros</a></li>
              @unless( count(Auth::user()->areasResponsable()->first())>0  && count(Auth::user()->areasOperario()->first())==0 )
                <li><a href="{{URL::to('registros/create')}}"> <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo registro</a></li>
                
              @endunless
              @if( count(Auth::user()->areasResponsable()->first())==0  && count(Auth::user()->areasOperario()->first())==0 )
                <li><a href="{{URL::to('reg/subida_masiva')}}"> <i class="fa fa-clone" aria-hidden="true"></i> Subida masiva</a></li>
              @endif  
              <li><a href="{{URL::route('exportExcel')}}">  <i class="fa fa-file-excel-o" aria-hidden="true"></i> Descargar en Excel</a></li>
              <li><a href="{{URL::route('registrosTablaCompleta')}}">  <i class="fa fa-table" aria-hidden="true"></i> Tabla expandida</a></li>
            </ul>
          </li>
          @if( count(Auth::user()->areasResponsable()->first())==0  && count(Auth::user()->areasOperario()->first())==0 )
            <li><a href="{{URL::to('areas')}}">ÁREAS</a></li>
            <li><a href="{{URL::to('reportes')}}">REPORTES</a></li>
            <li><a href="{{URL::to('roles')}}">ROLES Y PERMISOS</a></li>
          @endif        
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ strtoupper(Auth::user()->nombre) }} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{URL::to('salir')}}"> <i class="fa fa-power-off" aria-hidden="true"></i> Salir</a></li>
            </ul>
            
          </li>
        </ul>
      @endif

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

</header>

