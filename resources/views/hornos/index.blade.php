@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">HORNOS</h1>
<p class="mb-4">Agregue el Horno</p>

<button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#roles">
    <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
    <span class="text">AGREGAR HORNOS</span>
</button>
<div id="roles" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar Horno</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="{{ route('hornos.store') }}">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre Horno" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacidad del Horno</label>
                        <input id="capacity" class="form-control" type="number" name="capacity" min="0" step=".5" value="{{ old('capacity') }}" placeholder="Ingrese la capacidad del Horno">
                    </div>
                    <div class="form-group">
                        <label for="status">ESTADO</label>
                        <select id="status" class="form-control" name="status">
                            <option value="activo">ACTIVO</option>
                            <option value="inactivo">INACTIVO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-icon-split" type="submit">
                        <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
                        <span class="text">Agregar Horno</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Lista de Hornos</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>NOMBRE</th>
            <th>CAPACIDAD</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>NOMBRE</th>
            <th>NOMBRE IDENTIFICADOR</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
          </tr>
        </tfoot>
        <tbody>
            @foreach ($hornos as $horno)
                <tr>
                    <td>{{ $horno->name }}</td>
                    <td>{{ $horno->capacity }} <span class="badge badge-success">MILLARES</span></td>
                    <td>
                        <form method="post" action="{{ route('hornos.destroy',$horno->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-{{ ($horno->status == 'inactivo') ? 'danger' : 'primary'  }} btn-circle">
                                @if ($horno->status == 'inactivo')
                                <i class="fas fa-key"></i>
                                @else
                                <i class="fas fa-lock"></i>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('hornos.edit',$horno->id) }}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                    </td>

                </tr>
            @endforeach

          
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection