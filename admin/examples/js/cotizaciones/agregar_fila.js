//creo el wrapper que es el div principal y vacio
var wrapper = $("#contenedor_cotizacion");

//guardo el boton en una variable
var add_button = $("#btn_agregar");

//el boton listo comienza deshabilitado
document.getElementById("btn_listo").disabled = true;

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

function formatearNumero2(numero){

    var num = numero.replace(/\./g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        numero.value = num;
    }else{ 
        numero.value = numero.replace(/[^\d\.]*/g,'');
    }
}

var cont_add_button = 0;

$(add_button).click(function(e) {
    e.preventDefault();

    cont_add_button++;
    document.getElementById("btn_listo").disabled = false;
    document.getElementById("btn_guardar").disabled = false;

    $(wrapper).append('<div id="inner_contenedor">'+
            '<div class="pl-lg-4">'+
                '<div class="row">'+
                    '<div class="col-lg-4">'+
                        '<div class="form-group">'+
                            '<label class="form-control-label" for="input-email">ID</label>'+
                            '<input type="text" id="numero_funcionalidad" name="numero_funcionalidad[]" class="form-control form-control-alternative" placeholder="1">'+
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

        if(radio_boleta == 0){

            $("#detalle_cotizacion_con_boleta").show(1000);
    
            for (let index = 0; index < valor.length; index++) {
    
                suma_sub_total = parseInt(suma_sub_total) + parseInt(valor[index].split('.').join(''));
            }
    
            document.getElementById("subtotal_cot_con_boleta").value =  suma_sub_total.toLocaleString();
            
            total =  suma_sub_total / 0.90;
    
            document.getElementById("total_cot_con_boleta").value = total.toLocaleString();
    
        }else{
    
            $("#detalle_cotizacion_sin_boleta").show(1000);
              
            for (let index = 0; index < valor.length; index++) {
    
                suma_sub_total = parseInt(suma_sub_total) + parseInt(valor[index].split('.').join(''));
            }
    
            document.getElementById("total_cot_sin_boleta").value =  suma_sub_total.toLocaleString();
            
        }
    }

});  




$("#btn_guardar").click(function (e) {
    e.preventDefault();


    var prestador_servicios =  document.getElementById("prestador_servicios").value;    
    var cliente =  document.getElementById("cliente").value;    
    var servicio = document.getElementById("servicio").value;    
    var numero_funcionalidad = $("input[name='numero_funcionalidad[]']").map(function(){return $(this).val();}).get();
    var funcionalidad = $("input[name='funcionalidad[]']").map(function(){return $(this).val();}).get();
    var valor = $("input[name='valor[]']").map(function(){return $(this).val();}).get();
    var descripcion = $("input[name='valor[]']").map(function(){return $(this).val();}).get();
    
    /**validaciones**/

    // for (let index = 0; index < ie.length; index++) {
    //     if(ie[index] === ""){
    //         MensajeAlerta("Uno o mas <label style='color:red'><strong> IE están vacios</strong></label> por favor complételos");
    //         return false;
    //     }
    // }


    // var descripcion_f =  descripcion.join("^");

    $.ajax({
        url: '',
        type: 'POST',
        data: dataForm,
        success: function (data) {
            if(data === ""){
                MensajeFinal(data+", Espere un momento");
                setTimeout(function nada() {
                    window.location.replace("");
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


                                
                        