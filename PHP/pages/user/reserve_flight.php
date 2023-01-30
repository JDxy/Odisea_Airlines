<?php 
include "../../functions/reserve.php";

$config = include "../../../config.php";

$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = "SELECT * FROM destinos";

$statement = $conexion->query($sql);

$resultados = $statement->fetchAll();



include "../../parts/header.php";
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <label for="matricula_avion">Matricula avion</label>
    <input type="text" name="matricula_avion" id="matricula_avion" require>
    <input type="hidden" name="dni" id="dni" value="<?php echo $_COOKIE["usuario"] ?>" require>
    <?php
        echo "<table>";
        echo "<tr>";
        echo "<th>Cod Destino</th>";
        echo "<th>Destino</th>";
        echo "<th>Origen</th>";
        echo "<th>Fecha llegada</th>";
        echo "<th>Fecha salida</th>";
        echo "<th>Precio</th>";
        echo "</tr>";
        foreach($resultados as $fila) {
          echo "<tr>";
          
            echo "<td>".$fila["cod_Destino"]."</td>";
            echo "<td>".$fila["Destino"]."</td>";
            echo "<td>".$fila["Origen"]."</td>";
            echo "<td>".$fila["Fecha_llegada"]."</td>";
            echo "<td>".$fila["Fecha_salida"]."</td>";
            echo "<td>".$fila["Precio"]."</td>";
          echo "</tr>";
        }
        echo "</table>";
    ?>
    <select name="destino" id="destino">
    <?php
        foreach($resultados as $fila) {
            echo "<option value=".$fila["cod_Destino"]."> Num vuelo:".$fila["cod_Destino"]." ".$fila["Origen"]."-".$fila["Destino"]."</option>";
        }
    ?>
    </select>
    <input type="submit" class="submit" name="submit" value="enviar">
</form>


<?php
include "../../parts/footer.php";
?>