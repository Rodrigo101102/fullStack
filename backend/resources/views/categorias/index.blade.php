@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1 class="text-center text-dark fw-bold">Lista de Categorías</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">Agregar Categoría</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>
                            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-success btn-sm">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar categoría?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categorias->links() }}
    </div>
@stop
