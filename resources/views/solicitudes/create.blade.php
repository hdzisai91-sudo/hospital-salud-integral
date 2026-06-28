@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">➕ Nueva Solicitud</h2>

    <form action="{{ route('solicitudes.store') }}" method="POST">
        @csrf

        <!-- TÍTULO -->
        <div class="mb-3">
            <label>Título</label>
            <input type="text"
                   name="titulo"
                   class="form-control @error('titulo') is-invalid @enderror"
                   value="{{ old('titulo') }}">

            @error('titulo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- ÁREA -->
        <div class="mb-3">
            <label>Área</label>
            <input type="text"
                   name="area"
                   class="form-control @error('area') is-invalid @enderror"
                   value="{{ old('area') }}">

            @error('area')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- PRIORIDAD -->
        <div class="mb-3">
            <label>Prioridad</label>
            <select name="prioridad"
                    class="form-control @error('prioridad') is-invalid @enderror">

                <option value="">Seleccione</option>
                <option value="Alta" {{ old('prioridad') == 'Alta' ? 'selected' : '' }}>Alta</option>
                <option value="Media" {{ old('prioridad') == 'Media' ? 'selected' : '' }}>Media</option>
                <option value="Baja" {{ old('prioridad') == 'Baja' ? 'selected' : '' }}>Baja</option>

            </select>

            @error('prioridad')
                <div class="text-danger small">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- ESTADO -->
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado"
                    class="form-control @error('estado') is-invalid @enderror">

                <option value="">Seleccione</option>
                <option value="Pendiente" {{ old('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="En Proceso" {{ old('estado') == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="Finalizada" {{ old('estado') == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>

            </select>

            @error('estado')
                <div class="text-danger small">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- BOTÓN -->
        <button class="btn btn-success">
            Guardar Solicitud
        </button>

    </form>

</div>

@endsection