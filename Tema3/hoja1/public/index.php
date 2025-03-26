<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Brick\Math\BigInteger;

class ValidadorIBAN {
    private const CODIGO_PAIS = 'ES';
    private const NUMERICO_PAIS = '1428'; // E = 14, S = 28
    
    public static function validarIBAN(string $iban): bool {
        // Verificar longitud
        if (strlen($iban) !== 24 || substr($iban, 0, 2) !== self::CODIGO_PAIS) {
            return false;
        }
        
        // Extraer dígitos de control y CCC
        $digitosControl = substr($iban, 2, 2);
        $ccc = substr($iban, 4);
        
        // Verificar CCC
        if (!self::validarCCC($ccc)) {
            return false;
        }
        
        // Convertir IBAN para validación
        $reordenado = $ccc . self::NUMERICO_PAIS . $digitosControl;
        $numero = BigInteger::of($reordenado);
        
        return $numero->mod(97)->toInt() === 1;
    }
    
    private static function validarCCC(string $ccc): bool {
        if (strlen($ccc) !== 20) {
            return false;
        }
        
        $entidad = substr($ccc, 0, 4);
        $oficina = substr($ccc, 4, 4);
        $digitosControl = substr($ccc, 8, 2);
        $cuenta = substr($ccc, 10);
        
        $primerDigitoCalculado = self::calcularDigitoControl("00{$entidad}{$oficina}");
        $segundoDigitoCalculado = self::calcularDigitoControl($cuenta);
        
        return $digitosControl === $primerDigitoCalculado . $segundoDigitoCalculado;
    }
    
    private static function calcularDigitoControl(string $numero): string {
        $pesos = [1, 2, 4, 8, 5, 10, 9, 7, 3, 6];
        $suma = 0;
        
        for ($i = 0; $i < 10; $i++) {
            $suma += (int)$numero[$i] * $pesos[$i];
        }
        
        $control = 11 - ($suma % 11);
        return $control === 11 ? '0' : ($control === 10 ? '1' : (string)$control);
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de IBAN</title>
</head>
<body>
    <h2>Formulario de Validación de IBAN</h2>
    <form method="post">
        <label for="iban">Introduce el IBAN:</label>
        <input type="text" id="iban" name="iban" required>
        <button type="submit">Validar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $iban = $_POST['iban'] ?? '';
        if (ValidadorIBAN::validarIBAN($iban)) {
            echo "<p style='color:green;'>IBAN válido</p>";
        } else {
            echo "<p style='color:red;'>IBAN inválido</p>";
        }
    }
    ?>
</body>
</html>