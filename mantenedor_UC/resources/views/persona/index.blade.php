@extends('layout.master')

@section('main')
<title>Personas</title>
<h3 class="title mt-4">Lista de Personas</h3>
<div class="container" style="min-height: 100vh;">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('buscar.persona') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar persona por nombre, rut o correo">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col" style="display: flex; justify-content: flex-end;">
            <a href="{{ route('persona.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Agregar Persona
            </a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive" style="max-height: 68vh;">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Rut <a class="sort-btn" data-sort="rut"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Nombre <a class="sort-btn" data-sort="nombre"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Correo <a class="sort-btn" data-sort="correo"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Teléfono <a class="sort-btn" data-sort="telefono"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Unidad <a class="sort-btn" data-sort="unidad"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $persona)
                            <tr>
                                <td data-col="rut">{{ $persona->rut }}</td>
                                <td data-col="nombre">{{ $persona->nombre }} {{ $persona->apellido }}</td>
                                <td data-col="correo">{{ $persona->correo }}</td>
                                <td data-col="telefono">{{ $persona->telefono }}</td>
                                <td data-col="unidad">{{ $persona->unidad->nombre }}</td>
                                <th>
                                    <a href="{{ route('persona.edit', $persona->id) }}" class="btn btn-info" title="Editar persona">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa-solid fa-trash-can"></i></button> --}}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if ($personas->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                    @else
                        <li class="page-item"><a class="page-link"
                                href="{{ $personas->previousPageUrl() }}">Anterior</a></li>
                    @endif

                    @if ($personas->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $personas->nextPageUrl() }}">Siguiente</a>
                        </li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                    @endif
                </ul>
            </nav>
            
        </div>
    </div>
</div>
@endsection

