<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
</head>
<body>
    <h2>Contacto</h2>
    <?php
        if (isset($_GET['error'])) {
            $errores = [
                1 => "Por favor, rellena todos los campos.",
                2 => "Por favor, introduce un email válido.",
                3 => "Ha ocurrido un error al enviar el email."
            ];
            echo "<p style='color:red;'>{$errores[$_GET['error']]}</p>";
        }
        if (isset($_GET['success'])) {
            echo "<p style='color:green;'>El email se ha enviado correctamente.</p>";
        }
    ?>
    <form action="procesar.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="correo">Correo electrónico:</label>
        <input type="text" name="correo" id="correo" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>