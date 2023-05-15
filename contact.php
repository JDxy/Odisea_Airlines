<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contactanos</title>
  <link rel="stylesheet" href="CSS/form_style.css">
  <link rel="stylesheet" href="CSS/menu&footer_style.css">

<?php
    require_once 'PHP/parts/header.php';
?>

<form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
    <h1>Contactanos</h1>
    <input type="text" name="name_nombre" id="id_nombre" placeholder="nombre">
    <input type="text" name="name_email" id="id_email" placeholder="email">
    <input type="text" name="name_asunto" id="id_asunto" placeholder="asunto">
    <textarea id="w3review" name="w3review" rows="4" cols="50">
    </textarea>

    <input class="send" name="send" type="submit" id="id_send" value="send">
  
</form>

<?php

if (isset($_POST['send'])){


    // Declaración de variables del formulario
    $nombre = $_POST['name_nombre'];
    $email = $_POST['name_email'];
    $asunto = $_POST['name_asunto'];
    $mensaje = $_POST['w3review'];
    
    // Datos del email
    $para = "adrenalineollie@gmail.com";
    $titulo = $asunto;
    $header = 'From: ' . $email;
    $msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $mensaje";
    


    if (@mail($para, $titulo, $msjCorreo, $header)) {

    echo "<script language='javascript'>
    alert('Mensaje enviado, muchas gracias por contactar con nosotros.');
    </script>";
    } else {
        echo 'Falló el envio';
    }
    
    

}
require_once 'PHP/parts/footer.php';

?>