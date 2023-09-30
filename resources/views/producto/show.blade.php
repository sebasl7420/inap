@extends('layout.master')

@section('main')
<title>Detalles producto {{ $producto->codigo_producto }} </title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><i class="fas fa-info-circle"></i> Detalle Producto</h3>
                    {{-- <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap"> --}}
                    <h1 class="card-title">{{ $producto->nombre_producto }} ({{ $producto->marca}})</h1>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>Código:</strong> {{ $producto->codigo_producto }}</p>
                    <p class="card-text"><strong>Categoria:</strong> {{ $producto->categoria->nombre_categoria }}</p>
                    @if ($producto->stock_empaque > 0) 
                        <p class="card-text"><strong>Disponibilidad:</strong> En stock<i class="fas fa-check-circle text-success"></i></p>
                    @else 
                        <p class="card-text"><strong>Disponibilidad:</strong> Agotado<i class="fas fa-times-circle text-danger"></i> </p>
                    @endif
                    <p class="card-text"><strong>Dependencia:</strong> {{ $producto->dependencia }}</p>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('producto') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
                    <a href="{{ route('producto.edit', $producto->id) }}" class="btn btn-info"><i class="fas fa-pen"></i> Editar</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>


    {{-- modal --}}
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
                    ¿Esta seguro de que quiere borrar el producto {{ $producto->nombre }} ?
                </div>
                <div class="modal-footer">

                    <form method="POST" action="{{ route('producto.destroy', $producto->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Borrar Producto</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
