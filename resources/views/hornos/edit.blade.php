@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Editar Horno <span class="badge badge-primary">{{ $horno->name }}</span></h1>
    <p class="mb-4">Edite el Horno</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Edicion</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('hornos.update',$horno->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="Ingrese el nombre del cliente" value="{{ $horno->name ?? old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="adress">CAPACIDAD DEL HORNO</label>
                        <input id="capacity" class="form-control" type="number" name="capacity" min="0" step=".5" value="{{ $horno->capacity ?? old('capacity') }}">

                    </div>
                    <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-pen-alt"></i>Actualizar</button>
                </div>
                
            </form>
        </div>
    </div>
@endsection
