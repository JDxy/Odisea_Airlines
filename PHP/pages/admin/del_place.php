<?php 
include "../../functions/create_places.php";
$config = include "../../../config.php";
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = "SELECT * FROM destinos_y_vuelos";

$statement = $conexion->query($sql);

$resultados = $statement->fetchAll();
include "../../parts/header.php";
?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="cod_destino">Codigo destino</label>
        <input type="text" name="cod_destino" id="cod_destino">
        <?php
        echo "<table>";
        echo "<tr>";
        echo "<th>IdVuelos</th>";
        echo "<th>Cod_destino</th>";
        echo "</tr>";
        foreach($resultados as $fila) {

          echo "<tr>";
            echo "<td>".$fila["IdVuelos"]."</td>";
            echo "<td>".$fila["cod_Destino"]."</td>";
          echo "</tr>";
        }
        echo "</table>";
    ?>
    </form>

<?php
include "../../parts/footer.php";
?>