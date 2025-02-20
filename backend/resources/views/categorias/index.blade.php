@extends('adminlte::page')

@section('title', 'Lista de Categorías')

@section('content_header')
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <h4 class="mb-0 mx-auto">Lista de Categorías</h4>
            <a href="{{ route('categorias.create') }}" class="btn btn-dark px-3 py-2 btn-add-category">
                <i class="fas fa-plus"></i> Agregar Categoría
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-lg p-4 rounded-4">
            <table class="table table-hover table-bordered text-center">
                <thead class="table-dark">
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

            <div class="d-flex justify-content-center mt-3">
                {{ $categorias->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Estilo del botón Agregar Categoría */
        .btn-add-category {
            background-color: #000; /* Negro */
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-add-category:hover {
            background-color: #333;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
        }

        /* Estilo de la tabla y botones */
        .table th, .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            font-size: 14px;
        }

        /* Paginación */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .pagination .page-link {
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 16px;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .pagination .page-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .active .page-link {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination .page-item {
            margin: 0 5px;
        }
    </style>
@stop
