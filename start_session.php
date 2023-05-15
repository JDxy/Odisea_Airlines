<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesion</title>
  <link rel="stylesheet" href="CSS/form_style.css">
  <link rel="stylesheet" href="CSS/menu&footer_style.css">

<?php
    require_once 'PHP/parts/header.php';
?>

<form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
    <h1>Iniciar sesion</h1>
    <input type="text" name="name_email" id="id_email" placeholder="email">
    <input type="password" name="name_password" id="id_password" placeholder="password"> 
    <input class="send" name="send" type="submit" id="id_send" value="send">
    <p>Si no tienes cuenta, <a href="register.php">REGISTRATE AQUI</a></p>
</form>

<?php
if (isset($_POST['send'])){
    // require_once 'PHP/class/class_shop.php';
    // $sh = new Shop();

    $name_email = $_POST['name_email'];
    $name_password = $_POST['name_password'];
    
    
    if ($sh->exist_client($name_email, $name_password)){
    
        $cliente = array('email' => $name_email, 'contrasena' => $name_password);
        setcookie('cliente', json_encode($cliente), time()+2592000); // la cookie expirará en un mes (30 días * 24 horas * 60 minutos * 60 segundos = 2592000)

        $url = 'index.php';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'">';
        exit();
    }else{
        echo "<script>alert('Error al iniciar sesión');</script>";
    }

}
require_once 'PHP/parts/footer.php';

?>