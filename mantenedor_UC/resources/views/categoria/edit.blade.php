@extends('layout.master')

@section('main')
<title>Editar Categoria {{$categoria->id}}</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-edit"></i> Editar Categoría</h3>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('categoria.update', $categoria->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $categoria->nombre_categoria }}">
                            <div class="form-group mt-2">
                                <a href="{{ route('categoria') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar Categoría</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-trash"></i> Eliminar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


     <!-- Button trigger modal -->

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
                    ¿Esta seguro de que quiere borrar la categoría {{$categoria->nombre_categoria}}?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('categoria.destroy', $categoria->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Borrar categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
