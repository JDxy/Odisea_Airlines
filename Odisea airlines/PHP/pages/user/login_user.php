<?php 
include "../../functions/login_client.php";
include "../../parts/header.php";
?>

    <form action="<?php echo "login_user.php"?>" method="post">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">
        <label for="contraseña">Contraseña</label>
        <input type="text" name="contraseña" id="contraseña">
        <input type="submit" name="submit" id="submit" value="Enviar">
    </form>

<?php
include "../../parts/footer.php";
?>