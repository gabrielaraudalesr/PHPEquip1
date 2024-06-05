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
    $conexion=conectarBD();
    $consulta="INSERT INTO logs (Accion, `Fecha-Hora`) VALUES (?, ?);";
    $stmt=mysqli_prepare($conexion, $consulta);
    $now=date('Y-m-d H:i:s');
    $accion="El usuario $user ha accedido a la página de administración";
    mysqli_stmt_bind_param($stmt, "ss", $accion, $now);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
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
    $conexion=conectarBD();
    $consulta="INSERT INTO logs (Accion, `Fecha-Hora`) VALUES (?, ?);";
    $stmt=mysqli_prepare($conexion, $consulta);
    $now=date('Y-m-d H:i:s');
    $accion="Se ha añadido al usuario con correo: $correo, nombre de usuario: $nombreUsuario";
    mysqli_stmt_bind_param($stmt, "ss", $accion, $now);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
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
    $conexion=conectarBD();
    $consulta="INSERT INTO logs (Accion, `Fecha-Hora`) VALUES (?, ?);";
    $stmt=mysqli_prepare($conexion, $consulta);
    $now=date('Y-m-d H:i:s');
    $accion="Se ha eliminado al usuario con correo: $correo";
    mysqli_stmt_bind_param($stmt, "ss", $accion, $now);
    mysqli_stmt_execute($stmt);
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

function modificarUsuario2($user, $nombre, $apellido, $contrasena, $poblacion, $telefono, $fechaNacimiento, $correo, $imagenPerfil){
    $conexion=conectarBD();
    $imagenPerfil=file_get_contents($imagenPerfil);
    $contrasena=encriptar($contrasena);
    $consulta="UPDATE `usuarios` SET `nombreUsuario`='$user',`Nombre`='$nombre',`Apellido`='$apellido',`Contrasena`='$contrasena',`Poblacion`='$poblacion',`Telefono`='$telefono',`FechaNacimiento`='$fechaNacimiento',`ImagenPerfil`='$imagenPerfil' WHERE `Correo`='$correo';";
    $stmt=mysqli_prepare($conexion, $consulta); 
    
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
    $conexion=conectarBD();
    $consulta="INSERT INTO logs (Accion, `Fecha-Hora`) VALUES (?, ?);";
    $stmt=mysqli_prepare($conexion, $consulta);
    $now=date('Y-m-d H:i:s');
    $accion="Se han modificado los datos del usuario con correo: $correo";
    mysqli_stmt_bind_param($stmt, "ss", $accion, $now);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
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
