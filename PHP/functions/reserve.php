<?php
function reserve_flight() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $matricula = "131B";
        $dni = $_POST["dni"];

        $destino_seleccionado = $_POST["destino"];

        $consultaSQL = "INSERT INTO vuelos";
        $consultaSQL .= ' values (null,"'.$matricula.'","'.$dni.'")';
       
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();



        $consultaSQL = "INSERT INTO destinos_y_vuelos";
        $consultaSQL .= ' values (NULL,'.$destino_seleccionado.')';
        
        echo $consultaSQL;

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    if (isset($_COOKIE["usuario"])){
        reserve_flight();
        echo "Vuelo reservado";
    }else{
        echo "No estas logueado";
    }
    
}

?> 