<!DOCTYPE html>
<html>
<head>
    <title>Solicitudes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .container-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .badge {
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="container mt-4 container-box">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📋 Solicitudes</h3>

        <a href="/solicitudes/create" class="btn btn-success">
            + Nueva Solicitud
        </a>
    </div>

    <!-- BUSCADOR + FILTRO -->
    <form method="GET" class="row mb-3">

        <div class="col-md-6">
            <input type="text" name="buscar" class="form-control"
                   placeholder="Buscar por título..."
                   value="{{ request('buscar') }}">
        </div>

        <div class="col-md-4">
            <select name="estado" class="form-select">
                <option value="">Todos los estados</option>
                <option value="Pendiente">Pendiente</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Finalizada">Finalizada</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                Filtrar
            </button>
        </div>

    </form>

    <!-- TABLA -->
    <table class="table table-hover">

        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Área</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse($solicitudes as $solicitud)

                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->titulo }}</td>
                    <td>{{ $solicitud->area }}</td>
                    <td>{{ $solicitud->prioridad }}</td>

                    <td>
                        @if($solicitud->estado == 'Pendiente')
                            <span class="badge bg-warning">Pendiente</span>
                        @elseif($solicitud->estado == 'En Proceso')
                            <span class="badge bg-primary">En Proceso</span>
                        @else
                            <span class="badge bg-success">Finalizada</span>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('solicitudes.edit', $solicitud->id) }}"
                           class="btn btn-sm btn-primary">
                            Editar
                        </a>

                        <form action="{{ route('solicitudes.destroy', $solicitud->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar esta solicitud?')">
                                Eliminar
                            </button>

                        </form>

                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No hay solicitudes registradas
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</div>

</body>
</html>