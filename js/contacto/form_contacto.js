jQuery("#btn_enviar").click(function (e) {
    e.preventDefault();

    var nombre = document.getElementById("nombre").value;
    var correo = document.getElementById("email").value;
    var telefono = document.getElementById("telefono").value;
    var mensaje = document.getElementById("mensaje").value;
    var dataForm = new FormData();

    if (nombre === "") {
        MensajeAlerta("El campo <label style='color:red'><strong>Nombre y Apellido</strong></label> es obligatorio");
        return false;
    }

    if(!isSpace(nombre)){
        MensajeAlerta("Debe ingresar <label style='color:red'><strong>Nombre y Apellido</strong></label> separado por un espacio");
        return false;
    }

    if(correo === ""){
        MensajeAlerta("El campo <label style='color:red'><strong>Correo Electrónico</strong></label> es obligatorio");
        return false;
    }

    if(!isValidEmail(correo)){
        MensajeAlerta("El campo <label style='color:red'><strong>Correo Electrónico</strong></label> no es valido");
        return false;
    }

    if(telefono === ""){
        MensajeAlerta("El campo <label style='color:red'><strong>Número de Teléfono</strong></label> es obligatorio");
        return false;
    }

    if(isNaN(telefono)){
        MensajeAlerta("El campo <label style='color:red'><strong>Número de Teléfono</strong></label> es de tipo numerico");
        return false;
    }

    if(!isNumber(telefono)){
        MensajeAlerta("El campo <label style='color:red'><strong>Número de Teléfono</strong></label> debe contener un largo de 9 digitos");
        return false;
    }

    if(mensaje === ""){
        MensajeAlerta("El campo <label style='color:red'>Debes ingresar <strong>al menos un mensaje</strong></label> de contacto");
        return false;
    }

    dataForm.append('nombre', nombre);
    dataForm.append('correo', correo);
    dataForm.append('telefono', telefono);
    dataForm.append('mensaje', mensaje);

    jQuery.ajax({
        url: 'contacto_action.php',
        type: 'POST',
        data: dataForm,
        success: function (data) {
            if(data === "Se ha enviado tu mensaje correctamente"){
                MensajeFinal(data+", Espere mientras es direccionado a la pagina principal");
                setTimeout(function nada() {
                    window.location.replace("index.html");
                  }, 2500);
            }
            
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

function MensajeFinal(msg) {
    Swal.fire({
        position: "top",
        type: "success",
        html: msg,
        showConfirmButton: false,
        timer: 1500
    });
}

function MensajeError(msg) {
    Swal.fire({
        type: "error",
        title: "Upss...",
        html: msg
    });
}

function MensajeAlerta(msg) {
    Swal.fire({
        title: "Debe corregir lo siguiente",
        type: "info",
        html: msg,
        animation: false,
        customClass: "animated tada"
    })
}

function isValidEmail(correo) {
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(correo);
}

function isSpace(variable){
    return /^([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\']+[\s])+([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])+[\s]?([A-Za-zÁÉÍÓÚñáéíóúÑ]{0}?[A-Za-zÁÉÍÓÚñáéíóúÑ\'])?$/.test(variable);
}

function isNumber(variable){
    return /^\d{9}$/.test(variable);
}