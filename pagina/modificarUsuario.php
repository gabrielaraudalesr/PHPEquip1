<!DOCTYPE html>
<html lang="es" id="paginaHTML">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloPrincipal.css">
    <script src="./js/script.js"></script>
    <script src="./js/principal.js"></script>
    <title>Administrador</title>
</head>
<?php
session_start();
$user=isset($_SESSION['user']) ? $_SESSION['user'] : '';
$nombre=isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$apellido=isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '';
$poblacion=isset($_SESSION['poblacion']) ? $_SESSION['poblacion'] : '';
$telefono=isset($_SESSION['telefono']) ? $_SESSION['telefono'] : '';
$fechaNacimiento=isset($_SESSION['fechaNacimiento']) ? $_SESSION['fechaNacimiento'] : '';
$correo=isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
unset($_SESSION['user']);
unset($_SESSION['nombre']);
unset($_SESSION['apellido']);
unset($_SESSION['poblacion']);
unset($_SESSION['telefono']);
unset($_SESSION['fechaNacimiento']);
unset($_SESSION['correo']);
?>
<body>
    <div id="page">
        <div id="formularioContenedor">
            <header>
                <h1>Modificar</h1>
            </header>
            <form action="./php/pagina.php" method="post" id="formulario">
                <input type="hidden" name="formulario" value="modificar">
                <article class="datosPersonales">
                    <label for="usuario">Usuario: </label>
                    <label for="correo">Correo: </label>
                </article>
                <article class="datosPersonales">
                    <input type="text" id="user" name="usuario" value="<?php echo htmlspecialchars($user); ?>" required placeholder="Usuario:">
                    <input type="text" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>" required placeholder="Correo:">
            </article>
                <article class="datosPersonales">
                    <label for="nombre">Nombre: </label>
                    <label for="apellido">Apellido: </label>
                </article>
                <article class="datosPersonales"> 
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required placeholder="Nombre:">
                    <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" required placeholder="Apellidos:">
                </article>
                <label for="contraseña">Contraseña: </label>
                <input type="password" id="pass" name="contrasena" required placeholder="Contraseña:">
                <label for="contraseña2">Confirma Contraseña: </label>
                <input type="password" id="pass2" required placeholder="Contraseña:">
                <label for="poblacion">Poblacion: </label>
                <input type="text" id="poblacion" name="poblacion" value="<?php echo htmlspecialchars($poblacion); ?>" required placeholder="Poblacion:">
                <label for="telefono">Telefono movil: </label>
                <input type="number" id="telefono" name="telefono"  value="<?php echo htmlspecialchars($telefono); ?>" required placeholder="Telefono:">
                <label for="fecha">Fecha de nacimiento: </label>
                <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fechaNacimiento); ?>" required>
                <label for="perfil">Imagen de perfil: </label>
                <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg, image/jpg">
                <article class="botones">
                    <button type="submit" id="enviar" class="btn">Enviar</button>
                    <button type="reset" id="borrar" class="btn">Borrar</button>
                </article>

            </form>

        </div>
    </div>
</body>

</html>