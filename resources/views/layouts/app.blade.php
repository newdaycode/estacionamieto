<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Estacionamiento') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img') }}/carro.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css') }}/styles.css">
    @stack('css')
</head>
<body>
  <div class="wrapper d-flex align-items-stretch">
    @include('layouts.sidebar')
    @yield('content')
      <!-- Page Content  -->
  </div>


    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js') }}/scripts.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function cerrar(){
            Swal.fire({
                title: '¿Desea Cerrar el estacionamiento?',
                icon: 'warning',
                html: '¡Esta acción es irreversible!',
                confirmButtonText: 'Cerrar',
                confirmButtonColor: '#002a3a',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                showCloseButton: true
                }).then((result) => {

                if (result.value) {

                  window.location.href = 'cerrar';

                }
            })
            
        }
    </script>
    @stack('js')

</body>
</html>
