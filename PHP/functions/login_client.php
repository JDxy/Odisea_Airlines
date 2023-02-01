<?php
/**
* Function login_client
* This function is used to log in a client to the system.
* It starts by including a config file to set up a database connection using PDO.
* Then, it fetches data from a submitted form and checks if the client's DNI exists in the "clientes" table.
* If the DNI exists, it finds the relationship between the client and their details in the "Datos_clientes_Y_Clientes" table.
* The password is then retrieved from the "Datos_Clientes" table and checked against the password submitted in the form.
* If the password is correct, a cookie is set with the client's DNI.
* If an error occurs during the process, it is caught and an error message is added to the result array.
* @author [Author Name]
* @return void
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $dni DNI of the client.
* @var string $contraseña Password of the client.
* @var string $valid Flag to indicate if the login is valid.
* @var string $consultaSQL SQL query for checking if the client's DNI exists in the "clientes" table.
* @var PDOStatement $resultado Result of the "clientes" table query.
* @var array $filas Rows from the "clientes" table query.
* @var array $array Array of DNIs from the "clientes" table.
* @var PDOStatement $query Prepared statement for getting the relationship between the client and their details.
* @var array $row Row from the "Datos_clientes_Y_Clientes" table.
* @var string $cod Code for the client's details.
* @var string $consultaSQL SQL query for getting the client's password from the "Datos_Clientes" table.
* @var PDOStatement $resultado Result of the "Datos_Clientes" table query.
* @var array $filas Rows from the "Datos_Clientes" table query.
* @var array $array Array of passwords from the "Datos_Clientes" table.
*/
function login_client() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $valid = "true";

        $dni = $_POST["dni"];
        $contraseña = $_POST["contraseña"];

        $consultaSQL = "SELECT dni FROM clientes";

        $resultado = $conexion->query($consultaSQL);
        $filas = $resultado->fetchAll();
        $array = [];
        for ($i=0; $i < count($filas); $i++) { 
            array_push($array,$filas[$i]["dni"]);
        }

        if (!in_array($dni,$array)) {

            $valid = "false";
            echo "El dni no existe";

            return $valid;
        
        }

 

    #Alinear los codigos
        $query = $conexion->prepare('SELECT cod_datos_cliente FROM Datos_Clientes_Y_Clientes WHERE dni_cliente = "'.$dni.'"');
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        $cod = $row["cod_datos_cliente"];


        $consultaSQL = "SELECT D.contrasena FROM Datos_clientes D, Datos_clientes_y_clientes DC WHERE DC.cod_datos_cliente = ".$cod." AND D.cod_datos_cliente = ".$cod." ";
        // echo $consultaSQL;
        $resultado = $conexion->query($consultaSQL);
        $filas = $resultado->fetchAll();
        $array = [];

        for ($i=0; $i < count($filas); $i++) { 

            array_push($array,$filas[$i]["contrasena"]);
        }

        if (!in_array($contraseña,$array)){
            $valid = "false";
            echo $contraseña;
            echo "La contraseña no es valida";

            return $valid;
        }

        if ($valid == "true") {
            setcookie("usuario",$dni, time() + (86400 * 30)); 
        }


    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    
    login_client();
    header("Location: index.php");

}

if(isset($_POST['close'])){
    setcookie("usuario", "", time()-(86400 * 30));
    header("Location: index.php");
}

?>

