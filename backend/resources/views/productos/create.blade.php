@extends('adminlte::page')

@section('title', 'Agregar Producto')

@section('content_header')
    <div class="card shadow bg-dark text-white px-4 py-2 d-flex flex-row justify-content-between align-items-center">
        <h4 class="mb-0">Agregar Nuevo Producto</h4>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-lg p-4 rounded-4 w-100 mx-auto" style="background: #f0f0f0; border: none; max-width: 1000px;">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Nombre</label>
                                    <input type="text" name="nombre" class="form-control border-dark" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Stock</label>
                                    <input type="number" name="stock" class="form-control border-dark text-center" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Precio</label>
                                    <input type="number" step="0.01" name="precio" class="form-control border-dark text-center" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Descripción</label>
                                    <textarea name="descripcion" class="form-control border-dark" rows="2" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Categoría</label>
                                    <select name="categoria_id" class="form-control border-dark">
                                        <option value="">Seleccione</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Estado</label>
                                    <select name="estado" class="form-control border-dark">
                                        <option value="disponible">Disponible</option>
                                        <option value="agotado">Agotado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Talla</label>
                                    <input type="text" name="talla" class="form-control border-dark">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Color</label>
                                    <input type="text" name="color" class="form-control border-dark">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-2">
                                    <label class="form-label text-dark small">Destacado</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="destacado" id="destacado" value="1">
                                        <label class="form-check-label" for="destacado">Marcar como destacado</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda columna - Imagen -->
                    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                        <label class="form-label text-dark small">Imagen del Producto</label>
                        <div class="position-relative">
                            <img id="product-img-preview"
                                 src="{{ asset('storage/images/productos/default-150x150.png') }}"
                                 class="img-fluid shadow"
                                 style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #000000;">

                            <div class="camera-icon position-absolute bottom-0 start-50 translate-middle-x"
                                 style="background-color: rgba(0, 0, 0, 0.6); border-radius: 50%; padding: 4px; cursor: pointer;">
                                <i class="fas fa-camera text-white" style="font-size: 18px;"></i>
                            </div>
                        </div>
                        <input type="file" name="imagen" id="product-image" class="d-none" accept="image/*">
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-dark px-4 py-2 update-btn">Guardar</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-light px-4 py-2 cancel-btn ms-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Fijar la barra lateral */
        .main-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            overflow-y: auto;
            z-index: 1000;
        }

        .camera-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .cancel-btn, .update-btn {
            width: 140px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: bold;
        }

        .container {
            padding-top: 20px;
        }

        .form-control {
            border-radius: 8px;
            padding: 8px;
            font-size: 14px;
        }

        body {
            background-color: #e6f1f6;
        }

        .card {
            width: 100%;
        }

        .alert-danger {
            font-size: 14px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
        }
    </style>
@stop

@section('js')
    <script>
        document.querySelector('.camera-icon').addEventListener('click', function() {
            document.getElementById('product-image').click();
        });

        document.getElementById('product-image').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('product-img-preview').src = event.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@stop
