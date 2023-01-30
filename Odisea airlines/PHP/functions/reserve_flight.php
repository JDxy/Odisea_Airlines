<?php
function create_fligths() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        
        $dni = $_POST["dni"];
        $avion = $_POST["matricula"];
        $precio = $_POST["precio"];

        $consultaSQL = "INSERT INTO vuelos (cod_vuelo,matricula,dni, precio)";
        $consultaSQL .= 'values (null,'.$dni.', '.$avion.','.$precio.')';

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

        

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    create_fligths();
}

?> 