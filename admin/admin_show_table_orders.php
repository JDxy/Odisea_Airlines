<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de pedidos</title>
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
    $pedidos = $sh->show_table("pedido");
    // Mostrar la tabla HTML
    echo '<table>';
    // Encabezados de la tabla
    echo '<tr><th>ID</th><th>ID_producto</th><th>ID_cliente</th><th>Cantidad</th><th>Precio_unitario</th><th>Fecha_pedido</th><th>Eliminar</th></tr>';
    // Filas de la tabla
    foreach ($pedidos as $pedido) {
        echo '<tr>';
        echo '<td>' . $pedido['ID_PEDIDO'] . '</td>';
        echo '<td>' . $pedido['ID_producto'] . '</td>';
        echo '<td>' . $pedido['Correo_electronico_cliente'] . '</td>';
        echo '<td>' . $pedido['Cantidad'] . '</td>';
        echo '<td>' . $pedido['Precio_unitario'] . '</td>';
        echo '<td>' . $pedido['Fecha_pedido'] . '</td>';
        echo '<td>' . '<button name="eliminar" value="'.$pedido['ID_PEDIDO'].'">Eliminar</button>' . '</td>';

    echo '</tr>';
    }
    echo '</table>';



    if(isset($_POST["eliminar"])){
      
      $sh->delete_element('PEDIDO', 'ID_PEDIDO', $_POST["eliminar"]);

      header("Refresh: 0");


    };

?>

</form>

<?php
 require_once '../PHP/parts/footer_admin.php';
?>