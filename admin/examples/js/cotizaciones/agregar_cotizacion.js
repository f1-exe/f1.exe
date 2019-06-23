//creo el wrapper que es el div principal y vacio
var wrapper = $("#contenedor_cotizacion");

//guardo el boton en una variable
var add_button = $("#btn_agregar");

//el boton listo comienza deshabilitado
document.getElementById("btn_listo").disabled = true;
document.getElementById("btn_guardar").disabled = true;

//funcion que formatea a miles en el input
function formatearNumero(input){

    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
    }else{ 
        input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}


var cont_add_button = 0;

$(add_button).click(function(e) {
    e.preventDefault();

    cont_add_button++;
    document.getElementById("btn_listo").disabled = false;

    $(wrapper).append('<div id="inner_contenedor">'+
            '<div class="pl-lg-4">'+
                '<div class="row">'+
                    '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="input-email">Numero de funcionalidad</label>'+
                            '<input type="text" id="numero_funcionalidad" name="numero_funcionalidad[]" onkeyup="formatearNumero(this)"class="form-control form-control-alternative" placeholder="1">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="input-email">Funcionalidad</label>'+
                            '<input type="text" id="funcionalidad" name="funcionalidad[]" class="form-control form-control-alternative" placeholder="CRUD completo para la seccion de productos">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="input-email">Valor ($)</label>'+
                            '<input type="text" id="valor" onkeyup="formatearNumero(this)" name="valor[]" class="form-control form-control-alternative" placeholder="100.000">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-12">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="input-email">Descripción</label>'+
                            '<textarea class="form-control form-control-alternative" name="descripcion[]" id="descripcion" cols="10" rows="6" placeholder="El modulo estará habilitado para que el usuario pueda: listar, agregar, editar y eliminar la información de los productos"></textarea>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-lg-12">'+
                        '<div class="form-group">'+
                            '<button type="button" id="btn_eliminar" class="btn btn-danger">Eliminar</button>'+  
                        '</div>'+                                
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>');

});


//boton que eliminar las filas de datos de cotizacion
$(wrapper).on("click", "#btn_eliminar", function(e) {
    e.preventDefault();

    cont_add_button--;
    $('#inner_contenedor').remove();
    
    if(cont_add_button == 0){
        //dejo el boton listo y guardar deshabilitado si no hay al menos una fila de datos de cotizacion
         document.getElementById("btn_listo").disabled = true;
         document.getElementById("btn_guardar").disabled = true;
    }


    
});

var suma_sub_total = 0;
var total = 0;

$("#btn_listo").click(function (e) {
    e.preventDefault();

    if(!$('[name=radio_boleta]:checked').length){
        MensajeAlerta("Debe seleccionar si emite o no boleta");
        return false;
    }else{

        var radio_boleta = document.querySelector('input[name=radio_boleta]:checked').value;

        var valor = $("input[name='valor[]']").map(function(){return $(this).val();}).get();

        var prestador_servicio =  document.getElementById("prestador_servicio").value;    
        var cliente =  document.getElementById("cliente").value;    
        var servicio = document.getElementById("servicio").value;    
        var numero_funcionalidad = $("input[name='numero_funcionalidad[]']").map(function(){return $(this).val();}).get();
        var funcionalidad = $("input[name='funcionalidad[]']").map(function(){return $(this).val();}).get();
        var valor = $("input[name='valor[]']").map(function(){return $(this).val();}).get();
        var descripcion = $("input[name='descripcion[]']").map(function(){return $(this).val();}).get();

        if(cliente === 0) {
            MensajeAlerta("Debe seleccionar <label style='color:red'><strong>Un cliente </strong></label> para hacer la cotización");
            return false;
        }

        if(servicio === 0) {
            MensajeAlerta("Debe seleccionar <label style='color:red'><strong>Un servicio</strong></label> por el cual va a hacer la cotización");
            return false;
        }

        if(!$('[name=radio_boleta]:checked').length){
            MensajeAlerta("Debe seleccionar <label style='color:red'><strong>si emite o no boleta");
            return false;
        }

        for (let index = 0; index < numero_funcionalidad.length; index++) {
            if(numero_funcionalidad[index] === ""){
                MensajeAlerta("Uno o mas <label style='color:red'><strong> número de funcionalidades están vacios</strong></label> por favor complételos");
                return false;
            }
        }

        for (let index = 0; index < funcionalidad.length; index++) {
            if(funcionalidad[index] === ""){
                MensajeAlerta("Uno o mas <label style='color:red'><strong> funcionalidades están vacios</strong></label> por favor complételos");
                return false;
            }
        }

        for (let index = 0; index < valor.length; index++) {
            if(valor[index] === ""){
                MensajeAlerta("Uno o mas <label style='color:red'><strong> valores están vacios</strong></label> por favor complételos");
                return false;
            }
        }

        for (let index = 0; index < descripcion.length; index++) {
            if(descripcion[index] === ""){
                MensajeAlerta("Una o mas <label style='color:red'><strong> descripciones están vacias</strong></label> por favor complételos");
                return false;
            }
        }

        if(radio_boleta == 0){

            $("#detalle_cotizacion_con_boleta").show(1000);
    
            for (let index = 0; index < valor.length; index++) {
    
                suma_sub_total = parseInt(suma_sub_total) + parseInt(valor[index].split('.').join(''));
            }
    
            document.getElementById("subtotal_cot_con_boleta").value =  suma_sub_total.toLocaleString();
            
            total =  suma_sub_total / 0.90;
    
            document.getElementById("total_cot_con_boleta").value = total.toLocaleString();

            document.getElementById("btn_guardar").disabled = false;
    
        }else{
    
            $("#detalle_cotizacion_sin_boleta").show(1000);
              
            for (let index = 0; index < valor.length; index++) {
    
                suma_sub_total = parseInt(suma_sub_total) + parseInt(valor[index].split('.').join(''));
            }
    
            document.getElementById("total_cot_sin_boleta").value =  suma_sub_total.toLocaleString();

            document.getElementById("btn_guardar").disabled = false;
            
        }
    }

});  




$("#btn_guardar").click(function (e) {
    e.preventDefault();

    var radio_boleta = document.querySelector('input[name=radio_boleta]:checked').value;
    var prestador_servicio =  document.getElementById("prestador_servicio").value;    
    var cliente =  document.getElementById("cliente").value;
    var id_proyecto =  document.getElementById("proyecto").value;        
    var servicio = document.getElementById("servicio").value;    
    var numero_funcionalidad = $("input[name='numero_funcionalidad[]']").map(function(){return $(this).val();}).get();
    var funcionalidad = $("input[name='funcionalidad[]']").map(function(){return $(this).val();}).get();
    var valor = $("input[name='valor[]']").map(function(){return $(this).val();}).get();
    var descripcion = $("textarea[name='descripcion[]']").map(function(){return $(this).val();}).get();

    var sub_total_sin_boleta = document.getElementById("total_cot_sin_boleta").value;
    var sub_total =  document.getElementById("subtotal_cot_con_boleta").value;
    var total = document.getElementById("total_cot_con_boleta").value;


    var dataForm = new FormData();
  
    if(cliente === 0) {
        MensajeAlerta("Debe seleccionar <label style='color:red'><strong>Un cliente </strong></label> para hacer la cotización");
        return false;
    }

    if(servicio === 0) {
        MensajeAlerta("Debe seleccionar <label style='color:red'><strong>Un servicio</strong></label> por el cual va a hacer la cotización");
        return false;
    }

    if(id_proyecto === 0) {
        MensajeAlerta("Debe seleccionar <label style='color:red'><strong>Un proyecto</strong></label> al que estará asociada la cotización");
        return false;
    }

    if(!$('[name=radio_boleta]:checked').length){
        MensajeAlerta("Debe seleccionar <label style='color:red'><strong>si emite o no boleta");
        return false;
    }

    for (let index = 0; index < numero_funcionalidad.length; index++) {
        if(numero_funcionalidad[index] === ""){
            MensajeAlerta("Uno o mas <label style='color:red'><strong> número de funcionalidades están vacios</strong></label> por favor complételos");
            return false;
        }
    }

    for (let index = 0; index < funcionalidad.length; index++) {
        if(funcionalidad[index] === ""){
            MensajeAlerta("Uno o mas <label style='color:red'><strong> funcionalidades están vacios</strong></label> por favor complételos");
            return false;
        }
    }

    for (let index = 0; index < valor.length; index++) {
        if(valor[index] === ""){
            MensajeAlerta("Uno o mas <label style='color:red'><strong> valores están vacios</strong></label> por favor complételos");
            return false;
        }
    }

    for (let index = 0; index < descripcion.length; index++) {
        if(descripcion[index] === ""){
            MensajeAlerta("Una o mas <label style='color:red'><strong> descripciones están vacias</strong></label> por favor complételos");
            return false;
        }
    }

    var descripcion_f =  descripcion.join("^");
    var funcionalidad_f =  funcionalidad.join("^");

    var dataForm = new FormData();

    dataForm.append('prestador_servicio', prestador_servicio);
    dataForm.append('cliente', cliente);
    dataForm.append('servicio', servicio);
    dataForm.append('radio_boleta', radio_boleta);
    dataForm.append('numero_funcionalidad', numero_funcionalidad);
    dataForm.append('funcionalidad', funcionalidad_f);
    dataForm.append('valor', valor);
    dataForm.append('descripcion', descripcion_f);
    dataForm.append('descripcion', descripcion_f);
    dataForm.append('sub_total', sub_total);
    dataForm.append('total', total);
    dataForm.append('sub_total_sin_boleta', sub_total_sin_boleta);
    dataForm.append('id_proyecto', id_proyecto);


    $.ajax({
        url: 'actions/cotizaciones/agregar_cotizacion_action.php',
        type: 'POST',
        data: dataForm,
        success: function (data) {

           
            if(data == "Se ha creado la cotizacion con éxito"){
                MensajeFinal(data+", Espere un momento");
                setTimeout(function nada() {
                    window.location.replace("cotizacion.php");
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


                                
                        