@extends('layouts.app', [ 'activePage' => 'vehiculos'])

@section('content')
    @include('sweetalert::alert')
	<div id="content" class="p-4 p-md-5 pt-5">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-7">
                    <div class="card mb-3">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"> <b>Autos en el estacionamiento:</b> {{$estacionamiento->usados}}</li>
                          <li class="list-group-item"><b>Estacionamientos disponibles:</b> {{$estacionamiento->disponibles}}</li>
                          <li class="list-group-item"><b>Tarifa Actual:</b> {{$tarifa->valor}}</li>
                        </ul>
                      </div>
				</div>
				<div class="col-md-5">
                    <div class="widget">
                        <div class="fecha">
                            <p id="diaSemana" class="diaSemana"></p>
                            <p id="dia" class="dia"></p>
                            <p>de</p>
                            <p id="mes" class="mes"></p>
                            <p>del</p>
                            <p id="anio" class="anio"></p>
                        </div>
                        <div class="reloj">
                            <p id="horas" class="horas"></p>
                            <p>:</p>
                            <p id="minutos" class="minutos"></p>
                            <p>:</p>
                            <div class="cajaSegundos">
                                <p id="segundos" class="segundos"></p>
                                <p id="ampm" class="ampm"></p>
                            </div>
                        </div>
                    </div>                
                </div>

                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <span class="fa fa-car-alt mr-3"></span> Listado de Vehiculos en el estacionamiento
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>código</th>
                                            <th>Patente</th>
                                            <th>Ingreso</th>
                                            <th>Borrar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehiculos as $vehiculo)
                                            <tr>
                                                <td>00{{$vehiculo->id}}</td>
                                                <td>{{$vehiculo->patente}}</td>
                                                <td>{{$vehiculo->hora_ingreso}}</td>
                                                <td>                              <form action="{{route('vehiculo.destroy', $vehiculo->id)}}" method="POST" id="myform{{$vehiculo->id}}" >
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a onclick="event.preventDefault();eliminar({{$vehiculo->id}});" href="#" class="btn btn-danger">
                                                    <span class="fa fa-trash mr-3"></span> Eliminar
                                                </a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection
@push('js')
    <script>
        function eliminar(codigo){
            Swal.fire({
                title: '¿Desea Eliminar este vehiculo?',
                icon: 'warning',
                html: '¡Esta acción es irreversible!',
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#002a3a',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                showCloseButton: true
                }).then((result) => {

                if (result.value) {

                    let form = document.getElementById('myform'+codigo);
                    form.submit();

                }
            })
            
        }
    </script>
@endpush