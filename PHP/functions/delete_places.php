<?php
/**

* Function delete_places
* This function deletes a place in the database.
* It starts by including a config file to setup a database connection using PDO.
* Then, it fetches the 'cod_destino' data from the submitted form.
* It deletes the corresponding entries in two tables: "destinos_y_vuelos" and "destinos".
* Finally, if an error occurs, it is caught and added to the result array with an error message.
* @author [Author Name]
* @return array Result of the operation with 'error' and 'message' keys.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $cod_destino Code of the destination to delete.
* @var string $consultaSQL SQL query for deleting data from the "destinos_y_vuelos" table.
* @var PDOStatement $sentencia Prepared statement for executing the "destinos_y_vuelos" delete query.
* @var string $consultaSQL SQL query for deleting data from the "destinos" table.
* @var PDOStatement $sentencia Prepared statement for executing the "destinos" delete query.
*/

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

