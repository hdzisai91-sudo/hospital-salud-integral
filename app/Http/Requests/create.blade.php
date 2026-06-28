<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Solicitud</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-lg">

                <div class="card-header bg-primary text-white text-center">
                    <h4>Nueva Solicitud de Mantenimiento</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('solicitud.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Descripción</label>
                            <textarea name="descripcion" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-success w-100">
                            Enviar Solicitud
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>