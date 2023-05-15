<?php
    session_start();
    require '../PHP/class/class_shop.php'; 
    if(isset($_POST["send"])){

      $shop = new Shop();
      
      if($_FILES['foto']['error'] === 0){
        // Si el archivo se cargó correctamente, lo movemos a la carpeta deseada
     
        $nombre_imagen = $_FILES['foto']['name'];
        $ruta_temporal = $_FILES['foto']['tmp_name'] ;
        $url_imagen = "../ASSETS/IMG/PRODUCTOS/". $_POST["name_imagen_url"];
        copy($ruta_temporal, $url_imagen);
      
    }
      // $url_imagen = "../ASSETS/IMG/PRODUCTOS/".$nombre_imagen;}

      // $lista = ["Producto"," Img_producto, Nombre_producto, Tipo_producto ", "'{$_POST["name_imagen"]}','{$_POST["name_nombre"]}','{$_POST["name_tipo"]}'"];
      

      $lista = ["Producto"," Img_producto, Nombre_producto, Tipo_producto ", "'{$url_imagen}','{$_POST["name_nombre"]}','{$_POST["name_tipo"]}'"];
      
      $shop->insert_value($lista[0],$lista[1],$lista[2]);
      $total = $shop->total_rows("Producto");


      $lista = ["Marca","ID_producto, Marca, Descripcion", "{$total},'{$_POST["name_precio"]}','{$_POST["name_stock"]}'"];

      $shop->insert_value($lista[0],$lista[1],$lista[2]);

      $lista = ["Precio","Id_producto, Precio_unitario, Cantidad_disponible", "'{$total}','{$_POST["name_marca"]}','{$_POST["name_descripcion"]}'"];

      $shop->insert_value($lista[0],$lista[1],$lista[2]);
      header("Location: admin_show_table_products.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../CSS/form_style.css">
  <link rel="stylesheet" href="../CSS/menu&footer_style.css">
</head>
<?php
  require_once '../PHP/parts/header_admin.php';
?>


<form action="<?php $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
    <h1>Añadir producto</h1>
    <input type="text" name="name_nombre" id="id_nombre" placeholder="nombre" required>
    <label for="name_imagen">Imagen</label>
    
    <img src="" class="img_selected" name="name_imagen" id="img" alt="">
    <input type="hidden" name="name_imagen_url" id="img_url" value="">
    <input type="file" name="foto" id="foto" accept="image/*" />

    <label for="name_tipo" >tipo de producto</label>
    <select name="name_tipo" id="id_tipo">
      <option value="TABLA">Tabla</option>
      <option value="RUEDAS">Ruedas</option>
      <option value="RODAMIENTOS">Rodamientos</option>
      <option value="TRUCKS">Trucks</option>
      <option value="SKATE">skate</option>
    </select>

    <input type="text" name="name_precio" id="id_precio" placeholder="precio" required>
    <input type="text" name="name_stock" id="id_stock" placeholder="stock" required>

    <input type="text" name="name_marca" id="id_marca" placeholder="marca" required>
    <input type="text" name="name_descripcion" id="id_descripcion" placeholder="descripcion" required>

    <input class="send" type="submit" name="send" id="id_send" value="Enviar">

</form>
<script src="../JS/admin_products.js"></script>
<?php

  require_once '../PHP/parts/footer_admin.php';
?>