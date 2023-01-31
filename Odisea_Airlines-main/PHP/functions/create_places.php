<?php
function create_places() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $fecha_llegada = $_POST["fecha_llegada"];
        $fecha_salida = $_POST["fecha_salida"];
        $precio = $_POST["precio"];

        $consultaSQL = "INSERT INTO destinos";
        $consultaSQL .= ' values (null,"'.$origen.'", "'.$destino.'","'.$fecha_llegada.'","'.$fecha_salida.'",'.$precio.')';
        echo $consultaSQL;
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

    
        

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    create_places();
}

?> 