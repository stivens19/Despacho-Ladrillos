@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">Clientes</h1>
<p class="mb-4">Agregar clientes</p>


<button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#customers">
    <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
    <span class="text">AGREGAR CLIENTE</span>
</button>



<div id="customers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar Cliente</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="{{ route('customers.store') }}">
                @csrf 
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre del cliente" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="adress">DIRECCION</label>
                        <input type="text" class="form-control" name="adress" id="adress" placeholder="Ingrese la Direccion" value="{{ old('adress') }}">

                    </div>

                    <div class="form-group">
                        <label for="phone">Celular</label>
                        <input id="phone" class="form-control" type="text" name="phone" placeholder="Ingrese el numero de Celular" value="{{ old('phone') }}">
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
                        <span class="text">Agregar Cliente</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Lista de Clientes</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>NOMBRE</th>
            <th>DIRECCION</th>
            <th>CELULAR</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>NOMBRE</th>
            <th>DIRECCION</th>
            <th>CELULAR</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
          </tr>
        </tfoot>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->name }}</td>
                    <td>{{ $cliente->adress }}</td>
                    <td> <span class="badge badge-primary">{{ $cliente->phone }}</span> </td>
                    
                    <td>
                        <form method="post" action="{{ route('customers.destroy',$cliente->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-{{ ($cliente->status == 'inactivo') ? 'danger' : 'primary'  }} btn-circle">
                                @if ($cliente->status == 'inactivo')
                                <i class="fas fa-key"></i>
                                @else
                                <i class="fas fa-lock"></i>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('customers.edit',$cliente->id) }}" class="btn btn-warning btn-circle"> <i class="fas fa-pen"></i></a>
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