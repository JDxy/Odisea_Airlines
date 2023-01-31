<?php


include "../functions/login_admin.php";
include "../parts/header.php";

?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="dni">Codigo admin</label>
        <input type="text" name="cod_admin" id="cod_admin"require>
        <label for="contraseña" >Contraseña</label>
        <input type="text" name="contraseña" id="contraseña" require>
        <input type="submit" class="submit" name="submit" id="submit" value="Enviar">
        <input type="submit" class= "submit" name="close" value="Cerrar sesion">
    </form>

<?php
include "../parts/footer.php";
?>