<?php

/**
 * Function create_client
 * 
 * This function creates a new client in the database.
 * It starts by including a config file to setup a database connection using PDO.
 * Then, it fetches data from a submitted form and inserts it into two tables: "clientes" and "Datos_Clientes".
 * Finally, it creates a relationship between the client and their details by inserting data into the "Datos_clientes_Y_Clientes" table.
 * If an error occurs, it is caught and an error message is added to the result array.
 * 
 * @author [Author Name]
 * 
 * @return array Result of the operation with 'error' and 'message' keys.
 * 
 * @throws PDOException If there is an error connecting to the database.
 * 
 * @var PDO $conexion Connection to the database.
 * @var array $config Configuration array for the database connection.
 * @var string $dsn Data source name for the database connection.
 * @var string $dni DNI of the client.
 * @var string $Nombre First name of the client.
 * @var string $Apellidos Last name of the client.
 * @var string $consultaSQL SQL query for inserting data into the "clientes" table.
 * @var PDOStatement $sentencia Prepared statement for executing the "clientes" insert query.
 * @var string $NumeroTelefono Telephone number of the client.
 * @var string $Email Email of the client.
 * @var string $contraseña Password of the client.
 */

function create_client() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
    try {
   
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        
        $dni = $_POST["dni"];
        $Nombre = $_POST["nombre"];
        $Apellidos = $_POST["apellidos"];

        



        $consultaSQL = "INSERT INTO clientes (dni, nombre, apellidos)";
        $consultaSQL .= 'values ("'.$dni.'","'.$Nombre.'","'.$Apellidos.'")';
        


        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();



        $NumeroTelefono = $_POST["numerotelefono"];
        $Email = $_POST["email"];
        $contraseña = $_POST["contraseña"];


        $consultaSQL = 'INSERT INTO Datos_Clientes VALUES (NULL,"'.$NumeroTelefono.'", "'.$contraseña.'","'.$Email.'")';

        $conexion->query($consultaSQL);


        $consultaSQL = 'INSERT INTO Datos_clientes_Y_Clientes SELECT "'.$dni.'", D.cod_datos_cliente FROM Datos_Clientes D ORDER BY cod_datos_cliente desc LIMIT 1';

        echo $consultaSQL;
        $conexion->query($consultaSQL);

        

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    header("Location: user_login.php");
    create_client();

}

?>
