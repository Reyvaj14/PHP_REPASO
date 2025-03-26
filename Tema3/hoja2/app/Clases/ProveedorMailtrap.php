<?php
namespace App\Clases;

use App\Interfaces\InterfazProveedorCorreo;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ProveedorMailtrap implements InterfazProveedorCorreo {
    public function enviarCorreo(string $paraQuien, string $asunto, string $cuerpoMensaje): bool {
        $mail = new PHPMailer(true);


        // Configuración del servidor
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                // Habilita la salida de depuración detallada
        $mail->isSMTP();                                      // Establece el tipo de correo electrónico para usar SMTP
        $mail->Host = 'sandbox.smtp.mailtrap.io';                     // Especifica los servidores SMTP principales y de respaldo
        $mail->SMTPAuth = true;                               // Habilita la autenticación SMTP
        $mail->Username = 'a364bf8c3cb27d';                   // Nombre de usuario SMTP
        $mail->Password = '689f12ef74c19e';                   // Contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Habilita el cifrado TLS; `ssl` también aceptado
        $mail->Port = 587;                                    // Puerto TCP para conectarse

        try {
            $mail->setFrom('noreply@tuweb.com', 'Tu Web');
            $mail->addAddress($paraQuien);
            $mail->Subject = $asunto;
            $mail->Body = $cuerpoMensaje;

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
