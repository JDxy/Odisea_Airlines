<?php 

// function session(){
//     session_start();
    
//     $_SESSION[$_POST['dni']] = [$_POST['nombre'], $_POST['apellidos'], $_POST['numerotelefono'],$_POST['email']];
    
//     return $_SESSION[$_POST['dni']];
//     }

include "../../functions/create_client.php";
// print_r(session());
include "../../parts/header.php";


?>



    <form action="<?php echo "register.php"?>" method="post">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos">
        <label for="numero_telefono">Numero de telefono</label>
        <input type="text" name="numerotelefono" id="numerotelefono">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"> 
        <label for="contraseña">Contraseña</label>
        <input type="text" name="contraseña" id="contraseña">
        <input type="submit" class="submit" name="submit" value="enviar">
    </form>

<?php

include "../../parts/footer.php";
?>