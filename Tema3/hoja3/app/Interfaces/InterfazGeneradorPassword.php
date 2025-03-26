<?php

namespace MiAplicacion\Interfaces;

interface InterfazGeneradorPassword {
    public function generar(array $opciones, int $longitud): string;
}
