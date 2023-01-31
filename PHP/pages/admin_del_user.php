<?php 
include "../functions/delete_client.php";

$config = include "../../config.php";
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = "SELECT * FROM clientes";

$statement = $conexion->query($sql);

$resultados = $statement->fetchAll();

include "../parts/header.php";
?>


    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="dni">DNI</label>
        <input type="text" name="dni" id="dni" require>
        <input type="submit" class="submit" name="submit" id="submit" value="Enviar">
        <?php
        echo "<table>";
        echo "<tr>";
        echo "<th>Dni</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellidos</th>";
        echo "</tr>";
        foreach($resultados as $fila) {
            
          echo "<tr>";
            echo "<td>".$fila["Dni"]."</td>";
            echo "<td>".$fila["Nombre"]."</td>";
            echo "<td>".$fila["Apellidos"]."</td>";
          echo "</tr>";
        }
        echo "</table>";
    ?>
    </form>

<?php
include "../parts/footer.php";
?>