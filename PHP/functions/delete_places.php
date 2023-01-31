<?php
function delete_places() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $cod_destino = $_POST["cod_destino"];
            
        $consultaSQL = 'DELETE FROM destinos_y_vuelos WHERE cod_destino = '.$cod_destino.'';

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();
        
        $consultaSQL = 'DELETE FROM destinos WHERE cod_destino = '.$cod_destino.'';

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

    
        

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    delete_places();
}

?> 