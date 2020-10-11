@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Editar Ladrillo <span class="badge badge-primary">{{ $ladrillo->type }}</span></h1>
    <p class="mb-4">Edite el Ladrillo</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Edicion</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ladrillos.update',$ladrillo->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="type">TIPO DE LADRILLO</label>
                        <input id="type" class="form-control" type="text" name="type" value="{{ $ladrillo->type ?? old('type') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">PRECIO POR MILLAR(S/)</label>
                        <input id="price" class="form-control" type="number" name="price" min="0" step=".5" value="{{ $ladrillo->price ?? old('price') }}" >
                    </div>
                    <div class="form-group">
                        <label for="stock">STOCK</label>
                        <input id="stock" class="form-control" type="number" name="stock" min="0" step=".5" value="{{ $ladrillo->stock ?? old('stock') }}" >
                    </div>
                    <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-pen-alt"></i>Actualizar</button>
                </div>
                
            </form>
        </div>
    </div>
@endsection
