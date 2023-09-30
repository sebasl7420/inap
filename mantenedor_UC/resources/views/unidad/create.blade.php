@extends('layout.master')

@section('main')
<title>Agregar Unidad</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3><i class="fas fa-folder-plus"></i> Agregar Unidad</h3>
            <form method="POST" action="{{ route('unidad.store') }}">
                <div class="form-group">
                    @csrf

                    <label class="subtitulos" for="nombre"><i class="fas fa-angle-right"></i> Nombre unidad:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese aquí el nombre de la unidad"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="subtitulos" for="sede"><i class="fas fa-angle-right"></i> Sede unidad:</label>
                    <select id="sede" name="sede" class="form-control" required>
                        <option value="Santa Lucia">Santa Lucia</option>
                        <option value="Rebeca Matte">Rebeca Matte</option>
                        <option value="Huerfanos">Huerfanos</option>
                    </select>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('unidad') }}" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
