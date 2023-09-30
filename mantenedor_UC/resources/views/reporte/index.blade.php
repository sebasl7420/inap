@extends('layout.master')

@section('main')
<title>Reportes</title>
<div class="container mt-5 text-center" style="min-height: 100vh;">
    <h1 class="title">Reportes Excel</h1><br>
    <div class="row mt-3">
        <div class="col-md-4">
            <form method="POST" action="{{ route('documento') }}">
                @csrf
                <div class="form-group">
                    <label for="rut">Solicitudes por Rut:</label>
                    <input type="text" id="rut" name="rut" class="form-control" placeholder="XXXXXXXX-X">
                </div>
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fas fa-file-excel mr-2"></i> Descargar
                </button>
            </form>
            @if (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <form method="POST" action="{{ route('documento.unidad') }}">
                @csrf
                <div class="form-group">
                    <label for="rut">Solicitudes por Unidad:</label>
                    <select class="form-control" id="unidad" name="unidad">
                        @foreach ($unidads as $unidad)
                            <option value="{{ $unidad->id }}">{{ $unidad->nombre }} - {{ $unidad->sede }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fas fa-file-excel mr-2"></i> Descargar
                </button>
            </form>
            @if (session('error1'))
                <div class="alert alert-danger mt-3">
                    {{ session('error1') }}
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <p class="subtitulos"> Productos en Stock Crítico:</p>
            <a href="{{ route('documento.stock') }}" class="btn btn-success btn-block">
                <i class="fas fa-file-excel mr-2"></i> Descargar
            </a>
        </div>

        <div class="col-md-4">
            <p class="subtitulos"> Historico de Ajustes:</p>
            <a href="#" class="btn btn-success btn-block">
                <i class="fas fa-file-excel mr-2"></i> Descargar
            </a>
        </div>
    </div>
</div>

@endsection
