<?php
/**
* Function create_places
* This function creates a new place in the database.
* It starts by including a config file to setup a database connection using PDO.
* Then, it fetches data from a submitted form and inserts it into the "destinos" table.
* If an error occurs, it is caught and an error message is added to the result array.
* @author [Author Name]
* @return array Result of the operation with 'error' and 'message' keys.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $origen Origin of the place.
* @var string $destino Destination of the place.
* @var string $fecha_llegada Arrival date of the place.
* @var string $fecha_salida Departure date of the place.
* @var string $precio Price of the place.
* @var string $consultaSQL SQL query for inserting data into the "destinos" table.
* @var PDOStatement $sentencia Prepared statement for executing the "destinos" insert query.
*/
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
