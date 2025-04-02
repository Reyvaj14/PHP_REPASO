<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traspaso NBA</title>
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
            if(isset($_POST["traspaso"])){
                borrarInsertarJugador (getCodigoJugador($_POST["baja"]), $_POST["nombre"], $_POST["procedencia"], $_POST["altura"], $_POST["peso"], $_POST["posicion"], $_POST["equipo"]);
                echo "<div class='aviso'> ".$_POST["baja"]." ha sido eliminado y ".$_POST["nombre"]." ha sido añadido </div>";
            }
        ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="formulario">
            <ul>
                <li>
                    <h1>Traspaso NBA</h1>
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
            <ul>
                <li>
                    <h2>Baja y alta de jugadores</h2>
                </li>
                <li>
                    <label for="baja">Baja de jugador:</label>
                        <select name="baja" required>
                            <?php
                            foreach(getJugadores($nombre) as $jugador){
                                echo "<option value='$jugador[0]'>$jugador[0]</option>";

                            }
                            ?>
                        </select>
                </li>
                <li>
                    <h1>Datos del nuevo jugador</h1>
                </li>
                <li>
                    <label from="nombre">Nombre:</label>
                    <input type="text" name="nombre" required>
                </li>
                <li>
                    <label from="procedencia">Procedencia:</label>
                    <input type="text" name="procedencia" required>
                </li>
                <li>
                    <label from="altura">Altura:</label>
                    <input type="text" name="altura" required>
                </li>
                <li>
                    <label from="peso">Peso:</label>
                    <input type="text" name="peso" required>
                </li>
                <li>
                    <label from="posicion">Posicion:</label>
                    <select name="posicion" required>
                            <?php
                            foreach(getPosiciones() as $posicion){
                                echo "<option value='$posicion'>$posicion</option>";

                            }
                            ?>
                        </select>
                </li>
                <li>
                    <label for="traspaso"> </label>
                    <button class="submit" type="submit" name="traspaso">Realizar traspaso</button>
                </li>
            </ul>
        </form>
        <?php        
            }
        ?>
    </main>

</body>
</html>
