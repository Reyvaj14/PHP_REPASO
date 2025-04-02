<?php 
require_once 'conexionBD.php';

function getEquipos(){
    $pdo= getConexion();
    $consulta= "select nombre from equipos";
    if($resultado= $pdo->query($consulta)){
        while($equipo = $resultado->fetch(PDO::FETCH_OBJ))
        {
            $equipos[]=$equipo->nombre;
        }
        unset($resultado);
    }
    unset($pdo);
    return $equipos;
}

function getJugadores($nombre){
    $pdo= getConexion();
    $consulta= "select nombre, peso, codigo from jugadores where nombre_equipo='$nombre'";
    if($resultado= $pdo->query($consulta)){
        while($jugador = $resultado->fetch(PDO::FETCH_OBJ))
        {
            $jugadores[]=array($jugador->nombre, $jugador->peso, $jugador->codigo);
        }
        unset($resultado);
    }
    unset($pdo);
    return $jugadores;
}

function getPosiciones(){
    $pdo= getConexion();
    $consulta= "select distinct posicion from jugadores ";
    if($resultado= $pdo->query($consulta)){
        while($posicion = $resultado->fetch(PDO::FETCH_OBJ))
        {
            $posiciones[]=$posicion->posicion;
        }
        unset($resultado);
    }
    unset($pdo);
    return $posiciones;
}

function getUltimoCodigoJugador(){
    $pdo= getConexion();
    $consulta= "select max(codigo) as codigo from jugadores ";
    if($resultado= $pdo->query($consulta)){
        while($jugador = $resultado->fetch(PDO::FETCH_OBJ))
        {
            $codigo[]=$jugador->codigo;
        }
        unset($resultado);
    }
    unset($pdo);
    return $codigo[0];
}
function getCodigoJugador($nombre){
    $pdo= getConexion();
    $consulta= "select codigo from jugadores where nombre='$nombre'";
    if($resultado= $pdo->query($consulta)){
        while($jugador = $resultado->fetch(PDO::FETCH_OBJ))
        {
            $codigo2[]=$jugador->codigo;
        }
        unset($resultado);
    }
    unset($pdo);
    return $codigo2[0];
}
function borrarInsertarJugador ($codigoJugadorBorrar, $nombre, $procedencia, $altura, $peso, $posicion, $equipo){
    $codigoNuevo = getUltimoCodigoJugador() + 1;
    $correcto= false;

    $pdo= getConexion();
    $pdo->beginTransaction();

    $sqlBorrarEstadisticas = "delete from estadisticas where jugador = ?";
    $sqlBorrarJugadores= "delete from jugadores where codigo= ?";
    $sqlInsertar= "insert into jugadores values (?,?,?,?,?,?,?)";

    $sentenciaBorrar=$pdo->prepare($sqlBorrarEstadisticas);
    $sentenciaBorrar->bindParam(1, $codigoJugadorBorrar);
    $sentenciaBorrar->execute();
    unset($sentenciaBorrar);

    $sentenciaBorrar= $pdo->prepare($sqlBorrarJugadores);
    $sentenciaBorrar->bindParam(1,$codigoJugadorBorrar);
    $elementosBorrados = $sentenciaBorrar->execute();
    unset($sentenciaBorrar);

    $sentenciaInsertar=$pdo->prepare($sqlInsertar);
    $sentenciaInsertar->bindParam(1,$codigoNuevo);
    $sentenciaInsertar->bindParam(2,$nombre);
    $sentenciaInsertar->bindParam(3,$procedencia);
    $sentenciaInsertar->bindParam(4,$altura);
    $sentenciaInsertar->bindParam(5,$peso);
    $sentenciaInsertar->bindParam(6,$posicion);
    $sentenciaInsertar->bindParam(7,$equipo);

    $elementosInsertados= $sentenciaInsertar->execute();
    unset($sentenciaInsertar);
    if($elementosBorrados == 1 && $elementosInsertados==1){
        $pdo->commit();
        $correcto=true;
    }
    else{
        $pdo->rollback();
    }
    unset($pdo);
    return $correcto;
}

function  actulizarPesoJugadores($codigoJugador, $peso){
    $correcto= false;

    $pdo= getConexion();
    $pdo->beginTransaction();

    $sqlcambiarpeso= "UPDATE Jugadores SET peso = ? WHERE codigo = ? ;";
   
    $sentenciaCambio=$pdo->prepare($sqlcambiarpeso);
    $sentenciaCambio->bindParam(1,$peso);
    $sentenciaCambio->bindParam(2,$codigoJugador);

    $elementoscambiados= $sentenciaCambio->execute();
    unset($sentenciaInsertar);
    if($elementoscambiados==1){
        $pdo->commit();
        $correcto=true;
    }
    else{
        $pdo->rollback();
    }
    unset($pdo);
    return $correcto;
}
?>