<?php
/**
* Function update_client
* This function updates an existing client in the database.
* It starts by including a config file to setup a database connection using PDO.
* Then, it retrieves the client's DNI and data from a submitted form.
* The function then updates the "clientes" and "Datos_Clientes" tables with the new data.
* The relationship between the client and their details is updated by finding the "cod_datos_cliente" value using a SELECT query on the "Datos_Clientes_Y_Clientes" table.
* If an error occurs, it is caught and added to the result array as an 'error' and 'message' key.
* @author [Author Name]
* @return array Result of the operation with 'error' and 'message' keys.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $dni DNI of the client.
* @var array $cliente Array of client data including "Nombre" and "Apellidos".
* @var array $datos_clientes Array of client details including "NumeroTelefono", "Email", and "contraseña".
* @var PDOStatement $query Prepared statement for fetching the "cod_datos_cliente" from the "Datos_Clientes_Y_Clientes" table.
* @var array $row Result of the SELECT query.
* @var string $cod "cod_datos_cliente" value.
* @var string $consultaSQL SQL query for updating data in the "clientes" and "datos_clientes" tables.
* @var PDOStatement $sentencia Prepared statement for executing the update queries.
*/

function update_client() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $dni = $_POST["dni"];

        $cliente = [  
        "Nombre" => $_POST["nombre"],
        "Apellidos" => $_POST["apellidos"],

        ];

        $datos_clientes = [
            "NumeroTelefono" => $_POST["numerotelefono"],
            "Email" => $_POST["email"],
            "contrasena" => $_POST["contraseña"]
        ];


        $query = $conexion->prepare('SELECT cod_datos_cliente FROM Datos_Clientes_Y_Clientes WHERE dni_cliente = "'.$_POST["dni"].'"');
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        $cod = $row["cod_datos_cliente"];


    foreach ($cliente as $key => $value) {
    
        if ($value != "") {
            
            // echo $key;
            $consultaSQL = "UPDATE clientes";
            $consultaSQL .= ' SET '.$key.' = "'.$value.'" WHERE dni = "'.$dni.'";';


            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();

        }
    };

    foreach ($datos_clientes as $key => $value) {
        if ($value != "") {
            $consultaSQL = "UPDATE datos_clientes";
            $consultaSQL .= ' SET '.$key.' = "'.$value.'" WHERE cod_datos_cliente = "'.$cod.'"';


            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
        }
    }

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    
    update_client();

}

?>

