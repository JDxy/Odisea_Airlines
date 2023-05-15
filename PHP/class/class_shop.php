<?php

class Shop{
    private $conn;
    function __construct(){
  
        // $config = include 'PHP/class/config.php';
        // $this->conn = new PDO('mysql:host='.$config['db']['host'],$config['db']['user'],$config['db']['pass'],$config['db']['options']);
        require_once 'config.php';
        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }

    public function login_admin($nombre, $password){
        try{
            $sql = $this->conn->prepare("SELECT * FROM ADMINISTRADORES WHERE nombre = '".$nombre."'");
            $sql->execute();
            $result = $sql->fetchAll();
            
            if (count($result) > 0 and $result[0]['CONTRASENA'] == $password){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        
    }

    public function delete_element($nombre, $where, $id){
        try{
            $consulta = "DELETE FROM ".$nombre." WHERE ".$where." = '".$id."';";
            
            
            $sql = $this->conn->prepare($consulta);
            $sql->execute();

        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
   
    }



    public function exist_element($nombre, $where, $id){
        try{

            
            $sql = $this->conn->prepare("SELECT id_".$where." FROM ".$nombre." WHERE id_".$where." = ".$id.";");
            // $sql = $this->conn->prepare("DELETE FROM ".$nombre." WHERE id_".$nombre." = ".$id.";");
            
            $sql->execute();
           
    
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);

            if ($result != []){
                return TRUE;
            }else{
                return FALSE;
            }



        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
   
    }

    public function exist_client($email, $contrasena){
        try{
            $consulta = "SELECT Correo_electronico_cliente, contrasena FROM cliente WHERE Correo_electronico_cliente = :email AND contrasena = :contrasena";
            $sql = $this->conn->prepare($consulta);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':contrasena', $contrasena);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if (!empty($result)){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function total_rows($nombre) {
        try {
            $consulta = "SELECT MAX(ID_" . $nombre . ") as max_id FROM " . $nombre;
            $sql = $this->conn->prepare($consulta);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result['max_id'];
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
      

    public function insert_value($nombre, $columns, $values){
        try{
                $consulta = "INSERT INTO ".$nombre." (".$columns.") VALUES (".$values.");";
                $sql = $this->conn->prepare($consulta);

                $sql->execute();
            
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function update_value($nombre, $columns_values, $where_clause){
        try{
            $consulta = "UPDATE ".$nombre." SET ".$columns_values." WHERE ".$where_clause.";";
            $sql = $this->conn->prepare($consulta);
            echo $consulta;
            $sql->execute();
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }    

    public function obtain_cost($id){
        try{
            $consulta = "SELECT CAST(Precio_unitario AS CHAR) AS Precio_unitario
                         FROM Precio
                         INNER JOIN Producto
                         ON Precio.ID_producto = Producto.ID_producto
                         WHERE Producto.id_producto = :id";
    
            $sql = $this->conn->prepare($consulta);
            $sql->bindParam(':id', $id);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return isset($result["Precio_unitario"]) ? $result["Precio_unitario"] : null;
    
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function show_table($nombre){
        try{
            $sql = $this->conn->prepare("SELECT * FROM ".$nombre.";");
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        
    }

    public function select_values($nombre, $columnas, $condiciones){
        try{
            $sql = "SELECT ".$columnas." FROM ".$nombre;
            if ($condiciones != 'null'){
                $sql .= " ".$condiciones;
            }

            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    
    
    function show_products($tipos_productos){
        $email = "";
        if(isset($_COOKIE['cliente'])) {
            $cliente = json_decode($_COOKIE['cliente'], true);
            $email = $cliente['email'];
        }
    
        $productos = $this->show_table("producto");
        
        foreach ($productos as $producto) {
            if ($producto['Tipo_producto'] == $tipos_productos) {
                $precio = $this->obtain_cost($producto["ID_producto"]);
                $descripcion = $this->select_values("marca", "Descripcion", "Where ID_producto = {$producto["ID_producto"]};");
                $cantidad = $this->select_values("precio", "Cantidad_disponible", "Where ID_producto = {$producto["ID_producto"]};");
                
          
                
                echo '<div class=" producto">';
                

                    echo '<img src="' . substr($producto['Img_producto'],3) . '" alt="">';
                    echo '<h3>' . $producto['Nombre_producto'] . '</h3>';
                    echo '<p> Precio: </p>';
                    echo '<p id="precio" name="'.$precio.'">' . $precio . '€</p>';
                    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                    echo '<input type="hidden" name="email" value="' . $email . '">';
                    echo '<input type="hidden" name="ID_producto" value="' . $producto['ID_producto'] . '">';
                    echo '<input type="hidden" name="Img_producto" value="' . $producto['Img_producto'] . '">';
                    echo '<input type="hidden" name="Nombre_producto" value="' . $producto['Nombre_producto'] . '">';
                    echo '<input type="hidden" name="precio" value="' . $precio . '">';
                    echo '<input type="submit" value="Añadir al carrito" name="add_trolley" class="myButton"></input>';
                    echo "</form>";
                    // echo  '<input type="submit" class="myButton" value="Ver mas" name="show_modal" id="abrir-modal"></input>';
                    echo '<button class="myButton" data-modal="modal'.$producto["ID_producto"].'">Ver mas</button>';

                echo '</div>';
                
                echo '

                <div id="modal'.$producto["ID_producto"].'" class="modal overlay">
                <div class="modal-content">
                    <span class="close">X</span>
                 
                        <ul>
                        <li><h2>'.$producto['Nombre_producto'].'</h2></li>
                        <li><img src="'.$producto['Img_producto'].'" alt=""></li>
                        <li>Precio: '.$precio.'€</li>
                  
                        <li>Cantidad disponible: 
                        '.$cantidad[0]["Cantidad_disponible"].'</li>
                     
                        <li>Descripcion:</li>
                        <li>'.$descripcion[0]["Descripcion"].'</li>
                        </ul>
                   
                </div>
                </div>
                ';   
       
            }
        }  
    }

    


}


?>




