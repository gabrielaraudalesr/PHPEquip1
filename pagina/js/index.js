function visualizarRegistro() {
    var registro = document.getElementById("iframeRegistro");
    var botonCerrar = document.getElementById("cerrar");
    botonCerrar.style.display = "block";
    registro.style.display = "block";

};

function visualizarLogin() {
    var registro = document.getElementById("iframeLogin");
    var botonCerrar = document.getElementById("cerrar");
    botonCerrar.style.display = "block";
    registro.style.display = "block";

};

document.addEventListener('DOMContentLoaded', function () {
    var botonCerrar = document.getElementById("cerrar");
    botonCerrar.onclick = function () {
        var form = document.getElementById("iframeRegistro");
        var form2 = document.getElementById("iframeLogin");
        form.style.display = "none";
        form2.style.display = "none";
        botonCerrar.style.display="none";
    };
});


