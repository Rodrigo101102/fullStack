@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" value ="{{$user->password}}" class="form-control">

        </div>
        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>
@stop
