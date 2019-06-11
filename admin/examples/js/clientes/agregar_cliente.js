$("#btn_guardar").click(function (e) {
    e.preventDefault();

    var nombre_cliente = document.getElementById("nombre_cliente").value;
    var email_cliente = document.getElementById("email_cliente").value;
    var telefono_cliente = document.getElementById("telefono_cliente").value;
    var nombre_representante = document.getElementById("nombre_representante").value;

    var customFileLang = document.getElementById("logo_empresa");
    var file = customFileLang.files;

    var dataForm = new FormData();
  
    if (nombre_cliente === "") {
        MensajeAlerta("El campo <label style='color:red'><strong>Nombre del Cliente </strong></label> es obligatorio");
        return false;
    }

    if(nombre_cliente.length > 100){
        MensajeAlerta("El campo <label style='color:red'><strong>Nombre del Cliente</strong></label> ha superado el largo máximo<br> éste tiene un largo de "+nombre_cliente.length+" y debe tener como maximo 100");
        return false;
    }

    if(email_cliente === ""){
        MensajeAlerta("El campo <label style='color:red'><strong>Email</strong></label> es obligatorio");
        return false;
    }

    if(email_cliente.length > 100){
        MensajeAlerta("El campo <label style='color:red'><strong>Email del Cliente</strong></label> ha superado el largo máximo<br> éste tiene un largo de "+email_cliente.length+" y debe tener como maximo 100");
        return false;
    }

    if(!isValidEmail(email_cliente)){
        MensajeAlerta("El campo <label style='color:red'><strong>Email no es válido</strong></label> <br> Considere el formato ejemplo@dominio.com");
        return false;
    }

    if(telefono_cliente === "" ){
        MensajeAlerta("El <label style='color:red'><strong> Número de teléfono </strong></label> es obligatorio");
        return false;
    }

    if(telefono_cliente.length > 9){
        MensajeAlerta("El <label style='color:red'><strong> Número de teléfono </strong></label> debe contener máximo 9 dígitos <br> Considere el formato 912345678");
        return false;
    }

    if(isNaN(telefono_cliente)){
        MensajeAlerta("El campo <label style='color:red'><strong>Número de teléfono </strong></label> es de tipo numérico");
        return false;
    }

    if(nombre_representante === ""){
        MensajeAlerta("El campo <label style='color:red'><strong>Nombre del representánte</strong></label> es obligatorio");
        return false;
    }

    if(nombre_representante.length > 100){
        MensajeAlerta("El campo <label style='color:red'><strong>Nombre del representánte</strong></label> ha superado el largo máximo<br> éste tiene un largo de "+nombre_representante.length+" y debe tener como maximo 100");
        return false;
    }


    if(file.length == 1){
        for (i = 0; i < file.length; i++) {
            if (/\.(jpg|jpeg|png)$/i.test(customFileLang.files[i].name)) {
                dataForm.append('archivo' + i, file[i]);
            } else {
                MensajeError("El archivo no contiene el formato correcto, los formatos permitidos son : <br> <label style='color:red'><strong>[ .JPG / .JPEG / .PNG ]</strong></label>");
                return false;
            }
        }
    }else{
        MensajeError("Debe subir solo 1 archivo, usted esta subiendo " + file.length + " archivos");
        return false;
    }

    dataForm.append('nombre_cliente', nombre_cliente);
    dataForm.append('email_cliente', email_cliente);
    dataForm.append('telefono_cliente', telefono_cliente);
    dataForm.append('nombre_representante', nombre_representante);
    dataForm.append('logo_empresa', file[0].name);

    $.ajax({
        url: 'actions/clientes/agregar_cliente_action.php',
        type: 'POST',
        data: dataForm,
        success: function (data) {
            if(data === "Se ha agregado el cliente correctamente"){
                document.getElementById("form_cliente").reset();
                MensajeFinal(data+", Puede continuar agregando clientes o ir a la lista de clientes creados");
            }else{
                MensajeAlerta(data+", Ha ocurrido un error");
            }
            
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

function MensajeFinal(msg) {
    Swal.fire({
        type: "success",
        html: msg,
        showConfirmButton: false,
        timer: 3000
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