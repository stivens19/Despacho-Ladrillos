@extends('layouts.app')
@section('estilos')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />
@endsection

@section('content')
<h1 class="h3 mb-2 text-gray-800">PEDIDOS PENDIENTES DEL USUARIO <span class="text-uppercase text-primary">{{ Auth::user()->name }}</span> </h1>
<p class="mb-4">Verifique los pedidos correspondientes a su usuario</p>

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
            <th>FECHA_ENTREGA</th>
            <th>CANTIDAD</th>
            <th>TIPO_LADRILLO</th>
            <th>CLIENTE</th>
            <th>ESTADO</th>
            <th>HORNO</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                @if ($pedido->status != 'cancelado')
                <tr>
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