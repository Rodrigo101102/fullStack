@extends('adminlte::page')

@section('title', 'Lista de Productos')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <h4 class="mb-0 mx-auto">Lista de Productos</h4>
            <a href="{{ route('productos.create') }}" class="btn btn-dark px-3 py-2 btn-add-product">
                <i class="fas fa-plus"></i> Agregar Producto
            </a>
        </div>

        <div class="card-body">
            <!-- Formulario de búsqueda con filtros de nombre y categoría -->
            <form action="{{ route('productos.index') }}" method="GET" class="d-flex justify-content-center mb-3">
                <input type="text" name="search" id="search" class="form-control w-25 me-2" placeholder="Buscar por nombre..." value="{{ request()->get('search') }}">
                
                <select name="categoria" id="categoria" class="form-control w-25 me-2">
                    <option value="">Seleccionar categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ request()->get('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

            <table class="table table-hover table-striped text-center align-middle" id="productos-table">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Talla</th>
                        <th>Color</th>
                        <th>Estado</th>
                        <th>Destacado</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->imagen)
                                    <img src="{{ asset('storage/'.$product->imagen) }}" width="50" class="img-thumbnail">
                                @else
                                    <span>Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $product->nombre }}</td>
                            <td style="white-space: nowrap;">S/. {{ number_format($product->precio, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->talla ?? 'N/A' }}</td>
                            <td>{{ $product->color ?? 'N/A' }}</td>
                            <td>
                                @if($product->estado == 'disponible')
                                    <span class="badge bg-success text-white">Disponible</span>
                                @else
                                    <span class="badge bg-danger text-white">Agotado</span>
                                @endif
                            </td>
                            <td>
                                @if($product->destacado)
                                    <span class="badge bg-warning text-dark">Sí</span>
                                @else
                                    <span class="badge bg-secondary text-white">No</span>
                                @endif
                            </td>
                            <td>{{ $product->categoria->nombre }}</td>
                            <td>
                                <div class="d-flex flex-column align-items-center">
                                    <a href="{{ route('productos.edit', $product->id) }}" class="btn btn-sm btn-success mb-2 action-btn">Editar</a>
                                    <form action="{{ route('productos.destroy', $product->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- PAGINACIÓN -->
            <div class="d-flex justify-content-center mt-3">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stop

@section('css')
    <style>
        /* Estilo del botón Agregar Producto */
        .btn-add-product {
            background-color: #000; /* Negro */
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-add-product:hover {
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

        /* Ajustes generales */
        .container {
            padding-top: 30px;
        }

        body {
            background-color: #f4f6f9;
        }

        /* Estilo del buscador */
        form {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input[type="text"], select {
            border-radius: 5px;
            padding: 5px;
        }

        .btn-primary {
            padding: 5px 15px;
            border-radius: 5px;
        }

        /* Estilo para igualar tamaño de botones */
        .action-btn {
            width: 100px;
            text-align: center;
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById('search');
            const categorySelect = document.getElementById('categoria');
            const rows = document.querySelectorAll('#productos-table tbody tr');

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const selectedCategory = categorySelect.value;

                rows.forEach(row => {
                    const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const category = row.querySelector('td:nth-child(9)').textContent.trim();
                    
                    const matchesName = name.includes(searchValue) || searchValue === "";
                    const matchesCategory = category === selectedCategory || selectedCategory === "";

                    if (matchesName && matchesCategory) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            categorySelect.addEventListener('change', filterTable);
        });
    </script>
@stop
