<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Contraseñas</title>
</head>
<body>
    <form method="POST">
        <label>
            <input type="checkbox" name="mayusculas" value="1"> Incluir mayúsculas
        </label>
        <br>
        <label>
            <input type="checkbox" name="minusculas" value="1"> Incluir minúsculas
        </label>
        <br>
        <label>
            <input type="checkbox" name="numeros" value="1"> Incluir números
        </label>
        <br>
        <label>
            <input type="checkbox" name="simbolos" value="1"> Incluir símbolos
        </label>
        <br>
        <label>
            Longitud: <input type="number" name="longitud" min="1" value="8">
        </label>
        <br>
        <button type="submit">Generar</button>
    </form>
    <?php
    require '../vendor/autoload.php';

    use MiAplicacion\Clases\AdaptadorGeneradorPassword;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $opciones = [
            'mayusculas' => isset($_POST['mayusculas']),
            'minusculas' => isset($_POST['minusculas']),
            'numeros' => isset($_POST['numeros']),
            'simbolos' => isset($_POST['simbolos']),
        ];
        $longitud = (int)$_POST['longitud'];

        $generador = new AdaptadorGeneradorPassword();
        $password = $generador->generar($opciones, $longitud);

        echo "<p>Contraseña generada: <strong>{$password}</strong></p>";
    }
    ?>
</body>
</html>
