<?php
include 'funciones.php';




//Comprueba que el método es el adecuado
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] == 'POST'){

    //Comprueba cual de los formularios es el que ha enviado datos mediante un campo oculto 'hidden'
    $formulario=$_POST['formulario'];
    switch ($formulario) {
        case 'registro':

            //almacena los datos del formulario en variables
            $user=$_POST['usuario'];
            $correo=$_POST['correo'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $contrasena=$_POST['contrasena'];
            $poblacion=$_POST['poblacion'];
            $telefono=$_POST['telefono'];
            $fechaNacimiento=$_POST['fecha'];
            $imagen=$_FILES['imagen']['tmp_name'];
            $imagenPerfil=file_get_contents($imagen);
            //llama a la funcion que añade un usuario a la base de datos
            agregarUsuario($user, $nombre, $apellido, $contrasena, $poblacion, $telefono, $fechaNacimiento, $correo, $imagenPerfil);

            //Crea un botón que lleva a la pagina de login una vez se confirma el registro del usuario
            header("Location: ../principal.html");
            break;

        case 'login':

            $user=$_POST['user'];
            $contrasena=$_POST['contrasena'];
            comprobarLogin($user, $contrasena);
            
            break;
        

        case 'lista';
        echo "<style>
        html{
            width: 100%;
            height: 100%;
            background: rgb(54,79,107);
            background: radial-gradient(circle, rgba(54,79,107,1) 10%, rgba(59,147,163,1) 20%, rgba(63,193,201,1) 25%, rgba(54,79,107,1) 95%); 
            position: relative;      
            z-index: 1;
        }
        table{          
            position: absolute;            
            z-index: 2;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            
        }
        p{
            font-size: 50px;
            text-align: center; 
            color: black;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: bold;
        }
        thead, tbody{
            text-align:center;
            width:50%
        }
        thead{
            font-weight: bold;
            color:black;
        }
        tbody{
            color:white;
        }
        table{           
            width:99%;
        }
        ";
        echo "</style>";
        print "<p>Lista de Usuarios</p>";
        print listarUsuarios();

        break;

        case 'log';
            
            echo "<style>
            body{
                margin:0;
            }
            html{
                width: 100%;
                height: 100%;
                background: rgb(54,79,107);
                background: radial-gradient(circle, rgba(54,79,107,1) 10%, rgba(59,147,163,1) 20%, rgba(63,193,201,1) 25%, rgba(54,79,107,1) 95%); 
                position: relative;      
                z-index: 1;
                
            }
            table{          
                position: absolute;
                z-index: 2;
                margin: left 0;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                width:100%;
            }
            h1  {
                font-size: 50px;
                text-align: center; 
                color: #ecf0f1;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-weight: bold;
            }
            thead{
                text-align:center;
                color: black;
                font-weight: bold;
            }
            tbody{
                text-align:center;
                color: white;
            }
            ";
            echo "</style>";
            print "<h1>Log</h1>";
            print mostrarLog();
            
            
        break;

        case 'modificarUsuario':
            $nombreModificar=$_POST['nombreModificar'];
            modificarUsuario($nombreModificar);
            header("Location: ../modificarUsuario.php");
            break;

        case 'modificar':
            $user=$_POST['usuario'];
            $correo=$_POST['correo'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $contrasena=$_POST['contrasena'];
            $poblacion=$_POST['poblacion'];
            $telefono=$_POST['telefono'];
            $fechaNacimiento=$_POST['fecha'];
            $imagen=$_FILES['imagen']['tmp_name'];
            $imagenPerfil=file_get_contents($imagen);
            if ($_POST['admin'] == 'Sí') {
                $admin=1;
            } elseif ($_POST['admin'] == 'No') {
                $admin=0;
            }
            
            $resultado=modificarUsuario2($user, $nombre, $apellido, $contrasena, $poblacion, $telefono, $fechaNacimiento, $correo, $imagenPerfil, $admin);
            if ($resultado===TRUE) {
                echo "<script>alert('Usuario modificado correctamente');
                window.onclose = window.location.href = '../principal.html';</script>";
            } else  {
                echo "<script>alert('Error en la modificación');";
                //window.onclose = window.location.href = '../principal.html';</script>";
            }
            break;

        case 'eliminarUsuario':
            $nombreEliminar=$_POST['nombreEliminar'];
            $resultado=eliminarUsuario($nombreEliminar);

            if ($resultado === TRUE) {
                echo "<script>alert('Usuario borrado correctamente');
                window.onclose = window.location.href = '../principal.html';</script>";
            } else  {
                echo "<script>alert('ERROR, el usuario no existe');
                window.onclose = window.location.href = '../principal.html';</script>";
            }
            break;
        case 'copia':
            crearBackup();
            break;

        case 'restaurar':
            restaurarBD();
            break;
        default:
            
            break;
    }
   
    
}











?>
