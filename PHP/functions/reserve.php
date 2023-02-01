<?php
/**
* Function reserve_flight
* This function reserves a flight for a client.
* It starts by including a config file to setup a database connection using PDO.
* Then, it queries the database to retrieve all flight matriculas and randomly selects one.
* It also fetches data from a submitted form, including the client's DNI and selected destination.
* The matricula, DNI, and destination are then inserted into the "vuelos" and "destinos_y_vuelos" tables, respectively.
* If an error occurs, it is caught and an error message is added to the result array.
* The function returns a success message if the flight reservation was successful.
* @author [Author Name]
* @return string Success message if the flight reservation was successful.
* @throws PDOException If there is an error connecting to the database.
* @var PDO $conexion Connection to the database.
* @var array $config Configuration array for the database connection.
* @var string $dsn Data source name for the database connection.
* @var string $dni DNI of the client.
* @var string $destino_seleccionado Selected destination of the client.
* @var string $consultaSQL SQL query for inserting data into the "vuelos" and "destinos_y_vuelos" tables.
* @var PDOStatement $sentencia Prepared statement for executing the insert queries.
* @var array $resultados Results of the flight matriculas query.
* @var string $rand_matricula Randomly selected matricula.
* @var string $matricula Matricula of the selected flight.
*/


function reserve_flight() {

    $resultado = [
        'error' => false,
        'mensaje' => 'Exito'
    ];

    $config = include "../../config.php";
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
        $consultaSQL = 'SELECT matricula from aviones';
        

        $statement = $conexion->query($consultaSQL);

        $resultados = $statement->fetchAll();
        $rand_matricula = $resultados[rand(0,count($resultados)-1)][0];
        // echo $resultado;
        $matricula = $rand_matricula;
        $dni = $_POST["dni"];

        $destino_seleccionado = $_POST["destino"];

        $consultaSQL = "INSERT INTO vuelos";
        $consultaSQL .= ' values (null,"'.$matricula.'","'.$dni.'")';
       
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();


        // 'SELECT v.Idvuelos '.$destino_seleccionado.' FROM vuelos v ORDER BY v.Idvuelos desc LIMIT 1'
        $consultaSQL = "INSERT INTO destinos_y_vuelos";
        $consultaSQL .= ' SELECT v.Idvuelos,"'.$destino_seleccionado.'" FROM vuelos v ORDER BY v.Idvuelos desc LIMIT 1';
        
   

        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();

    }catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}


if (isset($_POST['submit'])) {
    if (isset($_COOKIE["usuario"])){
        reserve_flight();
        echo "Vuelo reservado";
    }
    
}

?> 

