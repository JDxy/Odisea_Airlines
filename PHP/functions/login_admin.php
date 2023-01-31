<?php
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

        $cod_admin = "1";
        $contraseña = "22319";

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
    header("Location: index.php");
    exit;

}

if(isset($_POST['close'])){
    setcookie("admin", "", time()-(86400 * 30));
    header("Location: index.php");
}

?>