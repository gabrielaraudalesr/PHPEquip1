<?php 
include 'datos.php';
//Establece la conexion con la base de datos
$conexion = mysqli_connect($host,$usuario,$pass,$bd,$port);

function comprobarConexion($conexion){
    
    if (!$conexion) {
        echo "<p>Conexion fallida</p> <br>";
    } else {
        echo "<p>Conexion correcta</p> <br>";
    }

    
}
//Funcion usada para hacer una lista de los usuarios de la base de datos
function listarUsuario($conexion){
    $consulta="SELECT * FROM usuarios";
    $resultado=mysqli_query($conexion,$consulta);

    print "<table border>";
    while($fila=mysqli_fetch_array($resultado)){
        $id=$fila["ID_Usuario"];
        $nombre=$fila["Nombre"];
        $apellido=$fila["Apellido"];
        $contraseña=$fila["Contraseña"];
        $poblacion=$fila["Poblacion"];
        $fechaNacimiento=$fila["FechaNacimiento"];
        $correo=$fila["Correo"];
        $imagenPerfil=$fila["Imagen Perfil"];
        
        print "<tr><td>" . $id . "</td><td>" . $nombre . "</td><td>" . $apellido . "</td><td>" . $contraseña . "</td><td>" . $poblacion . "</td><td>" . $fechaNacimiento . "</td><td>" . $correo . "</td><td>" . $imagenPerfil . "</td></tr>"; 
        
    }
    print "</table>";
}
//Funcion que ñade usuarios a la base de datos
function agregarUsuario($conexion, $nombre, $apellido, $contraseña, $poblacion, $fechaNacimiento){
    $contraseña=encriptar($contraseña);
    $consulta= "INSERT INTO usuarios (Nombre, Apellido, Contraseña, Poblacion, FechaNacimiento, Correo) VALUES ('$nombre', '$apellido', '$contraseña', '$poblacion', '$fechaNacimiento', 'correo2');";
    if (mysqli_query($conexion, $consulta) === TRUE) {
        print "<p>Persona registrada correctamente</p>";
    } else {
        print "<p>Persona registrada incorrectamente</p>";
    }
}
//Funcion que encripta la contraseña
function encriptar($password){
    /*$iterations = 600;

    // Generate a cryptographically secure random salt using random_bytes()
    $salt = random_bytes(16);

    $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
    //var_dump($hash);
    return $hash;*/

    return password_hash($password, 1);
}







?>