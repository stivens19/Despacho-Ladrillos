@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Editar Cliente <span class="badge badge-primary">{{ $customer->name }}</span></h1>
    <p class="mb-4">Edite el Cliente</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Edicion</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('customers.update',$customer->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre del cliente" value="{{ $customer->name ?? old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="adress">DIRECCION</label>
                        <input type="text" class="form-control" name="adress" id="adress" placeholder="Ingrese la Direccion" value="{{ $customer->adress ?? old('adress') }}">

                    </div>

                    <div class="form-group">
                        <label for="phone">Celular</label>
                        <input id="phone" class="form-control" type="text" name="phone" placeholder="Ingrese el numero de Celular" value="{{ $customer->phone ?? old('phone') }}">
                    </div>
                    <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-user-edit"></i>Actualizar</button>
                </div>
                
            </form>
        </div>
    </div>
@endsection
