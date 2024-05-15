<?php

$host = "localhost";
$usuario = "root";
$pass="";
$bd = "proyectoaplicacioncliente";
$port = 3306;

$conexion = mysqli_connect($host,$usuario,$pass,$bd,$port);

$consulta="SELECT * FROM usuarios";
$resultado=mysqli_query($conexion,$consulta);

print "<table border>";
while($fila=mysqli_fetch_array($resultado)){
    $id=$fila["id"];
    $nombre=$fila["nombre"];
    $precio=$fila["precio"];
    $descripcion=$fila["descripcion"];
    
    print "<tr><td>" . $id . "</td><td>" . $nombre . "</td><td>" . $precio . "</td><td>" . $descripcion . "</td></tr>"; 
    
}
print "</table>";

?>
