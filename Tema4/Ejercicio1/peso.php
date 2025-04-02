<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio Peso NBA</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <header>
        <nav>
            <a href="index.php">Jugadores</a> |
            <a href="traspaso.php">Traspaso</a> |
            <a href="peso.php">Peso</a>
        </nav>
    </header>

    <main>
        

        <?php
            require_once 'funcionesBD.php';
            $equipos=getEquipos();
            if(isset($_POST["actualizar"])){
                foreach(getJugadores($_POST["equipo"]) as $jugadores){
                    $code=$jugadores[2];
                    $peso=$_POST["codigo".$code];
                    actulizarPesoJugadores($code, $peso);
                }
                echo "<div class='aviso'> Actualizados los pesos </div>";
            }
        ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="formulario">
            <ul>
                <li>
                    <h1>Cambio Peso NBA</h1>
                </li>
                <li>
                    <label for="equipo">Equipo:</label>
                        <select name="equipo" required>
                            <?php
                            foreach($equipos as $equipo){
                                echo "<option value='$equipo'";
                                if(isset($_POST["mostrar"]) && $equipo==$_POST["equipo"]){
                                    echo "selected='true'";
                                }
                                echo ">$equipo</option>";

                            }
                            ?>
                        </select>
                </li>
                <li>
                    <label for="mostrar"> </label>
                    <button class="submit" type="submit" name="mostrar">Mostrar</button>
                </li>
            </ul>
        </form>
        <?php
            if(isset($_POST["mostrar"])){
                $nombre = $_POST["equipo"];
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="formulario">
        <input type="hidden" name="equipo" value="<?php echo $_POST["equipo"] ?>">
        <table class=tabla>
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Peso</th>
            </tr>
            </thead>
            <tbody>
            <?php        
                foreach(getJugadores($nombre) as $jugadores){
                    echo "<tr>";
                    echo "<td>".$jugadores[0]."</td>";
                    echo "<td><input type='text'  name='codigo$jugadores[2]' value='$jugadores[1]'></td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
            <label for="actualizar"> </label>
            <button class="submit" type="submit" name="actualizar">Actualizar</button>
        </from>
        <?php        
            }
        ?>
    </main>

</body>
</html>