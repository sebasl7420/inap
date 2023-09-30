<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Página de inicio de sesión</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        form input {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        p {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <form method='POST' action="{{ route('usuario.login') }}">
            @csrf
            <input type="text" id="username" name="username" placeholder="Nombre de usuario">
            <input type="password" id="password" name="password" placeholder="Contraseña">
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>

        {{-- <p><a href="#">¿Olvidaste tu contraseña?</a></p>
    <p>¿No tienes una cuenta? <a href="#">Regístrate aquí</a></p> --}}
    </div>
</body>

</html>
