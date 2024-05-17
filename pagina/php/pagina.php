<?php
include 'funciones.php';

comprobarConexion($conexion);
//Comprueba que el método es el adecuado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //almacena los datos del formulario en variables
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $contrasena=$_POST['contrasena'];
    $poblacion=$_POST['poblacion'];
    $fechaNacimiento=$_POST['fecha'];
    //llama a la funcion que añade un usuario a la base de datos
    agregarUsuario($conexion, $nombre, $apellido, $contrasena, $poblacion, $fechaNacimiento);

    //Crea un botón que lleva a la pagina de login una vez se confirma el registro del usuario
    echo "<button onclick='volverAlLogin()'>Ir a la página de inicio de sesión</button>
    <script>
        function volverAlLogin() {
            // Redireccionar a la página de inicio de sesión
            window.location.href = '../login.html';
        }
    </script>";
    
}











?>
