@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">LADRILLOS</h1>
<p class="mb-4">Agregue un tipo de ladrillo</p>

<button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#ladrillos">
    <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
    <span class="text">AGREGAR LADRILLO</span>
</button>
<div id="ladrillos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar TIPO DE LADRILLO</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="{{ route('ladrillos.store') }}">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">TIPO DE LADRILLO</label>
                        <input id="type" class="form-control" type="text" name="type" placeholder="Ingrese Tipo de Ladrillo" value="{{ old('type') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">PRECIO POR MILLAR(S/)</label>
                        <input id="price" class="form-control" type="number" name="price" min="0" step=".5" value="{{ old('price') }}" placeholder="Ingrese el precio del ladrillo">
                    </div>
                    <div class="form-group">
                        <label for="stock">STOCK</label>
                        <input id="stock" class="form-control" type="number" name="stock" min="0" step=".5" value="{{ old('stock') }}" placeholder="Ingrese el stock">
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
                        <span class="text">Agregar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Lista de Tipo de Ladrillos</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>TIPO</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>TIPO</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>ESTADO</th>
            <th>ACCIONES</th>
          </tr>
        </tfoot>
        <tbody>
            @foreach ($ladrillos as $ladrillo)
                <tr>
                    <td>{{ $ladrillo->type }}</td>
                    <td> <span class="badge badge-primary">S/ {{ $ladrillo->price }}</span></td>
                    <td>{{ $ladrillo->stock }}</td>
                    <td>
                        <form method="post" action="{{ route('ladrillos.destroy',$ladrillo->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-{{ ($ladrillo->status == 'inactivo') ? 'danger' : 'primary'  }} btn-circle">
                                @if ($ladrillo->status == 'inactivo')
                                <i class="fas fa-key"></i>
                                @else
                                <i class="fas fa-lock"></i>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('ladrillos.edit',$ladrillo->id) }}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
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