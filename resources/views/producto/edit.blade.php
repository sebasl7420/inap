@extends('layout.master')

@section('main')
<title>Editar {{$producto->codigo_producto}}</title>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3><i class="fas fa-tools"></i> Editar Producto</h3>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('producto.update', $producto->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="subtitulos" for="codigo">Código:</label>
                    <input type="text" id="codigo" name="codigo" class="form-control" value="{{ $producto->codigo_producto }}" disabled>

                    <label class="subtitulos" for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $producto->nombre_producto }}">

                    <label class="subtitulos" for="model">Marca o Modelo:</label>
                    <input type="text" id="model" name="model" class="form-control" value="{{ $producto->marca }}">

                    <label class="subtitulos" for="stock_critico">Stock crítico:</label>
                    <input type="number" min="0" id="stock_critico" name="stock_critico" class="form-control" value="{{ $producto->stock_critico_empaque }}">

                    <label class="subtitulos" for="categoria">Categoría:</label>
                    <select class="form-control" id="categoria" name="categoria">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @if ($categoria->id === $producto->categoria_id) selected @endif>
                                {{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>

                    <label class="subtitulos" for="sede"> Dependencia:</label>
                    <select class="form-control" id="sede" name="sede" required>
                            <option value="Rebeca Matte" @if ("Rebeca Matte"== $producto->dependencia) selected="selected" @endif>Rebeca Matte</option>
                            <option value="Huerfanos" @if ("Huerfanos"== $producto->dependencia) selected="selected" @endif>Huerfanos</option>
                            <option value="Santa Lucia" @if ("Santa Lucia"== $producto->dependencia) selected="selected" @endif>Santa Lucia</option>
                    </select>

                    <label class="subtitulos" for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="..." class="form-control" value="{{ $producto->descripcion }}">

                    <div class="text-center mt-3">
                        <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-warning">Cancelar</a>
                        <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-edit"></i> Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection
