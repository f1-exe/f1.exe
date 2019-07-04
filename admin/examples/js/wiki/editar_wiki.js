$("#btn_guardar").click(function (e) {
    e.preventDefault();

    var cliente = document.getElementById("cliente").value;
    var tema = document.getElementById("tema").value;
    var descripcion = CKEDITOR.instances.descripcion.getData(); //asi se obtiene la info del txtarea ckeditor
    
    var dataForm = new FormData();
  
    if (cliente === "0") {
        MensajeAlerta("Debe <label style='color:red'><strong>Seleccionar el cliente</strong></label> ");
        return false;
    }

    if(tema === ""){
        MensajeAlerta("El campo <label style='color:red'><strong>Tema</strong></label> es obligatorio");
        return false;
    }

    if(tema.length > 100){
        MensajeAlerta("El campo <label style='color:red'><strong> tema </strong></label> ha superado el largo máximo<br>, éste tiene un largo de "+tema.length+" y debe tener como máximo 100");
        return false;
    }

    if(descripcion === ""){
        MensajeAlerta("El campo <label style='color:red'><strong> descripción </strong></label> es obligatorio");
        return false;
    }

    dataForm.append('cliente', cliente);
    dataForm.append('tema', tema);
    dataForm.append('descripcion', descripcion);    

    $.ajax({
        url: 'actions/wiki/editar_wiki_action.php',
        type: 'POST',
        data: dataForm,
        success: function (data) {
            if(data === "Se ha editado la wiki con exito"){
                MensajeFinal(data+", Puede continuar agregando info o ir a la lista de wikis");
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