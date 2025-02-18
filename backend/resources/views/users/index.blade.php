@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <h4 class="mb-0 mx-auto">Usuarios</h4> <!-- Título centrado -->
            <a href="{{ route('users.create') }}" class="btn btn-dark px-3 py-2 btn-add-user">
                <i class="fas fa-user-plus"></i> Agregar Usuario
            </a>
        </div>
        <div class="card-body">
            <!-- Formulario de búsqueda centrado -->
            <form action="{{ route('users.index') }}" method="GET" class="d-flex justify-content-center mb-3">
                <input type="text" name="search" id="search" class="form-control w-50" placeholder="Buscar por nombre..." value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary ml-2">Buscar</button>
            </form>

            <table class="table table-hover table-striped text-center align-middle" id="usuarios-table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de Creación</th>
                        <th>Perfil</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if ($usuario->images)
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $usuario->id }}">
                                        Visualizar
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal{{ $usuario->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $usuario->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-2" style="width: 300px; margin: auto; border-radius: 10px;">
                                                <div class="modal-header p-1" style="border-bottom: none;">
                                                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset($usuario->images) }}" alt="Imagen de perfil" class="img-fluid rounded shadow-sm" style="max-width: 100%; border-radius: 10px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $usuario) }}" class="btn btn-success btn-sm">Editar</a>
                                <form action="{{ route('users.destroy', $usuario) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- PAGINACIÓN -->
            <div class="d-flex justify-content-center mt-3">
                {{ $usuarios->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stop

@section('css')
    <style>
        /* Estilo del botón Agregar Usuario */
        .btn-add-user {
            background-color: #000; /* Negro */
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-add-user:hover {
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

        /* Ajustes generales */
        .container {
            padding-top: 30px;
        }

        body {
            background-color: #f4f6f9;
        }

        /* Estilo de búsqueda */
        form {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input[type="text"] {
            width: 50%;
            margin-right: 10px;
            border-radius: 5px;
            padding: 5px;
        }

        .btn-primary {
            padding: 5px 15px;
            border-radius: 5px;
        }
    </style>
@stop

@section('js')
    <script>
        // Realizar búsqueda sin recargar la página
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#usuarios-table tbody tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@stop
