<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Clases\ServicioCorreo;
use App\Clases\ProveedorMailtrap;
use App\Clases\AdaptadorGeneradorPassword;

$generador = new AdaptadorGeneradorPassword();
$password = $generador->generar();

$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$mensaje = 'Estimado ' . $nombre . ', la contraseña para su nueva cuenta es: ' . $password;

if (empty($nombre) || empty($correo) || empty($mensaje)) {
    header('Location: index.php?error=1');
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?error=2');
    exit;
}

$proveedorCorreo = new ProveedorMailtrap();
$servicioCorreo = new ServicioCorreo($proveedorCorreo);

if ($servicioCorreo->enviarCorreo($correo, "Nueva cuenta de $nombre", $mensaje)) {
    header('Location: index.php?success=1');
} else {
    header('Location: index.php?error=3');
}
exit;