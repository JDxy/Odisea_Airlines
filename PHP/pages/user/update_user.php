<?php 
include "../../functions/update_client.php";

$config = include "../../../config.php";
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = 'SELECT * FROM clientes,datos_clientes WHERE dni = "'.$_COOKIE["usuario"].'"';

$statement = $conexion->query($sql);

$resultados = $statement->fetchAll();

include "../../parts/header.php";
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

        <input type="hidden" name="dni" id="dni" value="<?php echo $_COOKIE["usuario"] ?>">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos">
        <label for="numero_telefono">Numero de telefono</label>
        <input type="text" name="numerotelefono" id="numerotelefono">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"> 
        <label for="contraseña">Contraseña</label>
        <input type="text" name="contraseña" id="contraseña">
        <?php
            echo "<table>";
            echo "<tr>";
            echo "<th>Dni</th>";
            echo "<th>Nombre</th>";
            echo "<th>Apellidos</th>";
            echo "<th>Numero de telefono</th>";
            echo "<th>Email</th>";
            echo "<th>Contraseña</th>";
            echo "</tr>";
            foreach($resultados as $fila) {
                
            echo "<tr>";
                echo "<td>".$fila["Dni"]."</td>";
                echo "<td>".$fila["Nombre"]."</td>";
                echo "<td>".$fila["Apellidos"]."</td>";
                echo "<td>".$fila["NumeroTelefono"]."</td>";
                echo "<td>".$fila["Email"]."</td>";
                echo "<td>".$fila["Contrasena"]."</td>";
            echo "</tr>";
            }
            echo "</table>";
        ?>
        <input type="submit" class="submit" name="submit" value="enviar">
    </form>


<?php
include "../../parts/footer.php";
?>