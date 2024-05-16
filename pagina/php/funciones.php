<?php 
include 'datos.php';
$conexion = mysqli_connect($host,$usuario,$pass,$bd,$port);

function comprobarConexion($conexion){
    
    if (!$conexion) {
        echo "<p>Conexion fallida</p> <br>";
    } else {
        echo "<p>Conexion correcta</p> <br>";
    }

    
}

comprobarConexion($conexion);

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$contraseña=$_POST['contraseña'];
$poblacion=$_POST['poblacion'];
$fechaNacimiento=$_POST['fechaNacimiento'];

print $fechaNacimiento;

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
    
    print "<tr><td>" . $id . "</td><td>" . $nombre . "</td><td>" . $apellido . "</td><td>" . $contraseña . "</td><td>" . $poblacion . "</td><td>" . $fechaNacimiento . "</td><td>" . $correo . "</td><td>" . $imagenPerfil . "</td></tr>"; 
    
}
print "</table>";






?>