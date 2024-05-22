<?php
include 'funciones.php';




//Comprueba que el método es el adecuado
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER["REQUEST_METHOD"] == 'POST'){

    //Comprueba cual de los formularios es el que ha enviado datos mediante un campo oculto 'hidden'
    $formulario=$_POST['formulario'];
    switch ($formulario) {
        case 'registro':

            //almacena los datos del formulario en variables
            $correo=$_POST['correo'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $contrasena=$_POST['contrasena'];
            $poblacion=$_POST['poblacion'];
            $fechaNacimiento=$_POST['fecha'];
            //llama a la funcion que añade un usuario a la base de datos
            agregarUsuario($nombre, $apellido, $contrasena, $poblacion, $fechaNacimiento, $correo);

            //Crea un botón que lleva a la pagina de login una vez se confirma el registro del usuario
            echo "<button onclick='volverAlLogin()'>Ir a la página de inicio de sesión</button>
            <script>
                function volverAlLogin() {
                    //Redireccionar a la página de inicio de sesión
                    window.location.href = '../login.html';
                }
            </script>";
            break;

        case 'login':

            $correo=$_POST['correo'];
            $contrasena=$_POST['contrasena'];
            comprobarLogin($correo, $contrasena);
            
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
            color: black;
            z-index: 2;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: bold;
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
        }
        table{
            justify-content: center;
        }
        ";
        echo "</style>";
        print "<p>Lista de Usuarios</p>";
        print listarUsuarios();

        break;

        case 'log';
            
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
                color: black;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-weight: bold;
            }
            p{
                font-size: 50px;
                text-align: center; 
                color: black;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-weight: bold;
            }
            thead{
                text-align:center;
            }
            tbody{
                text-align:center;
            }
            ";
            echo "</style>";
            print "<p>Log</p>";
            print mostrarLog();
            
            
        break;
        default:
            
            break;
    }
   
    
}











?>
