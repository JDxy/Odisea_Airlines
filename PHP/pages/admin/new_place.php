<?php 
include "../../functions/create_places.php";
include "../../parts/header.php";
?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="origen">Origen</label>
        <input type="text" name="origen" id="origen">
        <label for="destino">destino</label>
        <input type="text" name="destino" id="destino">
        <label for="fecha_llegada">Fecha llegado</label>
        <input type="date" name="fecha_llegada" id="fecha_llegada">
        <label for="fecha_salida">fecha_salida</label>
        <input type="date" name="fecha_salida" id="fecha_salida"> 
        <input type="submit" name="submit" id="submit" value="Enviar">
    </form>

<?php
include "../../parts/footer.php";
?>