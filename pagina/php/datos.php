<?php

$host = "localhost";
$usuario = "root";
$pass="";
$bd = "streameclipse";
$port = 3306;

//Metodo que establece la conexion con la base de datos, usada cada vez que se ejecute una funcion que requiera una conexion con la misma y cerrandose al finalizar la ejecucion de la funcion
function conectarBD() {
    global $host, $usuario, $pass, $bd, $port;
    $conexion = mysqli_connect($host,$usuario,$pass,$bd,$port);

    // Verificar conexión
    if (!$conexion) {
        //echo "<p>Conexion fallida</p> <br>";
    } else {
        //echo "<p>Conexion correcta</p> <br>";
    }

    return $conexion;
}

?>
