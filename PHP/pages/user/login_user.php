<?php


include "../../functions/login_client.php";
include "../../parts/header.php";

?>


    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni"require>
        <label for="contraseña" >Contraseña</label>
        <input type="text" name="contraseña" id="contraseña" require>
        <input type="submit" name="submit" id="submit" value="Enviar">
    </form>

<?php
include "../../parts/footer.php";
?>