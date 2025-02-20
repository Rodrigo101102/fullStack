@extends('adminlte::page')

@section('title', 'Agregar Categoría')

@section('content_header')
    <h1 class="text-center text-dark fw-bold">Agregar Categoría</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="fw-bold">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="fw-bold">Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@stop
