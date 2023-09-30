@extends('layout.master')

@section('main')
<title>Productos</title>
<h3 class="title mt-4">Lista de Productos</h3>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('buscar.producto') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar producto por nombre o codigo">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="table-responsive" style="max-height: 68vh;">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Código<a class="sort-btn" data-sort="codigo_producto"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Nombre<a class="sort-btn" data-sort="nombre_producto"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Existencia<a class="sort-btn" data-sort="stock_empaque"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Stock crítico<a class="sort-btn" data-sort="stock_critico_empaque"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Categoría<a class="sort-btn" data-sort="categoria"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Dependencia<a class="sort-btn" data-sort="categoria"><i class="fa-solid fa-arrows-up-down"></i></a></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td data-col="codigo_producto">{{ $producto->codigo_producto }}</td>
                                <td data-col="nombre_producto">{{ $producto->nombre_producto }} - {{ $producto->marca }}</td>
                                <td data-col="stock_empaque">{{ $producto->stock_empaque }}</td>
                                <td data-col="stock_critico_empaque" class="{{ $producto->stock_critico_empaque >= $producto->stock_empaque ? 'table-danger' : '' }}">
                                    {{ $producto->stock_critico_empaque }}</td>
                                <td data-col="categoria">{{ $producto->categoria->nombre_categoria }}</td>
                                <td data-col="dependencia">{{ $producto->dependencia }}</td>
                                <td>
                                    <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-info" title="Ver detalles">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation mt-2">
                <ul class="pagination justify-content-center">
                    @if ($productos->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                    @else
                        <li class="page-item"><a class="page-link"
                                href="{{ $productos->previousPageUrl() }}">Anterior</a></li>
                    @endif

                    @if ($productos->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $productos->nextPageUrl() }}">Siguiente</a>
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
