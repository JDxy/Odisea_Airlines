<?php

/**
* Function create_plane
* This function creates a new plane in the database.
* It starts by including a config file to setup a database connection using PDO.
* Then, it fetches data from a submitted form and inserts it into two tables: "aviones" and "Estado_aviones".
* Finally, it creates a relationship between the plane and its status by inserting data into the "Estado_aviones_Y_aviones" table.
* If an error occurs, it is caught and an error message is added to the result array.
* @author [Author Name]
* @return array Result of the operation with 'error' and 'message' keys.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $matricula Plane registration number.
* @var string $años_servicio Years of service of the plane.
* @var string $ultimo_mantenimiento Last maintenance of the plane.
* @var string $cantidad_total_pasajeros Total number of passengers the plane can hold.
* @var string $cantidad_disponible_pasajeros Available number of passengers the plane can hold.
* @var string $estado Status of the plane.
* @var string $consultaSQL SQL query for inserting data into the "aviones" table.
* @var PDOStatement $sentencia Prepared statement for executing the "aviones" insert query.
*/

function create_plane() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
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

