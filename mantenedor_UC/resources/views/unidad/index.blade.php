@extends('layout.master')

@section('main')
<title>Unidades</title>
<h3 class="title mt-4">Lista de Unidades</h3>
<div class="container" style="min-height: 100vh;">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('buscar.unidad') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar unidad por nombre o sede">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col" style="display: flex; justify-content: flex-end;">
            <a href="{{ route('unidad.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Agregar Unidad
            </a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive" style="max-height: 59vh;">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID <a class="sort-btn" data-sort="id"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Nombre <a class="sort-btn" data-sort="nombre"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Sede <a class="sort-btn" data-sort="sede"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Asociados <a class="sort-btn" data-sort="asociados"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unidades as $unidad)
                            <tr>
                                <td data-col="id">{{ $unidad->id }}</td>
                                <td data-col="nombre">{{ $unidad->nombre }}</td>
                                <td data-col="sede">{{ $unidad->sede }}</td>
                                <td data-col="asociados">{{ $unidad->personas->count() }}</td>
                                <th>
                                    <a href="{{ route('unidad.edit', $unidad->id) }}" class="btn btn-info" title="Editar unidad">
                                        <i class="fas fa-pen-square"></i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        @if ($unidades->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $unidades->previousPageUrl() }}">Anterior</a></li>
                        @endif

                        @if ($unidades->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $unidades->nextPageUrl() }}">Siguiente</a></li>
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
