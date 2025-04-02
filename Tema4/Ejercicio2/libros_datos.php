<!DOCTYPE html>
<html> 
<head> 
    <title>Datos Libros</title> 
    <link rel="stylesheet" href="estilo.css">
</head> 
<body>
    <?php
        require_once 'funcionesBD.php';
    ?>
    <table class=tabla>
        <thead>
        <tr>
            <th>Numero de ejemplar</th>
            <th>Título</th>
            <th>Año de Edición</th>
            <th>Precio</th>
            <th>Fecha de adquisicion</th>
        </tr>
        </thead>
        <tbody>
        <?php        
            
            foreach(getLibros() as $libros){
                echo "<tr>";
                echo "<td>".$libros[0]."</td>";
                echo "<td>".$libros[1]."</td>";
                echo "<td>".$libros[2]."</td>";
                echo "<td>".$libros[3]."</td>";
                echo "<td>".$libros[4]."</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
     <a href="libros.html">Volver</a>
</body> 
</html>