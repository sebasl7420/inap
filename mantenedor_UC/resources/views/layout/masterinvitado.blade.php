<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a54193ce58.js" crossorigin="anonymous"></script>
    <style>
        #productoInfo {
            display: none;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
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

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4285f4;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #3367d6;
        }

        .equipos div {
            display: flex;
            align-items: center;
        }

        .equipos label {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    @auth
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('solicitud.create') }}">
                {{-- <i class="fa-solid fa-bars"></i> --}}
                <img src="{{ asset('images/uchile2.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
                Portal Universidad De Chile
            </a>
            <div>
                <span class="text-white">{{ Auth::user()->username }} |</span>
                <a href="{{ route('usuario.logout') }}" class="ml-1 text=white">Cerrar Sesion</a>
            </div>
        </nav>
        {{-- CONTENIDO PRINCIPAL --}}
        <div class="row">
            <div class="content">
                @yield('main')
            </div>
        </div>
    @endauth

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
