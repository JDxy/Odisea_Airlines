<?php
function delete_flight() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $cod_vuelo = $_POST["Idvuelo"];
            
        $consultaSQL = 'DELETE FROM destinos_y_vuelos WHERE IdVuelos = '.$cod_vuelo.'';

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();
        
        $consultaSQL = 'DELETE FROM vuelos WHERE IdVuelos = '.$cod_vuelo.'';

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['Idvuelo'])) {
    delete_flight();
}

?> 