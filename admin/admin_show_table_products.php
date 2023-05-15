<?php
session_start();
require '../PHP/class/class_shop.php';
$sh = new Shop();
if(isset($_POST["eliminar"])){

  // $sh->delete_element('PRODUCTO', $_POST["eliminar"]);

if ($sh->exist_element('PEDIDO', 'producto', $_POST["eliminar"])){

$sh->delete_element('PEDIDO', 'ID_producto', $_POST["eliminar"]);

};

$sh->delete_element('PRECIO', 'ID_producto', $_POST["eliminar"]);

$sh->delete_element('MARCA', 'ID_producto', $_POST["eliminar"]);

$sh->delete_element('PRODUCTO', 'ID_producto', $_POST["eliminar"]);

header("Refresh: 0");

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tablas de pedidos</title>
  <link rel="stylesheet" href="../CSS/menu&footer_style.css">
  <link rel="stylesheet" href="../CSS/tables_style.css">
</head>
<body>
<?php
  require_once '../PHP/parts/header_admin.php';
  ?>
  <a href="admin_add_product.php" class="new_product">Nuevo producto</a>
  
  
  <?php
  $count = 1;
  // $user = $_SESSION['admin_name'];
  // if (isset($_SESSION['admin_name'])) {

    $productos = $sh->show_table("producto");
    $precio = $sh->show_table("precio");
    $marca = $sh->show_table("marca");
    // Primera tabla
    echo '<div class="table-container">';
 
    echo '<table>';
    echo '<tr>
    <th>Eliminar</th><th>Editar</th><th>ID</th><th>Nombre_producto</th><th>Img_Producto</th><th>Tipo_producto</th>';
    foreach ($productos as $producto) {
        echo '<tr>';
        echo '<td>' .'<form action="' . $_SERVER["PHP_SELF"] .'" method="post">'. 
        '<button name="eliminar" value="'. $producto['ID_producto'] .'">Eliminar</button>
        </form>' . '</td>';

        
       echo '<td>' . '<form action="admin_edit_product.php" method="POST">
        <button type="submit" name="id_producto" value="' . $producto['ID_producto'] . '">Editar</button>
        </form>' . '</td>';

        echo '<td>' . $producto['ID_producto'] . '</td>';

        echo '<td>' . $producto['Nombre_producto'] . '</td>';
        echo '<td> <img src="' . $producto['Img_producto'] . '" alt=""></td>';
        echo '<td>' . $producto['Tipo_producto'] . '</td>';
        echo '</tr>';
    }
    echo '<table>';
    echo '<tr>
    <th>precio</th><th>Cantidad</th>';
    foreach ($precio as $p) {
        echo '<tr>';
        echo '<td>' . $p['Precio_unitario'] . '</td>';
        echo '<td>' . $p['Cantidad_disponible'] . '</td>';
        echo '</tr>';
    }
    echo '<table>';
    echo '<tr>
    <th>ID_marca</th><th>Marca</th><th>Descripcion</th></tr>';
   
    foreach ($marca as $m) {
        echo '<tr>';
        echo '<td>' . $m['ID_marca'] . '</td>';
        echo '<td>' . $m['Marca'] . '</td>';
        echo '<td>' . $m['Descripcion'] . '</td>';

           

    

        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
  

    ?>
    </form>
    
    <!-- <input type="submit"> -->
    <script src="trollley_script.js"></script>
    <?php
 require_once '../PHP/parts/footer_admin.php';
?>
</body>
</html>
