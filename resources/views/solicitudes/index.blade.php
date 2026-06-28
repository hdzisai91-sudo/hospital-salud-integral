@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <!-- ENCABEZADO -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>📋 Solicitudes</h2>

        <a href="/solicitudes/create" class="btn btn-success">
            + Nueva Solicitud
        </a>

    </div>

    <!-- BUSCADOR -->
    <form method="GET" class="mb-3">

        <div class="input-group">

            <input type="text"
                   name="buscar"
                   class="form-control"
                   placeholder="Buscar por título o área..."
                   value="{{ request('buscar') }}">

            <button class="btn btn-primary">
                🔍 Buscar
            </button>

        </div>

    </form>

    <!-- MENSAJE DE ÉXITO -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLA -->
    <div class="card shadow border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-striped align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Área</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($solicitudes as $s)

                        <tr>
                            <td>{{ $s->id }}</td>

                            <td class="fw-semibold">
                                {{ $s->titulo }}
                            </td>

                            <td>
                                {{ $s->area }}
                            </td>

                            <!-- PRIORIDAD -->
                            <td>
                                @if($s->prioridad == 'Alta')
                                    <span class="badge bg-danger">Alta</span>
                                @elseif($s->prioridad == 'Media')
                                    <span class="badge bg-warning text-dark">Media</span>
                                @else
                                    <span class="badge bg-secondary">Baja</span>
                                @endif
                            </td>

                            <!-- ESTADO -->
                            <td>
                                @if($s->estado == 'Pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($s->estado == 'En Proceso')
                                    <span class="badge bg-info">En Proceso</span>
                                @else
                                    <span class="badge bg-success">Finalizada</span>
                                @endif
                            </td>

                            <td>
                                {{ $s->created_at->format('d/m/Y') }}
                            </td>

                            <!-- ACCIONES -->
                            <td class="d-flex gap-1">

                                <a href="/solicitudes/{{ $s->id }}"
                                   class="btn btn-sm btn-outline-secondary">
                                    Ver
                                </a>

                                <a href="/solicitudes/{{ $s->id }}/edit"
                                   class="btn btn-sm btn-outline-warning">
                                    Editar
                                </a>

                                <form action="/solicitudes/{{ $s->id }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar esta solicitud?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        Eliminar
                                    </button>

                                </form>

                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                No hay solicitudes registradas
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- PAGINACIÓN -->
    <div class="mt-3">
        {{ $solicitudes->appends(request()->all())->links() }}
    </div>

</div>

@endsection