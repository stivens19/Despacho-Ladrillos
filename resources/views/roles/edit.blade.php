@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Editar Rol  <span class="badge badge-primary">{{ $role->display_name }}</span></h1>
    <p class="mb-4">Edite el rol en caso de ser necesario</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Edicion</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.update',$role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ $role->name ?? old('name') }}" placeholder="Ingrese el nombre del rol">
                </div>
                <div class="form-group">
                    <label for="display_name">Nombre Identificador</label>
                    <input id="display_name" class="form-control" type="text" name="display_name" placeholder="Ingrese el nombre identificador del rol" value="{{ $role->display_name ?? old('display_name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea id="description" class="form-control" name="description" rows="3" placeholder="Ingrese la descripcion del rol">{{ $role->description ?? old('description') }}</textarea>

                </div>

                <button type="submit" class="btn btn-outline-primary">Editar Rol</button>
            </form>
        </div>
    </div>
@endsection
