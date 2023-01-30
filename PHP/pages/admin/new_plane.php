<?php 
include "../../functions/create_plane.php";
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
        <input type="text" name="matricula" id="matricula">
        <label for="años_servicio">Años de servicio</label>
        <input type="number" name="años_servicio" id="años_servicio">
        <label for="ultimo_mantenimiento">Ultimo mantenimiento</label>
        <input type="date" name="ultimo_mantenimiento" id="ultimo_mantenimiento">
        <label for="cantidad_total_pasajeros">Cantidad total de pasajeros</label>
        <input type="number" name="cantidad_total_pasajeros" id="cantidad_total_pasajeros"> 
        <label for="cantidad_disponible_pasajeros">Cantidad disponible de pasajeros</label>
        <input type="number" name="cantidad_disponible_pasajeros" id="cantidad_disponible_pasajeros"> 
        <label for="estado">Estado</label>
        <select name="estado" id="estado">
            <option value="False">En mantenimiento</option>
            <option value="True">Disponible</option>
        </select>

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
        <input type="submit" name="submit" id="submit" value="Enviar">
    </form>

<?php
include "../../parts/footer.php";
?>