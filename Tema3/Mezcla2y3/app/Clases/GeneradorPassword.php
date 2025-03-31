<?php

namespace App\Clases;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

class GeneradorPassword {
    public static function generar(): string {
        $generator = new ComputerPasswordGenerator();

        $generator->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, true)
                  ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, true)
                  ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, true)
                  ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, true);

        $generator->setLength(16);

        return $generator->generatePassword();
    }
}