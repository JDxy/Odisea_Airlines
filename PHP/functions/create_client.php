<?php

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
    header("Location: user_login_user.php");
    create_client();

}

?>