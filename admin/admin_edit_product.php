<?php
    session_start();
    require '../PHP/class/class_shop.php'; 
    $id = $_POST["id_producto"];
    if(isset($_POST["send"])){

            $shop = new Shop();
            
            $nombre_tabla = "Producto";
            
        
            if($_FILES['foto']['error'] === 0){
                // Si el archivo se cargó correctamente, lo movemos a la carpeta deseada
             
                $nombre_imagen = $_FILES['foto']['name'];
                $ruta_temporal = $_FILES['foto']['tmp_name'] ;
                // $ruta_destino = "../ASSETS/IMG/PRODUCTOS/" ;
                $url_imagen = "../ASSETS/IMG/PRODUCTOS/". $_POST["name_imagen_url"];
                copy($ruta_temporal, $url_imagen);
                $columnas_valores = "Img_producto='{$url_imagen}',";
              
            }
            
        
            if ($_POST["name_nombre"] != "") {
                $columnas_valores .= "Nombre_producto='{$_POST["name_nombre"]}',";
            }
        
            if ($_POST["name_tipo"]  != "") {
                $columnas_valores .= "Tipo_producto='{$_POST["name_tipo"]}'";
            }
        
             // Eliminar la última coma y espacio en blanco
        
            $condicion = "ID_producto = {$id}";
            $shop->update_value($nombre_tabla, $columnas_valores, $condicion);
        
         
            $columnas_valores = "";
        
            if ($_POST["name_marca"] != "") {
                $columnas_valores .= "Marca='{$_POST["name_marca"]}', ";
            }
        
            if ($_POST["name_descripcion"] != "") {
                $columnas_valores .= "Descripcion='{$_POST["name_descripcion"]}', ";
            }
        
            $columnas_valores = rtrim($columnas_valores, ", "); // Eliminar la última coma y espacio en blanco
        
           
            $nombre_tabla = "Marca";
            $shop->update_value($nombre_tabla, $columnas_valores, $condicion);
        
           
            $columnas_valores = "";
        
            if ($_POST["name_precio"] != "") {
                $columnas_valores .= "Precio_unitario='{$_POST["name_precio"]}', ";
            }
        
            if ($_POST["name_stock"]  != "") {
                $columnas_valores .= "Cantidad_disponible='{$_POST["name_stock"]}', ";
            }
        
            $columnas_valores = rtrim($columnas_valores, ", "); // Eliminar la última coma y espacio en blanco
        
            
            $nombre_tabla = "Precio";
            $shop->update_value($nombre_tabla, $columnas_valores, $condicion);
        
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

//   $sh->select_values("PRODUCTO","*","WHERE Id_producto = {}")
?>




<form action="<?php $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
    <h1>Editar producto</h1>
    <input type="text" name="name_nombre" id="id_nombre" placeholder="nombre">
    
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

    <input type="text" name="name_precio" id="id_precio" placeholder="precio">

    <input type="text" name="name_stock" id="id_stock" placeholder="stock">

    <input type="text" name="name_marca" id="id_marca" placeholder="marca">

    <input type="text" name="name_descripcion" id="id_descripcion" placeholder="descripcion">

    <input class="send" type="submit" name="send" id="id_send" value="Enviar">

</form>
<script src="../JS/admin_products.js"></script>
<?php
     echo $id;
   require_once '../PHP/parts/footer_admin.php';
?>