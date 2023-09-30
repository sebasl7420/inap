@extends('layout.master')

@section('main')
<title>Editar {{$unidad->id}}</title>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Editar Unidad</h3>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('unidad.update', $unidad->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Aqui Nombre del unidad"
                                    value="{{ $unidad->nombre }}" required>
                                <label for="sede">Sede unidad:</label>
                                <select id="sede" name="sede" class="form-control" required>
                                    <option value="Santa Lucia" @if ($unidad->sede == "Santa Lucia") selected="selected" @endif>Santa Lucia</option>
                                    <option value="Rebeca Matte" @if ($unidad->sede == "Rebeca Matte") selected="selected" @endif>Rebeca Matte</option>
                                    <option value="Huerfanos" @if ($unidad->sede == "Huerfanos") selected="selected" @endif>Huerfanos</option>
                                </select>
                                <div class="form-group mt-2">
                                    <a href="{{ route('unidad') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Editar Unidad</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-trash"></i> Eliminar</button>
                                </div>
                            </div>
                        </form>
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
                    ¿Esta seguro de que quiere borrar el unidad {{ $unidad->nombre }} ?
                </div>
                <div class="modal-footer">

                    <form method="POST" action="{{ route('unidad.destroy', $unidad->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Borrar unidad</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
