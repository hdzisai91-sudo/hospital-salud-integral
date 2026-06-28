<!DOCTYPE html>
<html>
<head>
    <title>Nueva Solicitud</title>
</head>
<body>

    <h1>➕ Nueva Solicitud</h1>

    <form action="/solicitudes" method="POST">
        @csrf

        <label>Título:</label><br>
        <input type="text" name="titulo"><br><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion"></textarea><br><br>

        <label>Área:</label><br>
        <input type="text" name="area"><br><br>

        <label>Prioridad:</label><br>
        <select name="prioridad">
            <option>Alta</option>
            <option>Media</option>
            <option>Baja</option>
        </select><br><br>

        <button type="submit">Guardar</button>

    </form>

</body>
</html>