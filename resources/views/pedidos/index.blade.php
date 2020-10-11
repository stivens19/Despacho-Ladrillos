@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">PEDIDOS</h1>
<p class="mb-4">Gestione sus pedidos</p>

<button class="btn btn-primary btn-icon-split" type="button" data-toggle="modal" data-target="#ladrillos">
    <span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span>
    <span class="text">AGREGAR PEDIDO</span>
</button>

<div id="ladrillos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Agregar PEDIDO</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form method="post" action="{{ route('pedidos.store') }}">
                @csrf 
                <div class="modal-body">
                    <div class="form-group">
                        <label for="codigo">CODIGO</label>
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Ingrese Codigo" value="{{ old('codigo') }}">
                    </div>
                    <div class="form-group">

                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/ name="delivery_date">
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity">CANTIDAD</label>
                        <input id="quantity" class="form-control" type="number" min="0" name="quantity" placeholder="Ingrese la cantidad en millares" value="{{ old('quantity') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="ladrillo_id">TIPO DE LADRILLO</label>
                        <select id="ladrillo_id" class="form-control" name="ladrillo_id">
                            <option value="">--Seleccione un tipo de ladrillo</option>
                            @foreach ($ladrillos as $ladrillo)
                                <option value="{{ $ladrillo->id }}">{{ $ladrillo->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="delivery_type">TIPO DE ENTREGA</label>
                        <select id="delivery_type" class="form-control" name="delivery_type">
                            <option value="">--Seleccione un tipo de Envio</option>
                            <option value="OBRA">OBRA</option>
                            <option value="PLANTA">PLANTA</option>
                            <option value="TRAILER">TRAILER</option>
                        </select>
                    </div>

                    
                    <div class="form-group">
                        <label for="customer_id">CLIENTE</label>
                        <select id="customer_id" class="form-control" name="customer_id">
                            <option value="">--Seleccione un cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="horno_id">HORNO</label>
                        <select id="horno_id" class="form-control" name="horno_id">
                            <option value="">--Seleccione un  horno</option>
                            @foreach ($hornos as $horno)
                                <option value="{{ $horno->id }}">{{ $horno->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user_id">CHOFER</label>
                        <select id="user_id" class="form-control" name="user_id">
                            <option value="">--Seleccione un chofer</option>
                            @foreach ($choferes as $chofer)
                                <option value="{{ $chofer->id }}">{{ $chofer->name }}</option>
                            @endforeach
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
    <span class="badge badge-success">EL COLOR VERDE REPRESENTA QUE FALTA DE 1 DIA A MAS</span>
    <br>
    <span class="badge badge-warning">EL COLOR AMARILLO REPRESENTA QUE ES EL DIA DE LA ENTREGA</span>
    <br>
    <span class="badge badge-danger">EL COLOR ROJO REPRESENTA QUE YA PASO EL DIA DE ENTREGA</span>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>CODIGO</th>
            <th>FECHA_ENTREGA</th>
            <th>CANTIDAD</th>
            <th>TIPO_LADRILLO</th>
            <th>TIPO_ENTREGA</th>
            <th>CLIENTE</th>
            <th>ESTADO</th>
            <th>HORNO</th>
            <th>CHOFER</th>
            <th>ACCIONES</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                @if ($pedido->status != 'cancelado')
                <tr>
                    <td>{{ $pedido->codigo }}</td>
                    <td>

                        @if ($date == $pedido->delivery_date)
                            <span class="badge badge-warning">{{ $pedido->delivery_date }}</span>
                        @elseif($date > $pedido->delivery_date)
                        <span class="badge badge-danger">{{ $pedido->delivery_date }}</span>
                        @else
                        <span class="badge badge-success">{{ $pedido->delivery_date }}</span>
                        @endif
                        
                    </td>
                    <td>{{ $pedido->quantity }}</td>
                    <td>{{ $pedido->ladrillo->type }}</td>
                    <td>{{ $pedido->delivery_type }}</td>
                    <td>{{ $pedido->customer->name }}</td>
                    <td>
                        <form method="post" action="{{ route('pedidos.cambio',$pedido->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-{{ ($pedido->status == 'pendiente') ? 'warning' : 'success'  }} ">
                                @if ($pedido->status == 'pendiente')

                                PENDIENTE
                                @else

                                ENTREGADO
                                @endif
                            </button>
                        </form>
                    </td>
                    <td>{{ $pedido->horno->name }}</td>
                    <td>{{ $pedido->user->name }}</td>
                    <td>
                        <form method="post" action="{{ route('pedidos.destroy',$pedido->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-circle" type="submit">X</button>
                        </form>
                        {{-- <ahref="route('ladrillos.edit',$ladrillo->id)" class="btn btn-warning"><i class="fas fa-pen"></i></a>--}}
                    </td>

                </tr> 
            @endif

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js" integrity="sha512-Izh34nqeeR7/nwthfeE0SI3c8uhFSnqxV0sI9TvTcXiFJkMd6fB644O64BRq2P/LA/+7eRvCw4GmLsXksyTHBg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment-with-locales.min.js" integrity="sha512-EATaemfsDRVs6gs1pHbvhc6+rKFGv8+w4Wnxk4LmkC0fzdVoyWb+Xtexfrszd1YuUMBEhucNuorkf8LpFBhj6w==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous" defer></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker4').datetimepicker({
            format: 'YYYY/MM/DD'
        });
    });
</script>
@endsection