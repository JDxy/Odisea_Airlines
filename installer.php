<?php 
    $config = include 'config.php';

    try {
        $conexion = new PDO('mysql:host='.$config['db']['host'],$config['db']['user'],$config['db']['pass'],$config['db']['options']);
        $sql = file_get_contents("data/db.sql");
        $conexion->exec($sql);
        echo "Success";
    }catch(PDOException $error){
        echo $error->getMessage();
    }
?>