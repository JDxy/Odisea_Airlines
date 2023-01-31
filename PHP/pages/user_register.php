<?php 



include "../functions/create_client.php";

include "../parts/header.php";

?>



    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni" require>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" require>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" require>
        <label for="numero_telefono">Numero de telefono</label>
        <input type="text" name="numerotelefono" id="numerotelefono" require>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" require> 
        <label for="contraseña">Contraseña</label>
        <input type="text" name="contraseña" id="contraseña" require>
        <input type="submit" class="submit" name="submit" value="enviar">
    </form>

<?php

include "../parts/footer.php";
?>