<?php
function del_plane(){

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];
    
    $config = include "../../../config.php";
    try {

        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $matricula = $_POST["matricula"];

        $sql = 'SELECT cod_estado_avion FROM estado_aviones_y_aviones WHERE matricula_avion = "'.$matricula.'"';
        
        $statement = $conexion->query($sql);
        
        $resultados = $statement->fetchAll();

        foreach($resultados as $fila) {
            $cod_avion = $fila["cod_estado_avion"];
        }


        $consultaSQL = 'DELETE FROM estado_aviones_y_aviones where matricula_avion = "'.$matricula.'"';
        $conexion->query($consultaSQL);


        $sql = 'SELECT idVuelos from vuelos where matricula_avion = "'.$matricula.'"';
    
        $statement = $conexion->query($sql);
        
        $resultados = $statement->fetchAll();

        foreach($resultados as $fila) {
            $cod_vuelos = $fila["idVuelos"];
        }

        $consultaSQL = 'DELETE FROM destinos_y_vuelos where idVuelos = '.$cod_vuelos.'';
        $conexion->query($consultaSQL);

        $consultaSQL = 'DELETE FROM vuelos where matricula_avion = "'.$matricula.'"';
        $conexion->query($consultaSQL);


        $consultaSQL = 'DELETE FROM estado_aviones where cod_estado_avion = '.$cod_avion.'';
        $conexion->query($consultaSQL);

        $consultaSQL = 'DELETE FROM aviones where matricula = "'.$matricula.'"';

        $conexion->query($consultaSQL);


    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}

if (isset($_POST['submit'])) {
    del_plane();
}

?>
