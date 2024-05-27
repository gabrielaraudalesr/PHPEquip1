<?php 
include 'datos.php';

//Funcion que comprueba que el usuario y contraseña están correctamente
function comprobarLogin($correo, $contrasena){
    $conexion=conectarBD();
    $consulta="SELECT Correo, Contrasena FROM usuarios";
    $resultado=mysqli_query($conexion,$consulta);

    while ($fila=mysqli_fetch_array($resultado)) {
        if ($correo == $fila['Correo']) {
            if (password_verify($contrasena, $fila['Contrasena'])) {
               header("Location: ../principal.html");
            } else {
                session_start();
                $_SESSION['correo_temp'] = isset($_POST['correo']) ? $_POST['correo'] : '';
                $_SESSION['error']="Usuario o contraseña incorrectos";
                header("Location: ../login.php");
                
            }
        } else {
            session_start();
            $_SESSION['correo_temp'] = isset($_POST['correo']) ? $_POST['correo'] : '';
            $_SESSION['error']="Usuario o contraseña incorrectos";
            header("Location: ../login.php");
            
        }
    }
    mysqli_close($conexion);
}
//Funcion usada para hacer una lista de los usuarios de la base de datos
function listarUsuarios(){
    
    $conexion=conectarBD();
    
    $consulta="SELECT `IDUsuario`,`Nombre`,`Apellido`,`Contrasena`,`Poblacion`,DATE_FORMAT(`FechaNacimiento`, '%d-%m-%Y') 'FechaNacimiento',`Correo`,`ImagenPerfil` FROM usuarios";
    $resultado=mysqli_query($conexion,$consulta);
    
    
        $lista="<table border=1 style='border-collapse: collapse;'><thead><tr><th>ID Usuario</th><th>Nombre</th><th>Apellido</th><th>Contraseña</th><th>Poblacion</th><th>Fecha Nacimiento</th><th>Correo</th></tr></thead><tbody>";
        while($fila=mysqli_fetch_array($resultado)){            

            $id=$fila["IDUsuario"];
            $nombre=$fila["Nombre"];
            $apellido=$fila["Apellido"];
            $contrasena=$fila["Contrasena"];
            $poblacion=$fila["Poblacion"];
            $fechaNacimiento=$fila["FechaNacimiento"];
            $correo=$fila["Correo"];
            $imagenPerfil=$fila["ImagenPerfil"];
            
        $lista .= "<tr><td>" . $id . "</td><td>" . $nombre . "</td><td>" . $apellido . "</td><td>" . $contrasena . "</td><td>" . $poblacion . "</td><td>" . $fechaNacimiento . "</td><td>" . $correo . "</td><td>" . $imagenPerfil . "</td></tr></tbody>"; 
            
        }
        $lista.="</table>";
        
        return $lista;
        
    
    

    //cierra la conexion con la base de datos al finalizar la ejecucion para prevenir los problemas de recursos
    mysqli_close($conexion);
}
//Funcion que añade usuarios a la base de datos
function agregarUsuario($nombre, $apellido, $contrasena, $poblacion, $fechaNacimiento, $correo, $imagenPerfil){
    $conexion=conectarBD();
    $contrasena=encriptar($contrasena);
    $consulta= "INSERT INTO usuarios (Nombre, Apellido, Contrasena, Poblacion, FechaNacimiento, Correo, ImagenPerfil) VALUES ('$nombre', '$apellido', '$contrasena', '$poblacion', '$fechaNacimiento', '$correo', '$imagenPerfil');";
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


function mostrarLog(){
    $conexion=conectarBD();
    $consulta="SELECT * FROM logs";
    $resultado=mysqli_query($conexion, $consulta);
    
    $tabla="<table border=1 style='border-collapse: collapse;'><thead><tr><th>ID</th><th>Accion</th><th>Fecha-Hora</th></thead><tbody>";
    while($fila=mysqli_fetch_array($resultado)){
        $id=$fila["Id"];
        $accion=$fila["Accion"];
        $fechaHora=$fila["Fecha-Hora"];
            
        $tabla .= "<tr><td>" . $id . "</td><td>" . $accion . "</td><td>" . $fechaHora . "</td></tr></tbody>";
    }
    $tabla .= "</table>";

    return $tabla;

        
    
    mysqli_close($conexion);
}


function eliminarUsuario($nombreUsuario){
    $conexion=conectarBD();    
    $consulta="DELETE FROM usuarios WHERE Nombre=?;";
    $stmt=mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $nombreUsuario);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt)>0) {
        return TRUE;
    } else {
        return FALSE;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}







?>