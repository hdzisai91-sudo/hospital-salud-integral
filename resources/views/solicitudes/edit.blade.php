@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">✏️ Editar Solicitud</h2>

    <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- TÍTULO -->
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control"
                   value="{{ $solicitud->titulo }}" required>
        </div>

        <!-- ÁREA -->
        <div class="mb-3">
            <label>Área</label>
            <input type="text" name="area" class="form-control"
                   value="{{ $solicitud->area }}" required>
        </div>

        <!-- PRIORIDAD -->
        <div class="mb-3">
            <label>Prioridad</label>
            <select name="prioridad" class="form-control">
                <option {{ $solicitud->prioridad == 'Alta' ? 'selected' : '' }}>Alta</option>
                <option {{ $solicitud->prioridad == 'Media' ? 'selected' : '' }}>Media</option>
                <option {{ $solicitud->prioridad == 'Baja' ? 'selected' : '' }}>Baja</option>
            </select>
        </div>

        <!-- ESTADO -->
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option {{ $solicitud->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                <option {{ $solicitud->estado == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
            </select>
        </div>

        <button class="btn btn-primary">
            Actualizar
        </button>

    </form>

</div>

@endsection