@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1 class="text-center">Mi Perfil</h1>
@stop

@section('content')
    <div class="container mt-4">
        <!-- Card con los datos del usuario -->
        <div class="card shadow">
            <div class="card-header text-white" style="background-color: #050505;">
                <h5 class="mb-0">Mis Datos</h5>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <!-- Información del usuario -->
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Nombre:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Email:</strong></div>
                        <div class="col-md-8">{{ Auth::user()->email }}</div>
                    </div>
                    <!-- Agregar más datos si los tienes -->
                </div>

                <!-- Imagen de perfil -->
                <div class="col-md-4 text-center">
                    <img src="{{ asset(Auth::user()->images ?? 'default-profile.jpg') }}" class="img-fluid rounded-circle" alt="Imagen de perfil" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            border-radius: 15px;
            margin-top: 30px;
        }

        .card-header {
            background-color: #007bff;
        }

        .card-body {
            font-size: 16px;
        }

        .col-md-8 {
            font-size: 18px;
        }

        .text-center img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

    </style>
@stop

@section('js')
    <script> 
        console.log("Hi, I'm using the Laravel-AdminLTE package!"); 
    </script>
@stop
