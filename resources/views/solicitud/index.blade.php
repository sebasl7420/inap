@extends('layout.master')

@section('main')
<title>Home</title>
<div class="row">
    <div class="col-12 text-center">
        <h1 class="welcome-heading">Bienvenido</h1>
        <p class="welcome-text">¡Gracias por visitar nuestra plataforma!</p>
    </div>
</div>
<div class="container-fluid">
    <div class="text-center mt-3">
        <form action="{{ route('buscar.solicitud') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Buscar solicitud por ID, rut, nombre o correo">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <h3 class="solicitudes-heading">Solicitudes</h3>
            <div class="table-responsive" style="max-height: 59vh;">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID <a class="sort-btn" data-sort="id"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Rut <a class="sort-btn" data-sort="rut"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Nombre <a class="sort-btn" data-sort="nombre"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Unidad <a class="sort-btn" data-sort="unidad"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Fecha Emisión <a class="sort-btn" data-sort="fecha_emision"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Estado <a class="sort-btn" data-sort="estado"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($solicituds as $solicitud)
                            <tr>
                                <td data-col="id">{{ $solicitud->id }}</td>
                                <td data-col="rut">{{ $solicitud->persona->rut }}</td>
                                <td data-col="nombre">{{ $solicitud->persona->nombre }}</td>
                                <td data-col="unidad">{{ $solicitud->persona->unidad->nombre }}</td>
                                <td data-col="fecha_emision">{{ $solicitud->fecha_emision }}</td>
                                <td data-col="estado" style="background-color:
                                    @if ($solicitud->estado == 'P') #FAD02E; 
                                    @elseif ($solicitud->estado == 'R') #FF6B6B; 
                                    @elseif ($solicitud->estado == 'A') #9EE09E;
                                    @endif">
                                    @if ($solicitud->estado == 'P')
                                        Pendiente
                                    @elseif ($solicitud->estado == 'A')
                                        Aprobada
                                    @elseif ($solicitud->estado == 'R')
                                        Rechazada
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('solicitud.show', $solicitud->id) }}" class="btn btn-info"><i class="fas fa-info-circle"></i> Ver detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">
                <ul class="pagination">
                    @if ($solicituds->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $solicituds->previousPageUrl() }}">Anterior</a></li>
                    @endif

                    @if ($solicituds->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $solicituds->nextPageUrl() }}">Siguiente</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>


@endsection
