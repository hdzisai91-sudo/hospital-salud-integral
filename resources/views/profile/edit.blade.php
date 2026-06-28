@extends('layouts.app')

@section('title', 'Editar Solicitud')

@section('content')

<div class="card p-4">

    <h3 class="mb-4">✏️ Editar Solicitud</h3>

    <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST">

        @csrf
        @method('PUT')

        <!-- TÍTULO -->
        <div class="mb-3">
            <label>Título</label>
            <input type="text"
                   name="titulo"
                   class="form-control"
                   value="{{ $solicitud->titulo }}"
                   required>
        </div>

        <!-- DESCRIPCIÓN -->
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion"
                      class="form-control"
                      rows="4"
                      required>{{ $solicitud->descripcion }}</textarea>
        </div>

        <!-- ÁREA -->
        <div class="mb-3">
            <label>Área</label>
            <input type="text"
                   name="area"
                   class="form-control"
                   value="{{ $solicitud->area }}"
                   required>
        </div>

        <!-- PRIORIDAD -->
        <div class="mb-3">
            <label>Prioridad</label>
            <select name="prioridad" class="form-select" required>

                <option value="Alta" {{ $solicitud->prioridad == 'Alta' ? 'selected' : '' }}>
                    Alta
                </option>

                <option value="Media" {{ $solicitud->prioridad == 'Media' ? 'selected' : '' }}>
                    Media
                </option>

                <option value="Baja" {{ $solicitud->prioridad == 'Baja' ? 'selected' : '' }}>
                    Baja
                </option>

            </select>
        </div>

        <!-- ESTADO -->
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-select">

                <option value="Pendiente" {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="En Proceso" {{ $solicitud->estado == 'En Proceso' ? 'selected' : '' }}>
                    En Proceso
                </option>

                <option value="Finalizada" {{ $solicitud->estado == 'Finalizada' ? 'selected' : '' }}>
                    Finalizada
                </option>

            </select>
        </div>

        <!-- BOTONES -->
        <div class="d-flex justify-content-between">

            <a href="{{ route('solicitudes.index') }}"
               class="btn btn-secondary">
                ⬅ Volver
            </a>

            <button class="btn btn-primary">
                💾 Actualizar Solicitud
            </button>

        </div>

    </form>

</div>

@endsection