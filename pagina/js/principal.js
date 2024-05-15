window.onload = function ocultar() {
    let div = document.getElementsByClassName("formulario");
    for (let i = 0; i < div.length; i++) {
        div[i].style.display = "none";
    }
};


const usuarios = [
    { nombre: "Juan Perez" },
    { nombre: "Maria Lopez" },
    { nombre: "Carlos Ruiz" },
    { nombre: "Ana Gomez" },
    { nombre: "Luis Martinez" }
]; // Simulación de base de datos

function mostrarFormulario(id) {
    // Ocultar todos los formularios
    document.querySelectorAll('.formulario').forEach(form => {
        form.style.display = 'none';
    });

    // Mostrar el formulario correspondiente
    document.getElementById(id).style.display = 'block';
}

function mostrarListaUsuarios() {
    const listaDiv = document.getElementById('listaUsuarios');
    const busquedaDiv = document.getElementById('busquedaUsuarios');

    // Mostrar área de búsqueda y lista de usuarios
    busquedaDiv.style.display = 'block';
    listaDiv.style.display = 'block';

    // Crear la lista de usuarios
    listaDiv.innerHTML = '';
    usuarios.forEach(usuario => {
        const userDiv = document.createElement('div');
        userDiv.textContent = usuario.nombre;
        listaDiv.appendChild(userDiv);
    });
}

function buscarUsuario() {
    const nombreBusqueda = document.getElementById('buscarNombre').value.toLowerCase();
    const listaDiv = document.getElementById('listaUsuarios');

    // Filtrar usuarios por nombre
    const usuariosFiltrados = usuarios.filter(usuario => 
        usuario.nombre.toLowerCase().includes(nombreBusqueda)
    );

    // Mostrar la lista de usuarios filtrados
    listaDiv.innerHTML = '';
    usuariosFiltrados.forEach(usuario => {
        const userDiv = document.createElement('div');
        userDiv.textContent = usuario.nombre;
        listaDiv.appendChild(userDiv);
    });
}

function crearBackup() {
    alert("Copia de seguridad creada con éxito.");
    // Aquí iría la lógica para crear una copia de seguridad
}

function restaurarBackup() {
    alert("Datos restaurados con éxito.");
    // Aquí iría la lógica para restaurar los datos desde una copia de seguridad
}

function mostrarLog() {
    // Simulación de un log de acciones
    const logs = [
        { accion: "Login", usuario: "Juan Perez", fecha: "2024-05-13 10:00" },
        { accion: "Creación de usuario", usuario: "Maria Lopez", fecha: "2024-05-13 11:00" },
        { accion: "Modificación de usuario", usuario: "Carlos Ruiz", fecha: "2024-05-13 12:00" }
    ];

    let logContent = '<table><tr><th>Acción</th><th>Usuario</th><th>Fecha</th></tr>';
    logs.forEach(log => {
        logContent += `<tr><td>${log.accion}</td><td>${log.usuario}</td><td>${log.fecha}</td></tr>`;
    });
    logContent += '</table>';
    document.getElementById('logContent').innerHTML = logContent;
}