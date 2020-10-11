@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Editar Usuario <span class="badge badge-primary">{{ $user->name }}</span></h1>
    <p class="mb-4">Edite el usuario</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulario de Edicion</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update',$user->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="role_id">Rol</label>
                        <select id="role_id" class="form-control" name="role_id">
                            <option value="">--Seleccione una Opcion</option>
                            @foreach ($roles as $role)
                               <option {{ ($role->id == $user->role_id) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->display_name }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ $user->name ?? old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" name="dni" id="dni" value="{{ $user->dni ?? old('dni') }}" >
    
                    </div>
    

                </div>
                <div class="col-sm-12 col-md-6 border-left-primary">
                    <div class="form-group">
                        <label for="placa">Placa(**Opcional**)</label>
                        <input id="placa" class="form-control" type="text" name="placa" value="{{ $user->placa ?? old('placa')  }}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="Ingrese el email" value="{{ $user->email ?? old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" class="form-control" type="password" name="password" placeholder="Ingrese su contraseña">
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-outline-primary">Editar Rol</button>
            </form>
        </div>
    </div>
@endsection
