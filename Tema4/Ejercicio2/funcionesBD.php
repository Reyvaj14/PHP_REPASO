<?php 
require_once 'conexionBD.php';

function getlibros(){
    $pdo= getConexion();
    $consulta= "select numero_ejemplar, titulo, anyo_edicion, precio , fecha_adquisicion from libros";
    if($resultado= $pdo->query($consulta)){
        while($libro = $resultado->fetch(PDO::FETCH_OBJ))
        {
            $libros[]=array($libro->numero_ejemplar, $libro->titulo, $libro->anyo_edicion, $libro->precio, $libro->fecha_adquisicion );
        }
        unset($resultado);
    }
    unset($pdo);
    return $libros;
}

function  añadirLibro($titulo, $anyo_edicion, $precio, $fecha_adquisicion){
    $correcto= false;

    $pdo= getConexion();
    $pdo->beginTransaction();

    $sqlInsertar= "insert into libros(titulo, anyo_edicion, precio, fecha_adquisicion) values (?,?,?,?)";
   
    $sentenciaInsertar=$pdo->prepare($sqlInsertar);
    $sentenciaInsertar->bindParam(1,$titulo);
    $sentenciaInsertar->bindParam(2,$anyo_edicion);
    $sentenciaInsertar->bindParam(3,$precio);
    $sentenciaInsertar->bindParam(4,$fecha_adquisicion);

    $elementosInsertados= $sentenciaInsertar->execute();
    unset($sentenciaInsertar);
    if($elementosInsertados==1){
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