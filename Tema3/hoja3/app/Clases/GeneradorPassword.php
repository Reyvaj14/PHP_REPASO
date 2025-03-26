<?php

namespace MiAplicacion\Clases;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

class GeneradorPassword {
    public static function generar(array $opciones, int $longitud): string {
        $generator = new ComputerPasswordGenerator();

        $generator->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, $opciones['mayusculas'])
                  ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, $opciones['minusculas'])
                  ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, $opciones['numeros'])
                  ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, $opciones['simbolos']);

        $generator->setLength($longitud);

        return $generator->generatePassword();
    }
}