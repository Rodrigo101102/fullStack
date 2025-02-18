@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1 class="text-white text-center py-2" style="background: #222; border-radius: 8px;">Mis datos</h1>
@stop

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow-lg p-4 rounded-4" style="background: #1E1E1E; border: none; width: 100%; max-width: 750px;">
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
                <div class="col-md-8">
                    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="fw-bold text-white">Nombre</label>
                            <input type="text" name="name" class="form-control input-custom" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold text-white">Email</label>
                            <input type="email" name="email" class="form-control input-custom" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold text-white">Nueva Contraseña <small class="text-muted">(opcional)</small></label>
                            <input type="password" name="password" class="form-control input-custom" placeholder="Dejar en blanco para mantener actual">
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-dark px-4 py-2 update-btn">Actualizar</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary px-4 py-2 cancel-btn ms-2">Cancelar</a>
                        </div>

                        <!-- Input oculto para subir la imagen -->
                        <input type="file" name="images" id="images" class="d-none" accept="image/*">
                    </form>
                </div>

                <!-- Imagen del Usuario (Negro y Elegante) -->
                <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
                    <div class="profile-img-container">
                        <img id="profile-img-preview"
                             src="{{ asset($user->images ?? 'vendor/adminlte/dist/img/default-user.png') }}" 
                             alt="Imagen de perfil"
                             class="img-fluid profile-img shadow">
                        <div class="camera-icon" onclick="document.getElementById('images').click();">
                            <i class="fas fa-camera text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Estilos de la imagen de perfil */
        .profile-img-container {
            position: relative;
            display: inline-block;
            border-radius: 50%;
            overflow: hidden;
            width: 180px;
            height: 180px;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #000;
        }

        .camera-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            padding: 8px;
            cursor: pointer;
        }

        .camera-icon i {
            font-size: 20px;
        }

        .camera-icon:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Estilos de la tarjeta */
        .card {
            max-width: 750px;
            border-radius: 12px;
            color: white;
        }

        .update-btn {
            background-color: #000;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .update-btn:hover {
            background-color: #333;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .cancel-btn {
            background-color: #444;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .cancel-btn:hover {
            background-color: #666;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .input-custom {
            border-radius: 8px;
            border: 2px solid #000;
            padding: 10px;
            font-size: 15px;
            background-color: #222;
            color: white;
        }

        .input-custom:focus {
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .container {
            padding-top: 30px;
        }

        body {
            background-color: #121212;
        }
    </style>
@stop

@section('js')
    <script>
        // Cambiar la imagen al hacer clic en el ícono de la cámara
        document.getElementById('images').addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profile-img-preview').src = event.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Asegurar que la imagen se suba correctamente con el formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('images');
            if (fileInput.files.length > 0) {
                // Agregar el input al formulario antes de enviarlo
                let formData = new FormData(this);
                formData.append('images', fileInput.files[0]);
            }
        });
    </script>
@stop
