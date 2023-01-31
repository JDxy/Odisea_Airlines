<?php
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

            echo $consultaSQL;
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();

        }
    };

    foreach ($datos_clientes as $key => $value) {
        if ($value != "") {
            $consultaSQL = "UPDATE datos_clientes";
            $consultaSQL .= ' SET '.$key.' = "'.$value.'" WHERE cod_datos_cliente = "'.$cod.'"';
            echo $consultaSQL;

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