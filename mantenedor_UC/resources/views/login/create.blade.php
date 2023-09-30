@extends('layout.master')

@section('main')
    <h3>Mantenedor de Usuarios</h3>

    <form action="guardar_usuario.php" method="POST">
        <label for="rut">RUT:</label>
        <input type="text" id="rut" name="rut" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="clave">Clave:</label>
        <input type="password" id="clave" name="clave" required><br><br>

        <input type="submit" value="Guardar">
    </form>
@endsection
