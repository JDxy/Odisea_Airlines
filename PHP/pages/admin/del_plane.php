<?php 
include "../../functions/delete_plane.php";

$config = include "../../../config.php";
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = "SELECT * FROM estado_aviones_y_aviones";

$statement = $conexion->query($sql);

$resultados = $statement->fetchAll();

include "../../parts/header.php";
?>


    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="matricula">Matricula</label>
        <input type="text" name="matricula" id="matricula" require>
        <input type="submit" name="submit" id="submit" value="Enviar">
        <?php
        echo "<table>";
        echo "<tr>";
        echo "<th>Cod estado avion</th>";
        echo "<th>Matricula avion</th>";
        echo "</tr>";
        foreach($resultados as $fila) {
     
            echo "<tr>";
                echo "<td>".$fila["cod_estado_avion"]."</td>";
                echo "<td>".$fila["Matricula_avion"]."</td>";
            
            echo "</tr>";
        }
        echo "</table>";
    ?>
    </form>

<?php
include "../../parts/footer.php";
?>