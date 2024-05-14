function mostrarFormulario(id) {
    // Ocultar todos los formularios
    document.querySelectorAll('.formulario').forEach(form => {
        form.style.display = 'none';
    });

    // Mostrar el formulario correspondiente
    document.getElementById(id).style.display = 'block';
}