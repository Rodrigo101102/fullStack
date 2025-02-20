@extends('adminlte::page')

@section('title', 'Agregar Categoría')

@section('content_header')
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
            <h4 class="mb-0 mx-auto">Agregar Categoría</h4>
        </div>
    </div>
@stop

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow-lg p-4 rounded-4" style="background: #f0f0f0; border: none; width: 100%; max-width: 600px;">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre</label>
                    <input type="text" name="nombre" class="form-control border-dark" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="descripcion" class="form-control border-dark" rows="3" style="resize: none;"></textarea>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-dark px-4 py-2 update-btn">Guardar</button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-light px-4 py-2 cancel-btn ms-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
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
