<?php
if (isset($_POST["finalizar_transaccion"])) {
  setcookie('trolley', '', time()-3600);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="CSS/menu&footer_style.css">
    <link rel="stylesheet" href="CSS/trolley_style.css">

<?php
require_once 'PHP/parts/header.php';
?>

<!-- 
<div class="productos">
  
</div> -->

<h1>Tu carrito</h1>


<?php

if (isset($_COOKIE['trolley'])){

  $total = 0;
  $trolley = json_decode($_COOKIE['trolley'], true);
  $array_cantidad = [];
  $array_precios = [];



  if (isset($_POST["actualizar_cantidad"])){
    $producto_id = $_POST["actualizar_cantidad"];
    $cantidad = $_POST["nuevaCantidad"];
    $new_trolley = [];
    foreach ($trolley as $key => $value) {
      if ($value[0] == $producto_id) {
        $value[4] = $cantidad;
      }
      array_push($new_trolley, $value);
    }

    setcookie('trolley', json_encode($new_trolley), time()+3600);
  
    header('Location: ' . $_SERVER['PHP_SELF']);
  }

  
  if (count(json_decode($_COOKIE['trolley'])) == 0){

    header('Location: ' . 'trolley.php');
  }

  $array = [];


  foreach ($trolley as $key => $value) {
    array_push($array_cantidad, $value[0]);

    $total = $total + $value[3] * $value[4];

    echo '<div class="producto">';

    echo '<img src="' . $value[1] . '" alt="">';
    echo '<h3>' . $value[2]  . '</h3>';
    echo '<p>Cantidad:</p>';
    echo '<form action="'. $_SERVER['PHP_SELF'] .'" method="post">
    
    <div class="cantidad">
      <input type="hidden" name="product_id" value="'. $value[0].'">

      <button type="button" onclick="mostrarInput(' . $value[0] . ')">Cambiar</button>
      <div id="inputCantidad' . $value[0] . '" style="display:none">

        <input type="number" name="nuevaCantidad" id="nuevaCantidad' . $value[0] . '" min="1" value="' . $value[4] . '">
        <button type="submit" name="actualizar_cantidad" value="' . $value[0] . '">Actualizar</button>
      </div>
    
    </div>
  </form>';
    echo   '<p>' . $value[4] . '</p>';
    
    echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
    echo '<input type="hidden" name="eliminar_producto" value="' . $value[0] . '">';
    echo '<button class="eliminar" type="submit">Eliminar producto</button>';
    echo '</form>';
    echo '</div>';

  

}



if (isset($_POST["finalizar_transaccion"])) {



  $pedido = $sh->show_table("pedido");
  // obtiene los valores necesarios del carrito
  $cookie_user = $_COOKIE['cliente'];
  $user = json_decode($cookie_user, true);
  

  $correo_electronico_cliente = $user['email']; // cambiar por el correo electrónico del cliente
  $fecha_pedido = date('Y-m-d'); // obtiene la fecha actual
foreach ($trolley as $producto) {

  
  $id_producto = $producto[0]; 

  $cantidad = $producto[4];
  $precio_unitario = $producto[3];
  $stock = $sh->select_values("PRECIO", "Cantidad_disponible", "WHERE ID_producto = 2");
  $stock = $stock[0]["Cantidad_disponible"];

  if ($cantidad > $stock){
    echo '<script>alert("No hay suficiente stock")</script>';
  } else {

    $sh->insert_value('Pedido', 'ID_producto, Correo_electronico_cliente, Cantidad, Precio_unitario, Fecha_pedido',
    "{$id_producto}, '{$correo_electronico_cliente}', {$cantidad}, {$precio_unitario}, '{$fecha_pedido}'");
    header('Location: ' . 'shop.php');
  }
}
};


if (isset($_POST['eliminar_producto'])) {
$producto_id = $_POST['eliminar_producto'];
$new_trolley = [];
foreach ($trolley as $key => $value) {
  if ($value[0] != $producto_id) {
    array_push($new_trolley, $value);
  }
}
$cookie_value = json_encode($new_trolley);
setcookie('trolley', $cookie_value, time()+3600);
header('Location: ' . $_SERVER['PHP_SELF']);
}



#FORM PARA ACTUALIZAR CANTIDAD


  echo '<button class="myButton pagar" id="abrir-modal" name="pagar" onclick="realizarPago()">Pagar ' . $total . '€</button>';

}else {
  echo '<h2 class="no_existance">No hay productos en el carrito</h2>';
};



?>

<div class="modal-overlay ">
    <div class="modal">
      <h2>Introduce tus datos de pago</h2>

    <label>
      Nombre del titular:
      <input type="text" name="nombre" require>
    </label>
    <label>
      Número de tarjeta:
      <input type="text" name="tarjeta" require>
    </label>
    <label>
      Fecha de vencimiento:
      <input type="date" name="vencimiento" require>
    </label>
    <label>
      CVV:
      <input type="number" name="cvv" require>
    </label>
<?php
 

    echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">

    <input type="submit" class="myButton" name="finalizar_transaccion" value="Pagar '.$total.'€">
 
  </form>';

?>

      <button class="close_button" type="button">Cerrar</button>
  </div>
</div>





<?php

?>
<script src="JS/trolley_script.js"></script> 
<?php
  require_once 'PHP/parts/footer.php';
?>