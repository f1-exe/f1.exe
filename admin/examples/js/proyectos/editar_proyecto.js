$("#btn_guardar").click(function (e) {
    e.preventDefault();

    var nombre_proyecto = document.getElementById("nombre_proyecto").value;
    var estado_proyecto = document.getElementById("estado_proyecto").value;
    var fecha_inicio = document.getElementById("fecha_inicio").value;
    var fecha_termino = document.getElementById("fecha_termino").value;
    var id_cliente = document.getElementById("id_cliente").value;
    var comentario = document.getElementById("comentario").value;
    var id_proyecto = document.getElementById("id_proyecto").value;

    var dataForm = new FormData();
  
    if (nombre_proyecto === "") {
        MensajeAlerta("El campo <label style='color:red'><strong>Nombre del Proyecto </strong></label> es obligatorio");
        return false;
    }

    if(nombre_proyecto.length > 100){
        MensajeAlerta("El campo <label style='color:red'><strong>Nombre del Proyecto</strong></label> ha superado el largo máximo<br>, éste tiene un largo de "+nombre_proyecto.length+" y debe tener como máximo 100");
        return false;
    }

    if(estado_proyecto === 0){
        MensajeAlerta("El campo <label style='color:red'><strong>estado del proyecto</strong></label> es obligatorio");
        return false;
    }

    if(fecha_inicio === ""){
        MensajeAlerta("El campo <label style='color:red'><strong>Fecha de inicio</strong></label> es obligatorio");
        return false;
    }

    if(id_cliente === 0){
        MensajeAlerta("Debe<label style='color:red'><strong> seleccionar un cliente </strong></label>");
        return false;
    }


    dataForm.append('nombre_proyecto', nombre_proyecto);
    dataForm.append('estado_proyecto', estado_proyecto);
    dataForm.append('fecha_inicio', fecha_inicio);
    dataForm.append('fecha_termino', fecha_termino);
    dataForm.append('id_cliente', id_cliente);
    dataForm.append('comentario', comentario);
    dataForm.append('id_proyecto', id_proyecto);



    $.ajax({
        url: 'actions/proyectos/editar_proyecto_action.php',
        type: 'POST',
        data: dataForm,
        success: function (data) {
            if(data === "Se ha editado el proyecto correctamente"){
                MensajeFinal(data+", Espere mientras es redirigido a la vista de proyectos");
                setTimeout(function nada() {
                    window.location.replace("proyectos.php");
                  }, 2500);
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