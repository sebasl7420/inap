@extends('layout.master')

@section('main')
<title>Editar</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3><i class="fas fa-user-edit"></i> Editar Persona</h3>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('persona.update', $persona->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="rut"><i class="fas fa-id-card"></i> Rut:</label>
                    <input type="text" id="rut" name="rut" class="form-control" value="{{ $persona->rut }}" disabled>

                    <label for="nombre"><i class="fas fa-user"></i> Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $persona->nombre }}">

                    <label for="apellido"><i class="fas fa-user"></i> Apellido:</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $persona->apellido }}">

                    <label for="correo"><i class="fas fa-envelope"></i> Correo:</label>
                    <input type="text" id="correo" name="correo" class="form-control" value="{{ $persona->correo }}">

                    <label for="telefono"><i class="fas fa-phone"></i> Teléfono o celular:</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" value="{{ $persona->telefono }}">

                    <label for="unidad"><i class="fas fa-building"></i> Unidad:</label>
                    <select class="form-control" id="unidad" name="unidad">
                        @foreach ($unidads as $unidad)
                            <option value="{{ $unidad->id }}" @if ($persona->unidad_id == $unidad->id) selected="selected" @endif>
                                {{ $unidad->nombre }} - {{ $unidad->sede }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('persona') }}" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Editar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmar Borrado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Esta seguro de que quiere borrar a {{ $persona->nombre }} {{ $persona->apellido }}?
                </div>
                <div class="modal-footer">

                    <form method="POST" action="{{ route('persona.destroy', $persona->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
