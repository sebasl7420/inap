<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a54193ce58.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
  
        .title{
            text-align: center;
        }
        .container{
            min-height: 100vh;
        }
        #productoInfo {
            display: none;
        }

        .row {
            margin-right: 0%;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            width:13vw;
            height: auto;
            background-color: #333;
            color: #fff;
            padding-top: 1%;
            padding-left: 2%;
            padding-right: 1%;
        }

        i{
            padding: 2%;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0%;
            margin: 0%;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            color: #333;
        }

        .content p {
            font-size: 18px;
            color: #666;
        }

        a {
            color: white;
        }

        .subtitulos {
            font-size: larger;
            padding-top: 1%;
            width: -webkit-fill-available;
        }

        .navbar{
            background-color: #05519a
        }

        .sidebar{
            background-color: #05519a
        }

        .navbar-brand:hover {
            color: black; /* Cambia el color del texto a negro cuando se pasa el mouse por encima */
        }

        .close-sesion:hover {
            color: black; /* Cambia el color del texto a negro cuando se pasa el mouse por encima */
        }

        .p-4 {
            padding: 1rem!important;
        }
        .cerrar_sesion{
            width: 200px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('inicio') }}">
                {{-- <i class="fa-solid fa-bars"></i> --}}
                <img src="{{ asset('images/uchile2.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
                Mantenedor Universidad De Chile
            </a>
    
            <div class="cerrar_sesion">
                <i class="fa-regular fa-circle-user" style="color: #ffffff;"></i>
                <span class="text-white">{{ Auth::user()->username }} |</span>
                <a href="{{ route('usuario.logout') }}" class="close-sesion text-white">Cerrar Sesion</a>
            </div>
        </div>
    </nav>
    
    @auth
        <div class="row">
            <div class="sidebar">
                <ul>
                    <h6><i class="fa-solid fa-house"></i> <a href="{{ route('inicio') }}"> Home</a></h6>
                    <h6><i class="fas fa-tools"></i> <a href="{{ route('ajuste.create') }}"> Ajuste Stock</a></h6>
                    <h6 data-toggle="collapse" data-target="#navbarToggleExternalContent"
                        aria-controls="navbarToggleExternalContent">
                        <i class="fa-solid fa-folder"></i><a href="#"> Mantenedores</a>
                    </h6>
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class=" p-4">
                            <li><a href="{{ route('producto.create') }}"><i class="fa-solid fa-barcode"></i> Carga Individual</a></li>
                            <li><a href="{{ route('producto') }}"><i class="fa-solid fa-list"></i> Productos</a></li>
                            <li><a href="{{ route('persona') }}"><i class="fa-regular fa-user"></i> Personas</a></li>
                            <li><a href="{{ route('categoria') }}"><i class="fa-solid fa-link"></i> Categorias</a></li>
                            <li><a href="{{ route('unidad') }}"><i class="fa-solid fa-users"></i> Unidades</a></li>
                        </div>
                    </div>

                    {{-- <h6 data-toggle="collapse" data-target="#navbarToggleExternalContent1" aria-controls="navbarToggleExternalContent1" >
                        <i class="fa-regular fa-gear"></i><a href="{{ route('usuario') }}"> Configuración</a>
                    </h6> --}}
                    {{-- <div class="collapse" id="navbarToggleExternalContent1">
                        <div class=" p-4">
                            <li><a href="#"><i class="fa-solid fa-folder"></i> Usuarios</a></li>
                        </div>
                    </div> --}}

                    <h6 data-toggle="collapse" data-target="#navbarToggleExternalContent2"
                        aria-controls="navbarToggleExternalContent2">
                        <i class="fa-solid fa-clipboard-list"></i><a href="{{ route('reporte') }}"> Reportes</a>
                    </h6>
                    {{-- <div class="collapse" id="navbarToggleExternalContent2">
                        <div class=" p-4">
                            <li><a href="#"><i class="fa-solid fa-folder"></i> Unidad</a></li>
                        </div>
                    </div> --}}
                </ul>
            </div>

            {{-- CONTENIDO PRINCIPAL --}}
            <div class="content">
                @yield('main')
            </div>
        </div>
    @endauth

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script>
        const sortButtons = document.querySelectorAll('.sort-btn');
        let currentSort = 'asc';

        sortButtons.forEach(button => {
            button.addEventListener('click', () => {
                const sortBy = button.getAttribute('data-sort');
                const tableRows = Array.from(document.querySelectorAll('tbody tr'));

                tableRows.sort((a, b) => {
                    const aValue = a.querySelector(`td[data-col="${sortBy}"]`).innerText;
                    const bValue = b.querySelector(`td[data-col="${sortBy}"]`).innerText;

                    if (currentSort === 'asc') {
                        return aValue.localeCompare(bValue);
                    } else {
                        return bValue.localeCompare(aValue);
                    }
                });

                tableRows.forEach(row => row.parentNode.removeChild(row));
                tableRows.forEach(row => document.querySelector('tbody').appendChild(row));

                currentSort = currentSort === 'asc' ? 'desc' : 'asc';
            });
        });
    </script>
</body>

</html>
