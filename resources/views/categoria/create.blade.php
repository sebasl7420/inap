@extends('layout.master')

@section('main')
<title>Agregar Categoria</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3><i class="fas fa-folder-plus"></i> Agregar Categoría</h3>
            <form method="POST" action="{{ route('categoria.store') }}">
                <div class="form-group">
                    @csrf
                    <label class="subtitulos" for="nombre"><i class="fas fa-angle-right"></i> Nombre categoría:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese aquí el nombre de la categoría" class="form-control" required>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('categoria') }}" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
