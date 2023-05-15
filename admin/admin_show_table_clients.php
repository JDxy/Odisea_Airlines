<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de clientes</title>
  <link rel="stylesheet" href="../CSS/menu&footer_style.css">
  <link rel="stylesheet" href="../CSS/tables_style.css">
</head>


<?php


require_once '../PHP/parts/header_admin.php';
?>

<form action="<?php $_SERVER["PHP_SELF"]?>" method="post">

<?php

    require '../PHP/class/class_shop.php';

    $sh = new Shop();
    $clientes = $sh->show_table("CLIENTE");
    // Mostrar la tabla HTML

    echo '<table>';
    // Encabezados de la tabla
    echo '<tr><th>Correo electrónico</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Dirección</th>
    <th>Contraseña</th><th>Eliminar</th></tr>';
    // Filas de la tabla

    foreach ($clientes as $cliente) {
        echo '<tr>';

        echo '<td>' . $cliente['Correo_electronico_cliente'] . '</td>';
        echo '<td>' . $cliente['Nombre_cliente'] . '</td>';
        echo '<td>' . $cliente['Apellido_cliente'] . '</td>';
        echo '<td>' . $cliente['Telefono'] . '</td>';
        echo '<td>' . $cliente['Direccion'] . '</td>';
        echo '<td>' . $cliente['CONTRASENA'] . '</td>';

      
      
        echo '<td>' . '<button type="submit" name="eliminar" value="' . $cliente['Correo_electronico_cliente'] . '">Eliminar</button>' . '</td>';


    

      echo '</tr>';
    }

    echo '</table>';



    if(isset($_POST["eliminar"])){
      
      $sh->delete_element('PEDIDO', 'Correo_electronico_cliente', $_POST["eliminar"]);

      $sh->delete_element('CLIENTE', 'Correo_electronico_cliente', $_POST["eliminar"]);

      header("Refresh: 0");


    };

    


?>
</form>

<!-- <input type="submit"> -->
<?php
 require_once '../PHP/parts/footer_admin.php';
?>