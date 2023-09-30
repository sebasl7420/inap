@extends('layout.master')

@section('main')
<title>Ajuste de productos</title>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3><i class="fas fa-tools"></i> Ajuste de Productos</h3>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('ajuste.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                    <label class="subtitulos" for="movimiento"><i class="fas fa-angle-right"></i>Movimiento</label>
                    <select id="movimiento" name="movimiento" class="form-control">
                        <option value="ingreso">Ingreso <i class="fas fa-plus"></i></option>
                        <option value="egreso">Egreso <i class="fas fa-minus"></i></option>
                    </select>
            
                    <label class="subtitulos" for="producto"><i class="fas fa-angle-right"></i> Producto</label>
                    <select id="producto" name="producto" class="form-control">
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->categoria->nombre_categoria }} - {{ $producto->nombre_producto }} ({{ $producto->marca }})</option>
                        @endforeach
                    </select>
                
                    <label class="subtitulos" for="stock"><i class="fas fa-angle-right"></i> Empaques</label>
                    <input type="number" id="stock" name="stock" min="1" class="form-control" value="0" required>
            
                    <label class="subtitulos" for="unidad"><i class="fas fa-angle-right"></i> Unidades por empaque</label>
                    <input type="number" id="unidad" name="unidad" min="1" class="form-control" value="0"  required>
                
                    <label class="subtitulos" for="motivo"><i class="fas fa-angle-right"></i> Motivo</label>
                    <input type="text" id="motivo" name="motivo" class="form-control" required>
                    
                    <label class="subtitulos" for="archivo"><i class="fas fa-angle-right"></i> Factura</label>
                    <input type="file" name="archivo" class="form-control">
                    <br>
                    <div class="text-center mt-3">
                        <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Registrar Ajuste</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<footer class="text-center mt-3">
    <p>&copy; 2023 Universidad De Chile. Todos los derechos reservados.</p>
</footer>

@endsection
