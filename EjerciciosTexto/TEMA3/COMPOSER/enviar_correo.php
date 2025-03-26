<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Crea una nueva instancia de PHPMailer, con true decimos que queremos generar excepciones si ocurren
$mail = new PHPMailer(true);

// Configuración del servidor
$mail->SMTPDebug = SMTP::DEBUG_SERVER;                // Habilita la salida de depuración detallada
$mail->isSMTP();                                      // Establece el tipo de correo electrónico para usar SMTP
$mail->Host = 'smtp.mailtrap.io';                     // Especifica los servidores SMTP principales y de respaldo
$mail->SMTPAuth = true;                               // Habilita la autenticación SMTP
$mail->Username = '2646e553ed4f3d';                   // Nombre de usuario SMTP
$mail->Password = 'a90c2e63db19ee';                   // Contraseña SMTP
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Habilita el cifrado TLS; `ssl` también aceptado
$mail->Port = 587;                                    // Puerto TCP para conectarse

try {
    // Configura y envía el mensaje
    $mail->setFrom('your@email.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');
    $mail->Subject = 'Asunto del correo';
    $mail->Body = 'Cuerpo del mensaje';
    $mail->send();
} catch (Exception $e) {
    echo 'El mensaje no pudo ser enviado.';
    echo 'Error de correo: ' . $mail->ErrorInfo;
}
