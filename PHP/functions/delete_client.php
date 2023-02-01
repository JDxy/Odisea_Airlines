<?php
/**
* Function del_cliente
* This function deletes an existing client from the database.
* It starts by including a config file to setup a database connection using PDO.
* It fetches the client's DNI from the submitted form and uses it to retrieve the client's data from different tables: "Datos_Clientes_Y_Clientes", "vuelos", "clientes", "destinos_y_vuelos" and "Datos_clientes".
* Then, it deletes the data from these tables.
* If an error occurs, it is caught and an error message is added to the result array.
* @author [Author Name]
* @return array Result of the operation with 'error' and 'message' keys.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $sql SQL query for selecting data from "Datos_Clientes_Y_Clientes" table.
* @var PDOStatement $statement Prepared statement for executing the "Datos_Clientes_Y_Clientes" select query.
* @var array $resultados Result of the "Datos_Clientes_Y_Clientes" select query.
* @var string $cod_datos Client's "cod_datos_cliente" value.
* @var string $cod_vuelos Client's "idVuelos" value.
* @var string $consultaSQL SQL query for deleting data from different tables.
*/

function del_cliente(){

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];
    
    $config = include "../../config.php";
    try {

        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        $sql = 'SELECT cod_datos_cliente FROM Datos_Clientes_Y_Clientes WHERE dni_cliente = "'.$_POST["dni"].'"';
        

        $statement = $conexion->query($sql);
        
        $resultados = $statement->fetchAll();

        foreach($resultados as $fila) {
            $cod_datos = $fila["cod_datos_cliente"];
        }
        

        $consultaSQL = 'DELETE FROM Datos_Clientes_Y_Clientes where dni_cliente = "'.$_POST["dni"].'"';
        $conexion->query($consultaSQL);

        $sql = 'SELECT idVuelos from vuelos where dni_cliente = "'.$_POST["dni"].'"';
    
        $statement = $conexion->query($sql);
        
        $resultados = $statement->fetchAll();

        foreach($resultados as $fila) {
            $cod_vuelos = $fila["idVuelos"];
            $consultaSQL = 'DELETE FROM destinos_y_vuelos where idVuelos = '.$cod_vuelos.'';
            $conexion->query($consultaSQL);
    
        }


        // SELECT idVuelos from vuelos where dni_cliente = "12345678B"

        $consultaSQL = 'DELETE FROM vuelos where Dni_cliente = "'.$_POST["dni"].'"';
        $conexion->query($consultaSQL);

        // DELETE FROM vuelos where Dni_cliente = "12345678B"

        $consultaSQL = 'DELETE FROM clientes where Dni = "'.$_POST["dni"].'"';
        $conexion->query($consultaSQL);

        // DELETE FROM clientes where Dni = "12345678B";
        $consultaSQL = 'DELETE FROM Datos_clientes where cod_datos_cliente = "'.$cod_datos.'"';
        $conexion->query($consultaSQL);

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}

if (isset($_POST['submit'])) {
    del_cliente();
}

?>

