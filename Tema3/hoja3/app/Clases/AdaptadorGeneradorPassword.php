<?php

namespace MiAplicacion\Clases;

use MiAplicacion\Interfaces\InterfazGeneradorPassword;

class AdaptadorGeneradorPassword implements InterfazGeneradorPassword {
    public function generar(array $opciones, int $longitud): string {
        return GeneradorPassword::generar($opciones, $longitud);
    }
}
