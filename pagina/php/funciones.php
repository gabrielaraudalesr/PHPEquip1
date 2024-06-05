<?php 
include './datos.php';

//Funcion que comprueba que el usuario y contraseña están correctamente
function comprobarLogin($user, $contrasena){
    $conexion=conectarBD();
    session_start();
    if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
        $consulta = "SELECT Administrador FROM usuarios WHERE Correo = '$user'";
        $resultado=mysqli_query($conexion, $consulta);
        while ($fila=mysqli_fetch_array($resultado)) {
            $esAdmin=$fila['Administrador'];
        }
        if ($esAdmin==1) {
            $consulta = "SELECT Correo, Contrasena FROM usuarios WHERE Correo = ?";        
        } else {
            $_SESSION['user_temp'] = isset($_POST['user']) ? $_POST['user'] : '';
            $_SESSION['error']="El usuario no tiene permisos de administrador";
            header("Location: ../login.php");
            exit();
        }
    }

    

    $stmt=mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 's', $user);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $dbUser, $dbPassword);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt)>0) {
        mysqli_stmt_fetch($stmt);
        if (password_verify($contrasena, $dbPassword)) {
            header("Location: ../principal.html");
            logAccesos($user);
            exit();
        }
    } else {
        $_SESSION['user_temp'] = isset($_POST['user']) ? $_POST['user'] : '';
        $_SESSION['error']="Usuario o contraseña incorrectos";
        header("Location: ../login.php");
        exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}

function logAccesos($user){
    $rutaLog="../Logs/log.txt";   
    $fechaHora=date('d-m-Y H:i:s');
    $mensaje="[$fechaHora] El usuario $user ha accedido a la página de administración. \n";
    
    $archivo= fopen($rutaLog, 'a');
    fwrite($archivo, $mensaje);
    fclose($archivo);
}


//Funcion usada para hacer una lista de los usuarios de la base de datos
function listarUsuarios(){
    
    $conexion=conectarBD();
    $consulta="SELECT `IDUsuario`,`nombreUsuario`,`Nombre`,`Apellido`,`Contrasena`,`Poblacion`,`Telefono`,DATE_FORMAT(`FechaNacimiento`, '%d-%m-%Y') 'FechaNacimiento',`Correo`,`ImagenPerfil` FROM usuarios";
    $resultado=mysqli_query($conexion,$consulta);
    
    
        $lista="<table border=1 style='border-collapse: collapse;'><thead><tr><th>ID Usuario</th><th>NombreUsuario</th><th>Nombre</th><th>Apellido</th><th>Contraseña</th><th>Poblacion</th><th>Telefono</th><th>Fecha Nacimiento</th><th>Correo</th><th>Imagen de Perfil</th></tr></thead><tbody>";
        while($fila=mysqli_fetch_array($resultado)){            

            $id=$fila["IDUsuario"];
            $user=$fila["nombreUsuario"];
            $nombre=$fila["Nombre"];
            $apellido=$fila["Apellido"];
            $contrasena=$fila["Contrasena"];
            $poblacion=$fila["Poblacion"];
            $telefono=$fila["Telefono"];
            $fechaNacimiento=$fila["FechaNacimiento"];
            $correo=$fila["Correo"];
            $imagenData=$fila["ImagenPerfil"];
            
            $imagenPerfil='<img src="data:image/png;base64,'. base64_encode($imagenData) .'", "data:image/jpeg;base64,'. base64_encode($imagenData) .'", "data:image/jpg;base64,'. base64_encode($imagenData) . '" style="width: 20%; height:20%;"/>';
            
        $lista .= "<tr><td>" . $id . "</td><td>" . $user . "</td><td>" . $nombre . "</td><td>" . $apellido . "</td><td>" . $contrasena . "</td><td>" . $poblacion . "</td><td>" . $telefono . "</td><td>" . $fechaNacimiento . "</td><td>" . $correo . "</td><td>" . $imagenPerfil . "</td></tr>"; 
            
        }
        $lista.="</tbody></table>";
        
        return $lista;
        
    
    

    //cierra la conexion con la base de datos al finalizar la ejecucion para prevenir los problemas de recursos
    mysqli_close($conexion);
}
//Funcion que añade usuarios a la base de datos
function agregarUsuario($nombreUsuario, $nombre, $apellido, $contrasena, $poblacion, $telefono, $fechaNacimiento, $correo, $imagenPerfil){
    $conexion=conectarBD();
    $contrasena=encriptar($contrasena);
    
    $consulta="INSERT INTO usuarios (nombreUsuario, Nombre, Apellido, Contrasena, Poblacion, Telefono, FechaNacimiento, Correo, ImagenPerfil) VALUES (?, ?, ?, ? ,? ,? ,? ,? ,?);";
    $stmt=mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "sssssssss", $nombreUsuario, $nombre, $apellido, $contrasena, $poblacion, $telefono, $fechaNacimiento, $correo, $imagenPerfil);
    
    if (mysqli_stmt_execute($stmt) === TRUE) {
        logCrearUsuario($nombreUsuario, $correo);
        echo "<script>window.location.replace('./principal.html')</script>";
    } else {
        //print "<p>Persona registrada incorrectamente</p>";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}


function logCrearUsuario($nombreUsuario, $correo){
    $rutaLog="../Logs/log.txt";   
    $fechaHora=date('d-m-Y H:i:s');
    $mensaje="[$fechaHora] Se ha añadido al usuario con correo: $correo y nombre de usuario: $nombreUsuario. \n";    
    $archivo= fopen($rutaLog, 'a');
    fwrite($archivo, $mensaje);
    fclose($archivo);
}


//Funcion que encripta la contraseña
function encriptar($password){

    return password_hash($password, 1);

}


function mostrarLog(){
    
    $archivo=fopen("../Logs/log.txt", 'r');

    $tabla="<table border=1 style='border-collapse: collapse;'><thead><tr><th>#</th><th>Mensaje</th></thead><tbody>";
        $lineaNumero=1;
        while (($linea = fgets($archivo)) !== false) {
            $tabla .= "<tr><td>" . $lineaNumero . "</td><td>" . $linea . "</td></tbody>";
            $lineaNumero++;
        }
        fclose($archivo);

            
        
    
    $tabla .= "</table>";

    return $tabla;

        
    
    
}


function eliminarUsuario($nombreUsuario){
    $conexion=conectarBD();    
    $consulta="DELETE FROM usuarios WHERE Correo=?;";
    $stmt=mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $nombreUsuario);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt)>0) {
        logEliminarUsuario($nombreUsuario);
        return TRUE;
    } else {
        return FALSE;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}

function logEliminarUsuario($correo){
    $rutaLog="../Logs/log.txt";   
    $fechaHora=date('d-m-Y H:i:s');
    $mensaje="[$fechaHora] Se ha eliminado al usuario con correo: $correo. \n";
    $archivo= fopen($rutaLog, 'a');
    fwrite($archivo, $mensaje);
    fclose($archivo);
}

function modificarUsuario($nombreUsuario){
    $conexion=conectarBD();    
    $consulta="SELECT * FROM usuarios WHERE Nombre='$nombreUsuario';";
    $resultado=mysqli_query($conexion, $consulta);
    while($fila=mysqli_fetch_array($resultado)){
        $user=$fila["nombreUsuario"];
        $nombre=$fila["Nombre"];
        $apellido=$fila["Apellido"];
        $poblacion=$fila["Poblacion"];
        $telefono=$fila["Telefono"];
        $fechaNacimiento=$fila["FechaNacimiento"];
        $correo=$fila["Correo"];
        $imagenPerfil=$fila["ImagenPerfil"];
    }
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;
    $_SESSION['poblacion'] = $poblacion;
    $_SESSION['telefono'] = $telefono;  
    $_SESSION['fechaNacimiento'] = $fechaNacimiento;
    $_SESSION['correo'] = $correo;
    $_SESSION['imagenPerfil'] = $imagenPerfil;
}

function modificarUsuario2($user, $nombre, $apellido, $contrasena, $poblacion, $telefono, $fechaNacimiento, $correo, $imagenPerfil, $admin){
    $conexion=conectarBD();
    $pass=encriptar($contrasena);
    
    $consulta="UPDATE `usuarios` SET `nombreUsuario`=?,`Nombre`=?,`Apellido`=?,`Contrasena`=?,`Poblacion`=?,`Telefono`=?,`FechaNacimiento`=?,`ImagenPerfil`=?,`Administrador`=? WHERE `Correo`=?;";
    $stmt=mysqli_prepare($conexion, $consulta); 
    mysqli_stmt_bind_param($stmt, "ssssssssss", $user, $nombre, $apellido, $pass, $poblacion, $telefono, $fechaNacimiento, $imagenPerfil, $admin, $correo);
    
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt)>0) {
        logModificarUsuario($correo);
        return TRUE;
    } else {
        return FALSE;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}

function logModificarUsuario($correo){
    $rutaLog="../Logs/log.txt";   
    $fechaHora=date('d-m-Y H:i:s');
    $mensaje="[$fechaHora] Se han modificado los datos del usuario con correo: $correo. \n";
    $archivo= fopen($rutaLog, 'a');
    fwrite($archivo, $mensaje);
    fclose($archivo);
}

function crearBackup(){
    global $host, $usuario, $pass, $bd;
    $ficheroBackup= '../CopiasSeguridad/' . $bd . '.sql';
    $comando = "mysqldump --host=$host --user=$usuario --password=$pass $bd > $ficheroBackup";    
    
    if (!system($comando)) {
        echo "<script>alert('Copia de seguridad hecha correctamente');
        window.onclose = window.location.href = '../principal.html';</script>";
    } else {
        echo "<script>alert('La copia de seguridad ha fallado');
        window.onclose = window.location.href = '../principal.html';</script>";
        
    }
}

function restaurarBD(){
    global $host, $usuario, $pass, $bd;

    $archivoBackup='../CopiasSeguridad/' . $bd . '.sql';

    $comando = "mysql --host=$host --user=$usuario --password=$pass $bd < $archivoBackup"; 

    if (!system($comando)) {
        echo "<script>alert('Restauración completada');
        window.onclose = window.location.href = '../principal.html';</script>";
    } else {
        echo "<script>alert('La restauracion ha fallado');
        window.onclose = window.location.href = '../principal.html';</script>";
    }

}






?>
