<?php 
$config = include 'PHP/class/config.php';

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $sql = "CREATE TRIGGER disminuir_stock
            AFTER INSERT ON Pedido
            FOR EACH ROW
            BEGIN
              DECLARE stock_actual INT;
              SELECT Cantidad_disponible INTO stock_actual FROM Precio WHERE ID_producto = NEW.ID_producto;
              IF stock_actual >= NEW.Cantidad THEN
                UPDATE Precio SET Cantidad_disponible = stock_actual - NEW.Cantidad WHERE ID_producto = NEW.ID_producto;
              END IF;
            END";
    $conexion->exec($sql);
    echo "Success";
}catch(PDOException $error){
    echo $error->getMessage();
}
?>
