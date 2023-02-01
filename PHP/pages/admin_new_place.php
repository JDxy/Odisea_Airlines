<?php 
include "../functions/create_places.php";
$config = include "../../config.php";
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = "SELECT * FROM destinos";

$statement = $conexion->query($sql);

$resultados = $statement->fetchAll();
include "../parts/header.php";
?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <h2>Nuevo destino</h2>
        <label for="origen">Origen</label>
        <input type="text" name="origen" id="origen">
        <label for="destino">destino</label>
        <input type="text" name="destino" id="destino">
        <label for="fecha_llegada">Fecha llegada</label>
        <input type="date" name="fecha_llegada" id="fecha_llegada">
        <label for="fecha_salida">Fecha salida</label>
        <input type="date" name="fecha_salida" id="fecha_salida"> 
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio"> 
        <input type="submit" class="submit" name="submit" id="submit" value="Enviar">
        <?php
        echo "<table>";
        echo "<tr>";
            echo "<th>Origen</th>";
            echo "<th>Destino</th>";
            echo "<th>Fecha llegada</th>";
            echo "<th>Fecha salida</th>";
            echo "<th>Precio</th>";
        echo "</tr>";
        foreach($resultados as $fila) {
     
            echo "<tr>";
                echo "<td>".$fila["Origen"]."</td>";
                echo "<td>".$fila["Destino"]."</td>";
                echo "<td>".$fila["Fecha_llegada"]."</td>";
                echo "<td>".$fila["Fecha_salida"]."</td>";
                echo "<td>".$fila["Precio"]."</td>";
          echo "</tr>";
        }
        echo "</table>";
    ?>
    </form>

<?php
include "../parts/footer.php";
?>