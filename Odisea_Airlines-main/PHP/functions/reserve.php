<?php
function reserve_flight() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $consultaSQL = 'SELECT matricula from aviones';
        

        $statement = $conexion->query($consultaSQL);

        $resultados = $statement->fetchAll();
        $rand_matricula = $resultados[rand(0,count($resultados)-1)][0];
        // echo $resultado;
        $matricula = $rand_matricula;
        $dni = $_POST["dni"];

        $destino_seleccionado = $_POST["destino"];

        $consultaSQL = "INSERT INTO vuelos";
        $consultaSQL .= ' values (null,"'.$matricula.'","'.$dni.'")';
       
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();


        // 'SELECT v.Idvuelos '.$destino_seleccionado.' FROM vuelos v ORDER BY v.Idvuelos desc LIMIT 1'
        $consultaSQL = "INSERT INTO destinos_y_vuelos";
        $consultaSQL .= ' SELECT v.Idvuelos,"'.$destino_seleccionado.'" FROM vuelos v ORDER BY v.Idvuelos desc LIMIT 1';
        
   

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