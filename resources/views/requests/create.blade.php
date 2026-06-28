<!DOCTYPE html>
<html>
<head>
    <title>Nueva Solicitud</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4">

        <h3 class="mb-4">➕ Nueva Solicitud</h3>

        <form action="{{ route('solicitudes.store') }}" method="POST">
            @csrf

            <!-- TITULO -->
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <!-- AREA -->
            <div class="mb-3">
                <label>Área</label>
                <input type="text" name="area" class="form-control" required>
            </div>

            <!-- PRIORIDAD -->
            <div class="mb-3">
                <label>Prioridad</label>
                <select name="prioridad" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="Alta">Alta</option>
                    <option value="Media">Media</option>
                    <option value="Baja">Baja</option>
                </select>
            </div>

            <!-- ESTADO -->
            <div class="mb-3">
                <label>Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En Proceso">En Proceso</option>
                    <option value="Finalizada">Finalizada</option>
                </select>
            </div>

            <!-- BOTONES -->
            <button class="btn btn-success">
                Guardar
            </button>

            <a href="/solicitudes" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    </div>

</div>

</body>
</html>