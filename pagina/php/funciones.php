<?php 
include 'datos.php';
include './PHPEquip1/';

//Funcion que comprueba que el usuario y contraseña están correctamente
function comprobarLogin($correo, $contrasena){
    $conexion=conectarBD();
    $consulta="SELECT Correo, Contrasena FROM usuarios";
    $resultado=mysqli_query($conexion,$consulta);

    while ($fila=mysqli_fetch_array($resultado)) {
        if ($correo == $fila['Correo']) {
            if (password_verify($contrasena, $fila['Contrasena'])) {
               print "Puta madre socio, tas dentro";
            }
        }
    }
    mysqli_close($conexion);
}
//Funcion usada para hacer una lista de los usuarios de la base de datos
function listarUsuarios(){
    
    $conexion=conectarBD();
    $consulta="SELECT * FROM Usuarios";
    $resultado=mysqli_query($conexion,$consulta);
    
    if (mysqli_num_rows($resultado) > 0) {
        $lista=array();
        while($fila=mysqli_fetch_assoc($resultado)){

            $lista[]=$fila;

            /*$id=$fila["IDUsuario"];
            $usuario=$fila["Usuario"];
            $nombre=$fila["Nombre"];
            $apellido=$fila["Apellido"];
            $contrasena=$fila["Contrasena"];
            $poblacion=$fila["Poblacion"];
            $fechaNacimiento=$fila["FechaNacimiento"];
            $correo=$fila["Correo"];
            $imagenPerfil=$fila["ImagenPerfil"];
            
        $lista += "<tr><td>" . $id . "</td><td>" . $usuario. "</td><td>" . $nombre . "</td><td>" . $apellido . "</td><td>" . $contrasena . "</td><td>" . $poblacion . "</td><td>" . $fechaNacimiento . "</td><td>" . $correo . "</td><td>" . $imagenPerfil . "</td></tr>"; 
            */
        }
        //$lista+="</table>";
        return $lista;
        
    }
    

    //cierra la conexion con la base de datos al finalizar la ejecucion para prevenir los problemas de recursos
    mysqli_close($conexion);
}
//Funcion que añade usuarios a la base de datos
function agregarUsuario($nombre, $apellido, $contrasena, $poblacion, $fechaNacimiento, $correo){
    $conexion=conectarBD();
    $contrasena=encriptar($contrasena);
    $consulta= "INSERT INTO usuarios (Nombre, Apellido, Contrasena, Poblacion, FechaNacimiento, Correo) VALUES ('$nombre', '$apellido', '$contrasena', '$poblacion', '$fechaNacimiento', '$correo');";
    if (mysqli_query($conexion, $consulta) === TRUE) {
        print "<p>Persona registrada correctamente</p>";
    } else {
        print "<p>Persona registrada incorrectamente</p>";
    }
    mysqli_close($conexion);
}
//Funcion que encripta la contraseña
function encriptar($password){

    return password_hash($password, 1);

}







?>