<?php 
include './datos.php';

//Funcion que comprueba que el usuario y contraseña están correctamente
function comprobarLogin($user, $contrasena){
    $conexion=conectarBD();
    if (strpos($user, '@') === TRUE) {
        $consulta="SELECT Correo, Contrasena FROM usuarios";
        $resultado=mysqli_query($conexion,$consulta);

        while ($fila=mysqli_fetch_array($resultado)) {
            if ($user == $fila['Correo']) {
                if (password_verify($contrasena, $fila['Contrasena'])) {
                header("Location: ../principal.html");
                } else {
                    session_start();
                    $_SESSION['user_temp'] = isset($_POST['user']) ? $_POST['user'] : '';
                    $_SESSION['error']="Usuario o contraseña incorrectos";
                    header("Location: ../login.php");                    
                }
            } else {
                session_start();
                $_SESSION['user_temp'] = isset($_POST['user']) ? $_POST['user'] : '';
                $_SESSION['error']="Usuario o contraseña incorrectos";
                header("Location: ../login.php");                
            }
        }
    } else {
        $consulta="SELECT nombreUsuario, Contrasena FROM usuarios";
        $resultado=mysqli_query($conexion,$consulta);

        while ($fila=mysqli_fetch_array($resultado)) {
            if ($user == $fila['nombreUsuario']) {
                if (password_verify($contrasena, $fila['Contrasena'])) {
                header("Location: ../principal.html");

                } else {
                    session_start();
                    $_SESSION['user_temp'] = isset($_POST['user']) ? $_POST['user'] : '';
                    $_SESSION['error']="Usuario o contraseña incorrectos";
                    header("Location: ../login.php");
                    
                }
            } else {
                session_start();
                $_SESSION['user_temp'] = isset($_POST['user']) ? $_POST['user'] : '';
                $_SESSION['error']="Usuario o contraseña incorrectos";
                header("Location: ../login.php");
                
            }
        }
    }
    
    
    mysqli_close($conexion);
}
//Funcion usada para hacer una lista de los usuarios de la base de datos
function listarUsuarios(){
    
    $conexion=conectarBD();
    
    $consulta="SELECT `IDUsuario`,`nombreUsuario`,`Nombre`,`Apellido`,`Contrasena`,`Poblacion`,DATE_FORMAT(`FechaNacimiento`, '%d-%m-%Y') 'FechaNacimiento',`Correo`,`ImagenPerfil` FROM usuarios";
    $resultado=mysqli_query($conexion,$consulta);
    
    
        $lista="<table border=1 style='border-collapse: collapse;'><thead><tr><th>ID Usuario</th><th>NombreUsuario</th><th>Nombre</th><th>Apellido</th><th>Contraseña</th><th>Poblacion</th><th>Fecha Nacimiento</th><th>Correo</th><th>Imagen de Perfil</th></tr></thead><tbody>";
        while($fila=mysqli_fetch_array($resultado)){            

            $id=$fila["IDUsuario"];
            $user=$fila["nombreUsuario"];
            $nombre=$fila["Nombre"];
            $apellido=$fila["Apellido"];
            $contrasena=$fila["Contrasena"];
            $poblacion=$fila["Poblacion"];
            $fechaNacimiento=$fila["FechaNacimiento"];
            $correo=$fila["Correo"];
            $imagenPerfil=$fila["ImagenPerfil"];
            $imagenPerfil='<img src="data:image/jpeg;base64,'.base64_encode($imagenPerfil) .'" style="width: 15%;height:15%;"/>';
            
        $lista .= "<tr><td>" . $id . "</td><td>" . $user . "</td><td>" . $nombre . "</td><td>" . $apellido . "</td><td>" . $contrasena . "</td><td>" . $poblacion . "</td><td>" . $fechaNacimiento . "</td><td>" . $correo . "</td><td>" . $imagenPerfil . "</td></tr>"; 
            
        }
        $lista.="</tbody></table>";
        
        return $lista;
        
    
    

    //cierra la conexion con la base de datos al finalizar la ejecucion para prevenir los problemas de recursos
    mysqli_close($conexion);
}
//Funcion que añade usuarios a la base de datos
function agregarUsuario($nombreUsuario, $nombre, $apellido, $contrasena, $poblacion, $fechaNacimiento, $correo, $imagenPerfil){
    $conexion=conectarBD();
    $contrasena=encriptar($contrasena);
    $consulta= "INSERT INTO usuarios (nombreUsuario, Nombre, Apellido, Contrasena, Poblacion, FechaNacimiento, Correo, ImagenPerfil) VALUES ('$nombreUsuario', '$nombre', '$apellido', '$contrasena', '$poblacion', '$fechaNacimiento', '$correo', '$imagenPerfil');";
    if (mysqli_query($conexion, $consulta) === TRUE) {
        //print "<p>Persona registrada correctamente</p>";
    } else {
        //print "<p>Persona registrada incorrectamente</p>";
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

function modificarUsuario($nombreUsuario){
    $conexion=conectarBD();    
    $consulta="SELECT * FROM usuarios WHERE Nombre='$nombreUsuario';";
    $resultado=mysqli_query($conexion, $consulta);
    while($fila=mysqli_fetch_array($resultado)){
            $user=$fila["nombreUsuario"];
            $nombre=$fila["Nombre"];
            $apellido=$fila["Apellido"];
            $contrasena=$fila["Contrasena"];
            $poblacion=$fila["Poblacion"];
            $poblacion=$fila[""];
            $fechaNacimiento=$fila["FechaNacimiento"];
            $correo=$fila["Correo"];
            $imagenPerfil=$fila["ImagenPerfil"];
    }
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
    $_SESSION['contrasena'] = $contrasena;
    $_SESSION['poblacion'] = $poblacion;
    $_SESSION['telefono'] = $telefono;
    $_SESSION['fechaNacimiento'] = $fechaNacimiento;
    $_SESSION['correo'] = $correo;
    $_SESSION['imagenPerfil'] = $imagenPerfil;
    //print "$user, $nombre, $apellido, $contrasena, $poblacion, $fechaNacimiento, $correo";
}


function crearBackup(){
    global $host, $usuario, $pass, $bd;
    $fechaHora=date('d-M-Y_H-i-s');
    $ficheroBackup= '../CopiasSeguridad' . $bd . '_' . $fechaHora . '.sql';
    $logFile = '../CopiasSeguridad' . $bd . '_backup_error.log';
    $comando = "mysqldump --host='$host' --user='$usuario' --password='$pass' '$bd' > '$ficheroBackup'";
    exec($comando, $salida, $resultado);
    if ($resultado === 0) {
        print "ta bien";
        //echo "<script>alert('Copia de seguridad hecha correctamente');
        //window.onclose = window.location.href = '../principal.html';</script>";
    } else {
        print "no ta bien";
        
        //echo "<script>alert('La copia de seguridad ha fallado');
        //window.onclose = window.location.href = '../principal.html';</script>";
        
    }

    
}




?>
