@extends('layout.masterinvitado')

@section('main')
<title>Historial</title>
    <div class="container">
        <h3 class="title mt-4">Historial de solicitudes</h3>
        <div class="row mt-3">
            <div class="col">
                <div class="table-responsive" style="max-height: 59vh;">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Estado</th>
                                <th>Fecha emision</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicituds as $solicitud)
                                <tr>
                                    <th>{{ $solicitud->id }}</th>
                                    <th>
                                        @if ($solicitud->estado == 'P')
                                            Pendiente
                                        @elseif ($solicitud->estado == 'A')
                                            Aprobada
                                        @elseif ($solicitud->estado == 'R')
                                            Rechazada
                                        @endif
                                    </th>
                                    <th>{{ $solicitud->fecha_emision }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <a href="{{ route('solicitud.create') }}" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    @endsection
