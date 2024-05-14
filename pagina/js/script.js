window.addEventListener("DOMContentLoaded",function(e){

    var boton = document.getElementById("enviar");
    var borrar = document.getElementById("borrar");
    var usuario = document.getElementById("user");
    var password = document.getElementById("pass");
    var password2 = document.getElementById("pass2");
    var form = document.getElementById("formulario");
    var poblacion = document.getElementById("poblacion");
    var fecha = document.getElementById("fecha");

    boton.addEventListener("click",function(e){
        e.preventDefault();
        
        var mensaje = document.createElement("label");
        var mensaje1 = document.createElement("label");
        var mensaje2 = document.createElement("label");
        var mensaje3 = document.createElement("label");

        if(password.value.length === 0 && usuario.value.length === 0){
            boton.disabled = true;
            mensaje.textContent = "Ingrese su correo y contraseña";
            mensaje.style.color="red";
            mensaje.setAttribute("id","mensaje")
            form.appendChild(mensaje);
            
        }else if(usuario.value.length === 0 && password.value.length != 0 ){
            boton.disabled = true;
            mensaje1.textContent = "Ingrese su correo";
            mensaje1.style.color="red";
            mensaje1.setAttribute("id","mensaje1")
            form.appendChild(mensaje1);
          
        }else if(password.value.length === 0 && usuario.value.length != 0 ){
            boton.disabled = true;
            mensaje2.textContent = "Ingrese su contraseña";
            mensaje2.style.color="red";
            mensaje2.setAttribute("id","mensaje2");
            form.appendChild(mensaje2);
            
        }else{

            var regex = /^(?=.*[a-z].*[a-z])(?=.*[A-Z].*[A-Z])(?=.*\d.*\d).{8,}$/;

            if (password.value.match(regex)) {
                alert("Contraseña correcta");
                if(password2.value === password.value){
                    alert("Las contraseñas son correctas");
                    form.submit();
                    boton.disabled = false;
                }else{
                    alert("Las contraseñas no coinciden");
                }
                
            } else {
                alert("La contraseña debe tener al menos 8 caracteres, con al menos 2 letras minúsculas, 2 letras mayúsculas y 2 dígitos.");
            }
            
            
            
        };

        if(poblacion.value.length === 0 | fecha.value.length === 0){
            boton.disabled = true;
            mensaje3.textContent = "Complete todos los datos";
            mensaje3.style.color = "red";
            mensaje3.setAttribute("id","mensaje3");
            form.appendChild(mensaje3);
        }
        
    });
    borrar.addEventListener("click",function(e){

        usuario.value = "";
        password.value = "";
        password2.value = "";
        poblacion.value = "";
        fecha.value = "";

    });

    usuario.addEventListener("focus",function(e){
        boton.disabled = false;
        if(document.getElementById("mensaje")){
            form.removeChild(mensaje);
        }
        if(document.getElementById("mensaje1")){
            form.removeChild(mensaje1);
        }
        if(document.getElementById("mensaje2")){
            form.removeChild(mensaje2);
        }
        if(document.getElementById("mensaje3")){
            form.removeChild(mensaje3);
        }
    });
    password.addEventListener("focus",function(e){
        boton.disabled = false;
        if(document.getElementById("mensaje")){
            form.removeChild(mensaje);
        }
        if(document.getElementById("mensaje1")){
            form.removeChild(mensaje1);
        }
        if(document.getElementById("mensaje2")){
            form.removeChild(mensaje2);
        }
        if(document.getElementById("mensaje3")){
            form.removeChild(mensaje3);
        }
    });
    poblacion.addEventListener("focus",function(e){
        boton.disabled = false;
        if(document.getElementById("mensaje")){
            form.removeChild(mensaje);
        }
        if(document.getElementById("mensaje1")){
            form.removeChild(mensaje1);
        }
        if(document.getElementById("mensaje2")){
            form.removeChild(mensaje2);
        }
        if(document.getElementById("mensaje3")){
            form.removeChild(mensaje3);
        }
    });
    fecha.addEventListener("focus",function(e){
        boton.disabled = false;
        if(document.getElementById("mensaje")){
            form.removeChild(mensaje);
        }
        if(document.getElementById("mensaje1")){
            form.removeChild(mensaje1);
        }
        if(document.getElementById("mensaje2")){
            form.removeChild(mensaje2);
        }
        if(document.getElementById("mensaje3")){
            form.removeChild(mensaje3);
        }
    });

});
