<nav id="sidebar" class="active">
    <div class="custom-menu">
      <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
      </button>
    </div>
    <div class="p-4">
      <h1><a href="{{route('inicio')}}" class="logo">Cars</a></h1>
      <ul class="list-unstyled components mb-5">
        <li class="{{ $activePage == 'inicio' ? ' active' : '' }}">
          <a href="{{route('inicio')}}"><span class="fa fa-home mr-3"></span> Inicio</a>
        </li>
        <li class="{{ $activePage == 'vehiculo' ? ' active' : '' }}">
          <a href="{{route('vehiculo.index')}}"><span class="fa fa-clipboard-list mr-3"></span> Ingreso - Salida</a>
        </li>
        <li class="{{ $activePage == 'vehiculos' ? ' active' : '' }}">
          <a href="{{route('vehiculos.lista')}}"><span class="fa fa-car-alt mr-3"></span> Listado de Autos</a>
        </li>
        </li>
        <li class="{{ $activePage == 'borrados' ? ' active' : '' }}">
          <a href="{{route('historial.borrados')}}"><span class="fa fa-trash mr-3"></span> Historial de borrados</a>
        </li>
        <li class="{{ $activePage == 'estacionamiento' ? ' active' : '' }}">
          <a href="{{route('estacionamiento.index')}}"><span class="fa fa-archive mr-3"></span> Administración</a>
        </li>
        <li class="{{ $activePage == 'caja' ? ' active' : '' }}">
          <a href="{{route('caja.listado')}}"><span class="fa fa-dollar-sign mr-3"></span> Caja</a>
        </li>
        <li class="{{ $activePage == 'ganancias' ? ' active' : '' }}">
          <a href="{{route('ganancias.index')}}"><span class="fa fa-chart-bar mr-3"></span> Ganancias</a>
        </li>
        <li class="{{ $activePage == 'estacionamiento' ? ' active' : '' }}">
          <a onclick="event.preventDefault();cerrar();" href="javascript:void(0)"><span class="fa fa-door-closed mr-3"></span> Cerrar Estacionamiento</a>
        </li>
      </ul>
    </div>
</nav>
