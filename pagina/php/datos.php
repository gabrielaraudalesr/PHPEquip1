<?php

$host = "169.254.202.129";
$usuario = "root";
$pass="";
$bd = "proyectoaplicacioncliente";
$port = 3306;

$conexion = mysqli_connect($host,$usuario,$pass,$bd,$port);

$consulta="SELECT * FROM usuarios";
$resultado=mysqli_query($conexion,$consulta);

print "<table border>";
while($fila=mysqli_fetch_array($resultado)){
    $id=$fila["ID_Usuario"];
    $nombre=$fila["Nombre"];
    $apellido=$fila["Apellido"];
    $contraseña=$fila["Contraseña"];
    $poblacion=$fila["Poblacion"];
    $fechaNacimiento=$fila["Fecha Nacimiento"];
    $correo=$fila["Correo"];
    $imagenPerfil=$fila["Imagen Perfil"];
    
    print "<tr><td>" . $id . "</td><td>" . $nombre . "</td><td>" . $apellido . "</td><td>" . $descripcion . "</td></tr>"; 
    
}
print "</table>";

?>
