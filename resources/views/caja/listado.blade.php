@extends('layouts.app', [ 'activePage' => 'caja'])

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
                            <span class="fa fa-dollar-sign mr-3"></span> Caja
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <a onclick="event.preventDefault();caja();" href="javascript:void(0)" class="btn btn-outline-primary">Cierre Diario</a> 
                                <table class="table table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Dinero</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cajas as $caja)
                                            <tr>
                                                <td>{{$caja->fecha_apertura}}</td>
                                                <td>@if ($caja->estado === 'C')
                                                        <span class="badge bg-success">Cerrada</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Abierta</span>
                                                    @endif
                                                </td>
                                                <td>${{$caja->valor}}</td>
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
        function caja(){
            Swal.fire({
                title: '¿Desea realizar el cierre diario?',
                icon: 'warning',
                html: '¡Esta acción es irreversible!',
                confirmButtonText: 'Cerrar',
                confirmButtonColor: '#002a3a',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                showCloseButton: true
                }).then((result) => {

                if (result.value) {

                    window.location.href = 'diario';

                }
            })
            
        }
    </script>
@endpush
