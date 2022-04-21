@extends('layouts.app', [ 'activePage' => 'inicio'])

@section('content')
	@include('sweetalert::alert')
	<div id="content" class="p-4 p-md-5 pt-5">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
                    <div class="widget mb-3">
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
				<div class="col-md-6">
					<div class="card text-white bg-primary mb-3">
						<div class="card-header"><span class="fa fa-car-alt mr-3"></span> Estacionamiento</div>
						<div class="card-body">
						  <p class="card-text">Total: {{$estacionamiento->total}} <br> Disponibles: {{$estacionamiento->disponibles}} <br> Usados: {{$estacionamiento->usados}}</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card text-white bg-warning mb-3">
						<div class="card-header"><span class="fa fa-money-check mr-3"></span> Tarifas</div>
						<div class="card-body">
						  <p class="card-text"> Monto: {{$tarifa->valor}} <br> Minuto: {{$tarifa->minuto}} <br> <br> </p>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
@endsection