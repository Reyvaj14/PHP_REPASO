<!DOCTYPE html>
<html> 
<head> 
    <title>Libros</title> 
    <link rel="stylesheet" href="estilo.css">
</head> 
<body>
    <?php
        require_once 'funcionesBD.php';
        if(isset($_POST["añadir"])){
            if( añadirLibro($_POST["titulo"], $_POST["año"], $_POST["precio"], $_POST["fecha"])){
                echo "<div class='aviso'> Datos guardados correctamente </div>";
            }
            else{
                echo "<div class='aviso'> Error al guardar los datos </div>";
            }
        }
    ?>
     <a href="libros.html">Volver</a>
</body> 
</html>