<?php
/**
* Function del_plane
* This function deletes an existing plane from the database.
* It starts by including a config file to setup a database connection using PDO.
* Then, it retrieves the "cod_estado_avion" from the "estado_aviones_y_aviones" table using the submitted "matricula".
* Next, it deletes the relationship between the plane and its state by deleting the corresponding record from the "estado_aviones_y_aviones" table.
* After that, it retrieves the flight ID from the "vuelos" table using the "matricula".
* Then, it deletes the relationship between the flight and its destinations by deleting the corresponding record from the "destinos_y_vuelos" table.
* Finally, it deletes the flight, the state, and the plane by deleting the corresponding records from the "vuelos", "estado_aviones", and "aviones" tables respectively.
* If an error occurs, it is caught and an error message is added to the result array.
* @author [Author Name]
* @return void
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $matricula Matriculation number of the plane.
* @var string $sql SQL query for fetching the "cod_estado_avion".
* @var PDOStatement $statement Prepared statement for executing the query to fetch the "cod_estado_avion".
* @var array $resultados Result of the query to fetch the "cod_estado_avion".
* @var int $cod_avion Code of the state of the plane.
* @var string $consultaSQL SQL query for deleting a record from the "estado_aviones_y_aviones" table.
* @var int $cod_vuelos ID of the flight.
* @var string $sql SQL query for fetching the flight ID.
* @var PDOStatement $statement Prepared statement for executing the query to fetch the flight ID.
* @var array $resultados Result of the query to fetch the flight ID.
* @var string $consultaSQL SQL query for deleting a record from the "destinos_y_vuelos" table.
* @var string $consultaSQL SQL query for deleting a record from the "vuelos" table.
* @var string $consultaSQL SQL query for deleting a record from the "estado_aviones" table.
* @var string $consultaSQL SQL query for deleting a record from the "aviones" table.
*/
function del_plane(){

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];
    
    $config = include "../../config.php";
    try {

        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $matricula = $_POST["matricula"];

        $sql = 'SELECT cod_estado_avion FROM estado_aviones_y_aviones WHERE matricula_avion = "'.$matricula.'"';
        
        $statement = $conexion->query($sql);
        
        $resultados = $statement->fetchAll();

        foreach($resultados as $fila) {
            $cod_avion = $fila["cod_estado_avion"];
        }


        $consultaSQL = 'DELETE FROM estado_aviones_y_aviones where matricula_avion = "'.$matricula.'"';
        $conexion->query($consultaSQL);


        $sql = 'SELECT idVuelos from vuelos where matricula_avion = "'.$matricula.'"';
    
        $statement = $conexion->query($sql);
        
        $resultados = $statement->fetchAll();

        foreach($resultados as $fila) {
            $cod_vuelos = $fila["idVuelos"];
        }

        $consultaSQL = 'DELETE FROM destinos_y_vuelos where idVuelos = '.$cod_vuelos.'';
        $conexion->query($consultaSQL);

        $consultaSQL = 'DELETE FROM vuelos where matricula_avion = "'.$matricula.'"';
        $conexion->query($consultaSQL);


        $consultaSQL = 'DELETE FROM estado_aviones where cod_estado_avion = '.$cod_avion.'';
        $conexion->query($consultaSQL);

        $consultaSQL = 'DELETE FROM aviones where matricula = "'.$matricula.'"';

        $conexion->query($consultaSQL);


    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}

if (isset($_POST['submit'])) {
    del_plane();
}

?>

