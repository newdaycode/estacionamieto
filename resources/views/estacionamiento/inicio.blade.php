@extends('layouts.app', [ 'activePage' => 'estacionamiento'])

@section('content')
  @include('sweetalert::alert')
  <div id="content" class="p-4 p-md-5 pt-5">
	  <div class="container-fluid">
		  <div class="row">
			  <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-header bg-success text-white">
              <span class="fa fa-money-bill mr-3"></span> Tarifa Base
            </div>
            <div class="card-body">
              <h5 class="card-title">Tarifa Actual: {{$tarifa->valor}}</h5>
              <form method="post" action="{{route('tarifa.update', $tarifa->id)}}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="exampleInputestacionamiento1" class="form-label">Ingrese Nueva Tarifa</label>
                  <input type="number" class="form-control {{ $errors->has('valor') ? ' is-invalid' : '' }}" name="valor" id="exampleInputvalor1">
                  @if ($errors->has('valor'))
                    <span id="valor-error" class="error text-danger" for="input-valor">{{ $errors->first('valor') }}</span>
                  @endif
                </div>
                <button type="submit" class="btn btn-success">Aceptar</button>
              </form>
            </div>
          </div>
				</div>
			  <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-header bg-success text-white">
              <span class="fa fa-stopwatch mr-3"></span> Valor Minuto
            </div>
            <div class="card-body">
              <h5 class="card-title">Tarifa Actual: {{$tarifa->minuto}}</h5>
              <form method="post" action="{{route('tarifa.minuto', $tarifa->id)}}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="exampleInputestacionamiento1" class="form-label">Ingrese Nueva Tarifa</label>
                  <input type="number" class="form-control {{ $errors->has('minuto') ? ' is-invalid' : '' }}" name="minuto" id="exampleInputminuto1">
                  @if ($errors->has('minuto'))
                    <span id="minuto-error" class="error text-danger" for="input-minuto">{{ $errors->first('minuto') }}</span>
                  @endif
                </div>
                <button type="submit" class="btn btn-success">Aceptar</button>
              </form>
            </div>
          </div>
				</div>
			  <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-header bg-primary text-white">
              <span class="fa fa-car-alt mr-3"></span> Estacionamiento
            </div>
            <div class="card-body">
              <h5 class="card-title">Cantidad de Estacionamiento: {{$estacionamiento->total}}</h5>
              <p class="card-text">Usados: {{$estacionamiento->usados}}<br> Disponibles: {{$estacionamiento->disponibles}}</p>
              <form method="post" action="{{route('estacionamiento.update', $estacionamiento->id)}}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="exampleInputestacionamiento1" class="form-label">Nueva Cantidad de estacionamientos</label>
                  <input type="number" class="form-control {{ $errors->has('total') ? ' is-invalid' : '' }}" name="total" id="exampleInputtotal1">
                  @if ($errors->has('total'))
                    <span id="total-error" class="error text-danger" for="input-total">{{ $errors->first('total') }}</span>
                  @endif
                </div>
                <button type="submit" class="btn btn-primary">Aceptar</button>
              </form>
            </div>
          </div>
				</div>
      </div>
			</div>
		</div>
	</div>
@endsection
