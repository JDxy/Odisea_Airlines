<?php 
include "../functions/create_client.php";
include "../parts/header.php";
?>



    <form action="<?php echo "login.php"?>" method="post">
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
        <input type="submit" name="submit" value="enviar">
    </form>

<?php
include "../parts/footer.php";
?>