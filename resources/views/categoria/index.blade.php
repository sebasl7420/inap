@extends('layout.master')

@section('main')
<title>Categorias</title>
<h3 class="title mt-4">Lista de Categorías</h3>
<div class="container" style="min-height: 100vh;">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('buscar.categoria') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar categoria por nombre">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    
        <div class="col" style="display: flex; justify-content: flex-end;">
            <a href="{{ route('categoria.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Agregar Categoría
            </a>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID <a class="sort-btn" data-sort="id"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Nombre <a class="sort-btn" data-sort="nombre_categoria"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Productos Asociados<a class="sort-btn" data-sort="productos_asociados"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td data-col="id">{{ $categoria->id }}</td>
                                <td data-col="nombre_categoria">{{ $categoria->nombre_categoria }}</td>
                                <td data-col="productos_asociados">{{ $categoria->productos->count() }}</td>
                                <th>
                                    <a href="{{ route('categoria.edit', $categoria->id) }}" class="btn btn-info" title="Editar categoría">
                                        <i class="fas fa-pen-square"></i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        @if ($categorias->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $categorias->previousPageUrl() }}">Anterior</a></li>
                        @endif
    
                        @if ($categorias->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $categorias->nextPageUrl() }}">Siguiente</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>   
@endsection
