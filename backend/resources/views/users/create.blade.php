@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1 class="text-center text-dark fw-bold">Crear Nuevo Usuario</h1>
@stop

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow-lg p-4 rounded-4" style="background: #f0f0f0; border: none; width: 100%; max-width: 900px;">
            <!-- Errores globales -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <!-- Formulario -->
                <div class="col-md-6">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombre -->
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">Nombre</label>
                            <input type="text" name="name" class="form-control border-dark" value="{{ old('name') }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">Email</label>
                            <input type="email" name="email" class="form-control border-dark" value="{{ old('email') }}" required>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group mb-3">
                            <label class="fw-bold text-dark">Contraseña</label>
                            <input type="password" name="password" class="form-control border-dark" required>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-dark px-4 py-2 update-btn">Guardar</button>
                            <a href="{{ route('users.index') }}" class="btn btn-light px-4 py-2 cancel-btn ms-2">Cancelar</a>
                        </div>
                    </form>
                </div>

                <!-- Imagen de perfil -->
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="position-relative">
                        <h5 class="fw-bold text-dark text-center mb-3">Imagen de perfil</h5>
                        <!-- Imagen de perfil -->
                        <img src="{{ asset('vendor/adminlte/dist/img/default-user.png') }}" 
                             class="img-fluid rounded-circle profile-img shadow" 
                             style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #000000;">
                        <!-- Icono de cámara para cambiar la imagen -->
                        <div class="camera-icon position-absolute bottom-0 end-0" style="background-color: rgba(0, 0, 0, 0.6); border-radius: 50%; padding: 5px;">
                            <i class="fas fa-camera text-white" style="font-size: 20px;"></i>
                        </div>
                        <!-- Input oculto para seleccionar la imagen -->
                        <input type="file" name="images" id="images" class="d-none" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .camera-icon:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .cancel-btn, .update-btn {
            width: 150px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
        }

        .container {
            padding-top: 30px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
        }

        .col-md-6 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body {
            background-color: #e6f1f6;
        }

        .card {
            width: 100%;
        }

        .alert-danger {
            font-size: 16px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert-danger li {
            font-weight: normal;
        }
    </style>
@stop

@section('js')
    <script>
        // Cambiar la imagen al hacer clic en el ícono de la cámara
        document.querySelector('.camera-icon').addEventListener('click', function() {
            document.getElementById('images').click();
        });

        // Mostrar la vista previa de la imagen seleccionada
        document.getElementById('images').addEventListener('change', function(e) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.querySelector('.profile-img').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    </script>
@stop
