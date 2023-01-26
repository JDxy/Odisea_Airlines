<?php


/**
 * del_cliente
 *
 * @return void
 */
function del_cliente(){

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];
    
    $config = include "../../../config.php";
    try {

        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = $conexion->prepare('SELECT cod_datos_cliente FROM Datos_Clientes_Y_Clientes WHERE dni_cliente = "'.$_POST["dni"].'"');
        $query->execute();



        $row = $query->fetch(PDO::FETCH_ASSOC);
        $cod = $row["cod_datos_cliente"];
        


        $consultaSQL = 'DELETE FROM Datos_Clientes_Y_Clientes where dni_cliente = "'.$_POST["dni"].'"';
        $conexion->query($consultaSQL);



        $consultaSQL = 'DELETE FROM clientes where Dni = "'.$_POST["dni"].'"';
        $conexion->query($consultaSQL);



        $consultaSQL = 'DELETE FROM Datos_clientes where cod_datos_cliente = "'.$cod.'"';
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
