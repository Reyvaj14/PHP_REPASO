<?php

namespace App\Clases;

use App\Interfaces\InterfazGeneradorPassword;

class AdaptadorGeneradorPassword implements InterfazGeneradorPassword {
    public function generar(): string {
        return GeneradorPassword::generar();
    }
}