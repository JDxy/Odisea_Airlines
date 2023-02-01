<?php
/**
* Function delete_flight
* This function deletes a flight from the database.
* It starts by including a config file to setup a database connection using PDO.
* Then, it fetches the flight ID from a submitted form and deletes the corresponding data from two tables: "destinos_y_vuelos" and "vuelos".
* If an error occurs, it is caught and an error message is added to the result array.
* @author [Author Name]
* @return array Result of the operation with 'error' and 'message' keys.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var int $cod_vuelo ID of the flight.
* @var string $consultaSQL SQL query for deleting data from the "destinos_y_vuelos" and "vuelos" tables.
* @var PDOStatement $sentencia Prepared statement for executing the delete queries.
*/

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

