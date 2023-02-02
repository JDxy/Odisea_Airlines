

<?php
/**
* Function login_admin
* This function is used to log in an administrator into the system.
* It starts by including the config file to set up a database connection using PDO.
* Then, it fetches data from a submitted form, validates the administrator's code and password, and sets a cookie with the administrator's code if the validation is successful.
* The function returns 'El codigo no existe' if the administrator's code does not exist in the database, and 'La contraseña no es valida' if the password is incorrect.
* If a successful login is made, it will display 'El admin se ha logeado correctamente'.
* If an error occurs, it is caught and an error message is added to the 'resultado' array with the 'error' and 'mensaje' keys.
* @author [Author Name]
* @return string Result of the operation in a string format.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $cod_admin Administrator's code.
* @var string $contraseña Administrator's password.
* @var string $valid Flag for indicating whether the validation is successful or not.
* @var string $consultaSQL SQL query for fetching data from the 'administradores' table.
* @var PDOStatement $resultado Result of executing the SQL query.
* @var array $filas Rows of data from the 'administradores' table.
* @var array $array Array for storing the administrator's codes or passwords.
*/
function login_admin() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";

    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $valid = "true";

        $cod_admin = $_POST["cod_admin"];
        $contraseña = $_POST['contraseña'];;

        $consultaSQL = "SELECT cod_admin FROM administradores";

        $resultado = $conexion->query($consultaSQL);
        $filas = $resultado->fetchAll();
        $array = [];
        for ($i=0; $i < count($filas); $i++) { 
            array_push($array,$filas[$i]["cod_admin"]);
        }

        if (!in_array($cod_admin,$array)) {

            $valid = "false";
            echo "El codigo no existe";

            return $valid;
        
        }


        $consultaSQL = "SELECT contrasena FROM administradores WHERE cod_admin = ".$cod_admin." ";

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
            setcookie("admin",$cod_admin, time() + (86400 * 30)); 
            echo "El admin se ha logeado correctamente";
        }


    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    
    login_admin();
    header("Location: ../../index.php");
    exit;

}

if(isset($_POST['close'])){
    setcookie("admin", "", time()-(86400 * 30));
    header("Location: ../../index.php");
}

?>

