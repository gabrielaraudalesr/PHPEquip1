window.addEventListener("DOMContentLoaded",function(e){

    var boton = document.getElementById("btn");
    var usuario = document.getElementById("user");
    var password = document.getElementById("pass");

    boton.addEventListener("click",function(e){
        var mensaje = document.createElement("label");
        var mensaje1 = document.createElement("label");
        var mensaje2 = document.createElement("label");

        if(password.value.length === 0 && usuario.value.length === 0){
            mensaje.textContent = "Ingrese su correo y contraseña";
            mensaje.style.color="red";
            mensaje.setAttribute("id","mensaje")
            document.getElementById("formulario").appendChild(mensaje);
            boton.disabled = true;
        }else if(usuario.value.length === 0 && password.value.length != 0 ){
            mensaje1.textContent = "Ingrese su correo";
            mensaje1.style.color="red";
            mensaje1.setAttribute("id","mensaje1")
            document.getElementById("formulario").appendChild(mensaje1);
            boton.disabled = true;
        }else if(password.value.length === 0 && usuario.value.length != 0 ){
            mensaje2.textContent = "Ingrese su contraseña";
            mensaje2.style.color="red";
            mensaje2.setAttribute("id","mensaje2")
            document.getElementById("formulario").appendChild(mensaje2);
            boton.disabled = true;
        }else{
            boton.disabled = false;
        };

        
        
    });


    usuario.addEventListener("focus",function(e){
        boton.disabled = false;
        if(document.getElementById("mensaje")){
            document.getElementById("formulario").removeChild(mensaje);
        }
        if(document.getElementById("mensaje1")){
            document.getElementById("formulario").removeChild(mensaje1);
        }
        if(document.getElementById("mensaje2")){
            document.getElementById("formulario").removeChild(mensaje2);
        }
    });
    password.addEventListener("focus",function(e){
        boton.disabled = false;
        if(document.getElementById("mensaje")){
            document.getElementById("formulario").removeChild(mensaje);
        }
        if(document.getElementById("mensaje1")){
            document.getElementById("formulario").removeChild(mensaje1);
        }
        if(document.getElementById("mensaje2")){
            document.getElementById("formulario").removeChild(mensaje2);
        }
    });
});
