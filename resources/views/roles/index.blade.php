@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Roles</h1>
<p class="mb-4">Agregue los roles</p>

<button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#roles">
    <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
    <span class="text">AGREGAR ROLES</span>
</button>
<div id="roles" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar Rol</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="{{ route('roles.store') }}">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre del rol">
                    </div>
                    <div class="form-group">
                        <label for="display_name">Nombre Identificador</label>
                        <input id="display_name" class="form-control" type="text" name="display_name" placeholder="Ingrese el nombre identificador del rol">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion</label>
                        <textarea id="description" class="form-control" name="description" rows="3" placeholder="Ingrese la descripcion del rol"></textarea>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-icon-split" type="submit">
                        <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
                        <span class="text">Agregar Rol</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Lista de Roles</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>NOMBRE</th>
            <th>NOMBRE IDENTIFICADOR</th>
            <th>DESCRIPCION</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>NOMBRE</th>
            <th>NOMBRE IDENTIFICADOR</th>
            <th>DESCRIPCION</th>
            <th>ACCIONES</th>
          </tr>
        </tfoot>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-warning">Editar <i class="fas fa-pen"></i></a>
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