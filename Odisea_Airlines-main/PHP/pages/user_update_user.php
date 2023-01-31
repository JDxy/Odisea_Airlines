<?php 
include "../functions/update_client.php";
include "../functions/delete_flight.php";

$config = include "../../config.php";
$dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
$conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


$sql = 'SELECT 
  Clientes.Dni,
  Clientes.Nombre,
  Clientes.Apellidos,
  Datos_Clientes.NumeroTelefono,
  Datos_Clientes.Contrasena,
  Datos_Clientes.Email
FROM 
  Clientes
  JOIN Datos_Clientes_Y_Clientes ON Clientes.Dni = Datos_Clientes_Y_Clientes.Dni_cliente
  JOIN Datos_Clientes ON Datos_Clientes_Y_Clientes.cod_datos_cliente = Datos_Clientes.cod_datos_cliente
WHERE 
  Clientes.Dni = "'.$_COOKIE["usuario"].'"';

$statement = $conexion->query($sql);

$resultados_usuarios = $statement->fetchAll();


$sql = 'SELECT * FROM destinos, vuelos V where V.dni_cliente = "'.$_COOKIE["usuario"].'"';

$statement = $conexion->query($sql);

$resultados_vuelos = $statement->fetchAll();


include "../parts/header.php";
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
            foreach($resultados_usuarios as $fila) {
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
        <?php
            echo "<table>";
            echo "<tr>";
            echo "<th>Cod Destino</th>";
            echo "<th>Destino</th>";
            echo "<th>Origen</th>";
            echo "<th>Fecha llegada</th>";
            echo "<th>Fecha salida</th>";
            echo "<th>Precio</th>";
            echo "<th>Borrar</th>";
            echo "</tr>";
            foreach($resultados_vuelos as $fila) {
            echo "<tr>";
            
                echo "<td>".$fila["cod_Destino"]."</td>";
                echo "<td>".$fila["Destino"]."</td>";
                echo "<td>".$fila["Origen"]."</td>";
                echo "<td>".$fila["Fecha_llegada"]."</td>";
                echo "<td>".$fila["Fecha_salida"]."</td>";
                echo "<td>".$fila["Precio"]."</td>";

                echo "<td>".'<input type="submit" class="submit del" id="otroInput" name="Idvuelo" value="'.$fila["IdVuelos"].'">'."</td>";

            echo "</tr>";
            
            }
          




            echo "</table>";
        ?>

        <input type="submit" class="submit" name="submit" value="enviar">
    </form>


<?php
include "../parts/footer.php";
?>