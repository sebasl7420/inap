@extends('layout.master')

@section('main')
<title>Agregar Producto</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3><i class="fas fa-cart-plus"></i> Agregar Producto</h3>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('producto.store') }}">

                <div class="form-group">
                    @csrf
                    
                    <div class="form-group">
                        <label class="subtitulos" for="sede"><i class="fas fa-angle-right"></i> Dependencia</label>
                        <select id="sede" name="sede" class="form-control" required>
                            <option value="Santa Lucia">Santa Lucia</option>
                            <option value="Rebeca Matte">Rebeca Matte</option>
                            <option value="Huerfanos">Huerfanos</option>
                        </select>
                    </div>

                    <label class="subtitulos" for="codigo"><i class="fas fa-barcode"></i> Código del producto</label>
                    <input type="text" id="codigo" name="codigo" placeholder="" class="form-control" required>

                    <label class="subtitulos" for="nombre"><i class="fas fa-tag"></i> Nombre del producto</label>
                    <input type="text" id="nombre" name="nombre" placeholder="" class="form-control" required>

                    <label class="subtitulos" for="model"><i class="fas fa-mobile-alt"></i> Marca / Modelo:</label>
                    <input type="text" id="model" name="model" placeholder="" class="form-control" required>

                    <label class="subtitulos" for="cantidad"><i class="fas fa-sort-numeric-up"></i> Unidades </label>
                    <input type="number" id="cantidad" name="cantidad" min="1" class="form-control" required>

                    <label class="subtitulos" for="stock_critico"><i class="fas fa-exclamation-triangle"></i> Stock crítico</label>
                    <input type="number" min="0" id="stock_critico" name="stock_critico" class="form-control">

                    <label class="subtitulos" for="categoria"><i class="fas fa-folder"></i> Categoría</label>
                    <select class="form-control" id="categoria" name="categoria">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>

                    <label class="subtitulos" for="descripcion"><i class="fas fa-file-alt"></i> Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="..." class="form-control" required>

                    <div class="text-center mt-3">
                        <a href="{{ route('producto') }}" class="btn btn-warning"><i class="fas fa-times"></i> Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
