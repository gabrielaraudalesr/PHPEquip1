<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloPrincipal.css">
    <script src="./js/script.js"></script>
    <title>Administrador</title>
</head>
<?php
//Abre una sesion para poder usar variables de sesion
session_start();
$user = isset($_SESSION['user_temp']) ? $_SESSION['user_temp'] : '';
//recupera el mensaje de error de la variable de sesion
$error= isset($_SESSION['error']) ? $_SESSION['error'] : '';
// Elimina las variables de sesión para que no persistan después de la recarga de la paguna
unset($_SESSION['user_temp']);
unset($_SESSION['error']);
?>
<body>
    <div id="page">
        <div id="formularioContenedor">
            <h1>Inicio de sesión</h1>
            <form action="./php/pagina.php" method="post" id="formulario">
                <input type="hidden" name="formulario" value="login">
                <label for="usuario" >Usuario/Correo: </label>
                <input type="text" id="user" name="user" value="<?php echo htmlspecialchars($user); ?>" placeholder="Usuario">
                <label for="contraseña">Contraseña: </label>
                <input type="password" id="pass" name="contrasena" required placeholder="Contraseña">
                <label for="error" style="color: red;"><?php echo htmlspecialchars($error); ?></label>
                <article class="botones">
                    <button type="submit" id="enviarLogin" class="btn">Enviar</button>
                    <button onclick="window.location.href='registro.html'" id="volver" class="btn">Volver</button>
                </article>
            </form>

        </div>
    </div>
</body>

</html>