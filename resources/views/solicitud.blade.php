<!DOCTYPE html>
<html>
<head>
    <title>Hospital - Solicitud</title>
</head>
<body>

    <h1>🏥 Solicitud de Mantenimiento</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('solicitud.store') }}">
        @csrf

        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion" required></textarea><br><br>

        <button type="submit">Enviar</button>

    </form>

</body>
</html>