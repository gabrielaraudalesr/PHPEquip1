window.onload = function ocultar() {
    let divs = document.getElementsByClassName("formulario");
    for (let i = 0; i < divs.length; i++) {
        divs[i].style.display = "none";
    }
};

function mostrarForm(id) {
    // Ocultar todos los formularios
    document.querySelectorAll('.formulario').forEach(form => {
        form.style.display = 'none';
    });

    // Mostrar el formulario solicitado
    document.getElementById(id).style.display = 'block';
}


// Configurar el botón de cerrar al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    var botonCerrar = document.getElementById("cerrar");
    botonCerrar.onclick = function() {
        var form = document.getElementById("formCrear");
        form.style.display = "none";
    };
});

