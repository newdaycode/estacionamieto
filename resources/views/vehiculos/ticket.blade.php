<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tikect de Ingreso</title>

<style>
        * {
    font-size: 20px;
    font-family: 'Times New Roman';
}

.center {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 250px;
    max-width: 250px;
    font-size: 50px;
    margin-bottom: 0px !important;
}
</style>


</head>
<body>
    @include('sweetalert::alert')
    <div class="ticket">
        <h2 class="center">Estacionamientos o Carro<br></h2>
        <p class="center">Campos #545 Rancagua</p>
        <div class="center">
            {!!  DNS1D::getBarcodeHTML('CC-CC-CC', 'C39',1.5,33) !!}
            <b> CC-CC-CC</b>   
            <p>Codigo: 00{{$vehiculo->id}} <br> Hora de ingreso: {{$vehiculo->id}}</p>
        </div>
        
        
    </div>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>
</html>





	




