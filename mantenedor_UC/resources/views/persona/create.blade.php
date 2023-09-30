@extends('layout.master')

@section('main')
<title>Registrar</title>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3><i class="fas fa-user-plus"></i> Registrar Persona</h3>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('persona.store') }}" onsubmit="return validarRut()">

                    <div class="form-group">
                        @csrf

                        <label class="subtitulos" for="rut"><i class="fas fa-id-card"></i> Rut:</label>
                        <input type="text" id="rut" name="rut" class="form-control" required
                            pattern="^\d{1,8}-[0-9kK]{1}$" title="El RUT debe tener el formato xxxxxxxx-x (o xxxxxxxx-K)"
                            placeholder="XXXXXXXX-X">

                        <label class="subtitulos" for="nombre"><i class="fas fa-signature"></i> Nombres:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="" class="form-control" required>

                        <label class="subtitulos" for="apellido"><i class="fas fa-signature"></i> Apellidos:</label>
                        <input type="text" id="apellido" name="apellido" placeholder="" class="form-control" required>

                        <label class="subtitulos" for="correo"><i class="fas fa-envelope"></i> Correo:</label>
                        <input type="email" id="correo" name="correo" placeholder="Micorreo@gmail.com"
                            class="form-control">

                        <label class="subtitulos" for="telefono"><i class="fas fa-phone"></i> Teléfono o Celular:</label>
                        <input type="text" id="telefono" name="telefono" pattern="^\+?[0-9]+(-[0-9]+)*$"
                            title="El número debe tener un formato válido, por ejemplo: +123456789 o 123-456-789"
                            class="form-control">

                        <label class="subtitulos" for="unidad"><i class="fas fa-building"></i> Seleccione Unidad:</label>
                        <select class="form-control" id="unidad" name="unidad">
                            @foreach ($unidads as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }} - {{ $unidad->sede }}</option>
                            @endforeach
                        </select>
                        <br>
                        <div class="text-center mt-3">
                            <a href="{{ route('persona') }}" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
                            <button type="submit" value="Validar" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
      function validarRut() {
        var rut = document.getElementById('rut').value;
        if (!/^[0-9]+[-‐]{1}[0-9kK]{1}$/.test(rut)) {  // Aquí corregí la expresión regular
            alert('El RUT ingresado no tiene un formato válido.');
            return false;
        }

        var numero = rut.split('-')[0];
        var dv = rut.split('-')[1];
        var suma = 0;
        var factor = 2;

        // Calcular dígito verificador esperado
        for (var i = numero.length - 1; i >= 0; i--) {
            suma += factor * parseInt(numero.charAt(i));
            factor = factor === 7 ? 2 : factor + 1;
        }

        var dv_esperado = 11 - suma % 11;
        dv_esperado = (dv_esperado === 11) ? '0' : (dv_esperado === 10) ? 'K' : dv_esperado.toString();

        if (dv.toUpperCase() !== dv_esperado) {
            alert('El RUT ingresado no es válido.');
            return false;
        }

        return true;
        }
    </script>
@endsection
