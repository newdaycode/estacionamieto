@extends('layouts.app', [ 'activePage' => 'vehiculo'])

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

                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <span class="fa fa-arrow-alt-circle-down mr-3"></span> Ingresos
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('ticket') }}" autocomplete="off" class="form-horizontal">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputestacionamiento1" class="form-label">Patente</label>
                                    <input type="text" class="form-control {{ $errors->has('patente') ? ' is-invalid' : '' }}" name="patente" id="exampleInputpatente1">
                                    @if ($errors->has('patente'))
                                    <span id="patente-error" class="error text-danger" for="input-patente">{{ $errors->first('patente') }}</span>
                                    @endif
                                </div>
                                {{-- <div class="container mt-4">
                                    <div class="d-flex justify-content-center">{!!  DNS1D::getBarcodeHTML('CC-CC-CC', 'C39') !!}
                                    </div> 
                                    <h5 class="text-center"><b> CC-CC-CC</b></h5>
                                </div> --}}
                                
                                {{-- <a href="{{ route('ticket' ,  $estacionamiento->id) }}" target="_blank">Imprimir</a> --}}

                                <button type="submit" class="btn btn-primary">Imprimir</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-danger text-white">
                            <span class="fa fa-arrow-alt-circle-up mr-3"></span> Salidas
                        </div>
                        <div class="card-body">

                            <form action="{{route('buscar')}}" method="get">

                                <label for="exampleInputestacionamiento1" class="form-label">Patente</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="patente" value="{{ $vehiculo->patente ?? '' }}" required autofocus>
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-danger" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>
                            @isset($vehiculo)
                            <form method="post" action="{{route('vehiculo.update', $vehiculo->id)}}" autocomplete="off" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div>
                                    <input type="hidden" name="codigo" value="{{ $vehiculo->id ?? '' }}">
                                    <input type="hidden" name="hora_salida" value="{{ $hora_salida ?? '' }}">
                                    <input type="hidden" name="monto" value="{{ $monto ?? '' }}">
                                    <p><b>Minutos: </b>{{ $minutos ?? '0' }} <br> <b>Total:</b> ${{ $monto ?? '0' }}</p>
                                </div>
                                <button type="submit" class="btn btn-primary" {{$estado ?? 'disabled'}}>Pagar</button>
                                <a href="{{route('vehiculo.index')}}" type="button" class="btn btn-danger">Cancelar</a>
                            </form>
                            @endisset
                        </div>
                    </div>
                </div>



            </div>
        </div>
	</div>
@endsection
