@extends('adminlte::page')

@section('title', 'Editar Categoría')

@section('content_header')
    <h1 class="text-center text-dark fw-bold">Editar Categoría</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('categorias.update', $categoria) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="fw-bold">Nombre</label>
                <input type="text" name="nombre" value="{{ $categoria->nombre }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Descripción</label>
                <textarea name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@stop
