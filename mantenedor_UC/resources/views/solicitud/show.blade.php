@extends('layout.master')

@section('main')
<title>Solicitud N°{{ $solicitud->id }}</title>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            @if (session('error'))
                <div class="alert alert-danger" style="background-color: gray; color: white;">
                    {{ session('error') }}
                </div>
            @endif
            <h3>N° Solicitud {{ $solicitud->id }}</h3>
            <a><strong>Productos solicitados:</strong></a>
                <p id="productoInfo">{{ $solicitud->json }}</p>
                <ul id="listaProductos">
                    <!-- Aquí se mostrará la lista de productos -->
                </ul>
            <a><strong>Fecha de Emisión: </strong>{{ $solicitud->fecha_emision }} </a>
            <form method="POST" action="{{ route('solicitud.update', $solicitud->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input type="hidden" id="json" name="json" rows="10" cols="50" value="{{ $solicitud->json }}">
                    <label for="estado"><strong>Estado de la Solicitud:</strong></label>
                    @if ($solicitud->estado == 'A')
                        <label for="estado"><strong>APROBADA</strong></label>
                        <i class="fas fa-check-circle text-success"></i>
                        <div class="form-group mt-2">
                            <a href="{{ route('inicio') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
                        </div>
                    @elseif ($solicitud->estado == 'R')
                        <label for="estado"><strong> RECHAZADA</strong></label>
                        <i class="fas fa-times-circle text-danger"></i> 
                        <div class="form-group mt-2">
                            <a href="{{ route('inicio') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
                        </div>
                    @else
                        <select id="estado" name="estado" onchange="checkEstado()" class="form-control">
                            <option value="P" @if ($solicitud->estado == 'P') selected="selected" @endif>Pendiente</option>
                            <option value="A" @if ($solicitud->estado == 'A') selected="selected" @endif>Aprobada</option>
                            <option value="R" @if ($solicitud->estado == 'R') selected="selected" @endif>Rechazada</option>
                        </select>
                        <br>
                        <div class="form-group mt-2">
                            <a href="{{ route('inicio') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
                            <a href="{{ route('solicitud.edit', $solicitud->id) }}" class="btn btn-info"><i class="fas fa-pen"></i> Editar</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Productos Disponibles</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Material</th>
                            <th>Existencia</th>
                            <th>Stock Crítico</th>
                            <th>Dependencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->nombre_producto }}({{ $producto->marca }})</td>
                                <td>{{ $producto->stock_empaque }}</td>
                                <td>{{ $producto->stock_critico_empaque }}</td>
                                <td>{{ $producto->dependencia }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    ¿Esta seguro de que quiere rechazar la solicitud {{ $solicitud->nombre }} ?
                </div>
                <div class="modal-footer">

                    <form method="POST" action="{{ route('solicitud.destroy', $solicitud->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Borrar solicitud</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>
        // Obtener el contenido de la etiqueta 'productoInfo'
        var productoInfo = document.getElementById('productoInfo').innerText;

        // Convertir el contenido JSON en un array de objetos JavaScript
        var productos = JSON.parse(productoInfo);

        // Mostrar los elementos de la lista en el documento
        var listaProductos = document.getElementById('listaProductos');
        productos.forEach(function(producto) {
            var li = document.createElement('li');
            li.textContent = producto.id.split(':')[1] + ' - Cantidad: ' + producto.cant;
            listaProductos.appendChild(li);
        });
    </script>





@endsection
