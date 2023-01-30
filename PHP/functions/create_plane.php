<?php

function create_plane() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../../config.php";
    try {
   
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        
        $matricula = $_POST["matricula"];
        $años_servicio = $_POST["años_servicio"];
        $ultimo_mantenimiento = $_POST["ultimo_mantenimiento"];
        $cantidad_total_pasajeros = $_POST["cantidad_total_pasajeros"];
        $cantidad_disponible_pasajeros = $_POST["cantidad_disponible_pasajeros"];
        $estado = $_POST["estado"];
        
        $consultaSQL = "INSERT INTO aviones";
        $consultaSQL .= ' values ("'.$matricula.'",'.$años_servicio.',"'.$ultimo_mantenimiento.'",'.$cantidad_total_pasajeros.','.$cantidad_disponible_pasajeros.')';


        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();


        $consultaSQL = 'INSERT INTO estado_aviones VALUES (NULL,'.$estado.')';
 
        $conexion->query($consultaSQL);

        

        $consultaSQL = 'INSERT INTO Estado_aviones_Y_aviones SELECT E.cod_estado_avion,"'.$matricula.'" FROM estado_aviones E ORDER BY cod_estado_avion desc LIMIT 1';

        // SELECT E.cod_estado_avion,"131B" FROM estado_aviones E ORDER BY cod_estado_avion desc LIMIT 1;
        $conexion->query($consultaSQL);

        // echo $consultaSQL;
        

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    
    create_plane();

}

?>