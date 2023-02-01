<?php 
include "../functions/delete_places.php";
$config = include "../../config.php";
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = "SELECT * FROM destinos";

$statement = $conexion->query($sql);

$resultados = $statement->fetchAll();
include "../parts/header.php";
?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <h2>Eliminar destino</h2>
        <label for="cod_destino">Codigo destino</label>
        <input type="text" name="cod_destino" id="cod_destino">
        <input type="submit" name="submit" class="submit" id="submit" value="Enviar">
        <?php
        echo "<table>";
        echo "<tr>";
            echo "<th>Codigo destino</th>";
            echo "<th>Origen</th>";
            echo "<th>Destino</th>";
            echo "<th>Fecha llegada</th>";
            echo "<th>Fecha salida</th>";
        echo "</tr>";
        foreach($resultados as $fila) {
     
            echo "<tr>";
                echo "<td>".$fila["cod_Destino"]."</td>";
                echo "<td>".$fila["Origen"]."</td>";
                echo "<td>".$fila["Destino"]."</td>";
                echo "<td>".$fila["Fecha_llegada"]."</td>";
                echo "<td>".$fila["Fecha_salida"]."</td>";
          echo "</tr>";
        }
        echo "</table>";
    ?>
    </form>

<?php
include "../parts/footer.php";
?>