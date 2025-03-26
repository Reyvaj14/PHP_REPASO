<?php
namespace App\Clases;

use App\Interfaces\InterfazProveedorCorreo;

class ServicioCorreo {
    private InterfazProveedorCorreo $proveedorCorreo;

    public function __construct(InterfazProveedorCorreo $proveedorCorreo) {
        $this->proveedorCorreo = $proveedorCorreo;
    }

    public function enviarCorreo(string $paraQuien, string $asunto, string $cuerpoMensaje): bool {
        return $this->proveedorCorreo->enviarCorreo($paraQuien, $asunto, $cuerpoMensaje);
    }
}
