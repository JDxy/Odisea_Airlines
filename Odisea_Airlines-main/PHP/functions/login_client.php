<?php
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