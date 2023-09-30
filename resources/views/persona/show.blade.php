@extends('layout.master')

@section('main')
    <h3>Editar Persona</h3>

    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $persona->nombre }}</h5>
            <p class="card-text">{{ $producto->descripcion }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{ $producto->categoria }}</li>
            <li class="list-group-item">{{ $producto->codigo_barra }}</li>
        </ul>
        <div class="card-body">
            <a href="{{ route('producto') }}" class="btn btn-warning">Volver</a>
            <a href="{{ route('producto.edit', $producto->id) }}" class="btn btn-info">Editar</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Borrar
                Producto</button>
            </form>
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
