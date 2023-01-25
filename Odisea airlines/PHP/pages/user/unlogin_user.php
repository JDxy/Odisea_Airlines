<?php 
include "../../functions/delete_client.php";
include "../../parts/header.php";
?>

    <form action="<?php echo "del_user.php"?>" method="post">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni">
        <input type="submit" name="submit" id="submit" value="Enviar">
    </form>

<?php
include "../../parts/footer.php";
?>