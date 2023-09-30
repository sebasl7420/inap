@extends('layout.master')

@section('main')
    
    <h3>Usuarios</h3>

    <div class="row mt-2">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Identificador</th>
                <th>Reiniciar clave</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($usuarios as $usuario)
              <tr>
                <th>{{ $usuario->username }}</th>
                <th>
                  <a href="{{ route('usuario.edit',$usuario->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i> </a>
                </th>
              </tr> 
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
 
 
@endsection