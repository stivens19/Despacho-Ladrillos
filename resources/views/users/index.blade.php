@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
<p class="mb-4">Agregue usuarios</p>


<button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#users">
    <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
    <span class="text">AGREGAR USUARIO</span>
</button>



<div id="users" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar Usuario</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="{{ route('users.store') }}">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role_id">Rol</label>
                        <select id="role_id" class="form-control" name="role_id">
                            <option value="">--Seleccione una Opcion</option>
                            @foreach ($roles as $role)
                               <option value="{{ $role->id }}">{{ $role->display_name }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre del usuario">
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" name="dni" id="dni" placeholder="Ingrese DNI">

                    </div>

                    <div class="form-group">
                        <label for="placa">Placa(**Opcional**)</label>
                        <input id="placa" class="form-control" type="text" name="placa" placeholder="Ingrese la placa del chofer">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="Ingrese el email">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" class="form-control" type="password" name="password" placeholder="Ingrese su contraseña">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-icon-split" type="submit">
                        <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
                        <span class="text">Agregar Usuario</span>
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
            <th>ROL</th>
            <th>NOMBRE</th>
            <th>DNI</th>
            <th>PLACA</th>
            <th>EMAIL</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ROL</th>
            <th>NOMBRE</th>
            <th>DNI</th>
            <th>PLACA</th>
            <th>EMAIL</th>
            <th>ACCIONES</th>
          </tr>
        </tfoot>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td> <span class="badge badge-dark">{{ $user->role->display_name }}</span></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->dni }}</td>
                    <td><span class="badge badge-primary text-uppercase">{{ ($user->placa) ? $user->placa : 'Sin placa' }}</span></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-circle"> <i class="fas fa-pen"></i></a>

                        <form method="post" action="{{ route('users.destroy',$user->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-circle">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
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