<?php
// Verificar si se ha subido una imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen']) && isset($_POST['nuevo_nombre'])) {
    $directorio = 'imagenes/';
    $nombreNuevo = $directorio . basename($_POST['nuevo_nombre']);
    $tipoArchivo = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

    // Asegurar que el nuevo nombre incluye la extensión correcta
    $nombreNuevo .= '.' . $tipoArchivo;

    // Verificar el tipo de archivo (solo imágenes permitidas)
    if (in_array($tipoArchivo, ['jpg', 'jpeg', 'png', 'gif'])) {
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreNuevo)) {
            echo 'La imagen se ha subido correctamente.';
        } else {
            echo 'Hubo un problema al subir la imagen.';
        }
    } else {
        echo 'Solo se permiten archivos de imagen (jpg, jpeg, png, gif).';
    }
}

// Obtener las imágenes almacenadas
$imagenes = array_diff(scandir('imagenes'), ['.', '..']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir y mostrar imágenes</title>
</head>
<body>
    <h1>Formulario para subir imágenes</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="imagen">Selecciona una imagen:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" required>
        <br/>
        <label for="nuevo_nombre">Nuevo nombre (sin extensión):</label>
        <input type="text" name="nuevo_nombre" id="nuevo_nombre" placeholder="Nombre obligatorio" required>
        <br/>
        <button type="submit">Subir imagen</button>
    </form>

    <hr>

    <?php if (!empty($imagenes)): ?>
        <h2>Carrusel de imágenes</h2>
        <div style="display: flex; overflow-x: auto; gap: 10px;">
            <?php foreach ($imagenes as $imagen): ?>
                <img src="imagenes/<?php echo htmlspecialchars($imagen); ?>" alt="Imagen almacenada" style="max-width: 300px; max-height: 300px;">
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
