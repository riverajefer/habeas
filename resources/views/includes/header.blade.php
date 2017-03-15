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
        <a class="navbar-brand" rel="home" href="{{URL::to('registros')}}" title="Buy Sell Rent Everyting">
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Registros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{URL::to('registros')}}">  <i class="fa fa-list" aria-hidden="true"></i>  Ver lista de registros</a></li>
              <li><a href="{{URL::to('registros/create')}}"> <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo registro</a></li>
              <li><a href="#"> <i class="fa fa-history" aria-hidden="true"></i> Historial de cambios</a></li>
            </ul>
          </li>        
            <li><a href="{{URL::to('areas')}}">Áreas</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->nombre}} <span class="caret"></span></a>
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