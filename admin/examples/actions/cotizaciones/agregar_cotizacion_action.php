<?php
include '../../funciones_admin/funciones.php';

$prestador_servicio = $_POST["prestador_servicio"];
$cliente = $_POST["cliente"];
$servicio = $_POST["servicio"];
$boleta = $_POST["radio_boleta"]; // 0 = la cotizacion si tiene boleta - 1 = la cotizacion no tiene boleta
$id_funcionalidad = $_POST["numero_funcionalidad"];
$funcionalidad = $_POST["funcionalidad"];    
$valor = $_POST["valor"];    
$descripcion = $_POST["descripcion"];
$sub_total = $_POST["sub_total"];
$total = $_POST["total"];    
$total_sin_boleta = $_POST["sub_total_sin_boleta"];
$id_proyecto =  $_POST["id_proyecto"];

$id_func_final = explode(",",$id_funcionalidad);
$funcionalidad_final  = explode("^",$funcionalidad);
$valor_final = explode(",",$valor);
$descripcion_final =  explode("^",$descripcion);

$insert_ok =  false;

if(isset($prestador_servicio) && !empty($prestador_servicio)){
    if(isset($cliente) && !empty($cliente)){
        if($cliente > 0){
            if(isset($servicio) && !empty($servicio)){
                if($servicio != "0"){
                    if($id_proyecto >0){
                            if(isset($id_funcionalidad) && !empty($id_funcionalidad)){
                                if(isset($funcionalidad) && !empty($funcionalidad)){
                                    if(isset($valor) && !empty($valor)){
                                        if(isset($descripcion) && !empty($descripcion)){

                                            $id_encabezado_cotizacion = crearEncabezadoCotizacion($prestador_servicio,$cliente,$servicio,$boleta,$sub_total,$total,$total_sin_boleta,$id_proyecto); 

                                            if($id_encabezado_cotizacion == false){
                                                echo 'Ha ocurrido un error en la base de datos, intente nuevamente y revise todos los datos';
                                            }else{

                                                for ($i=0; $i < count($id_func_final) ; $i++) { 
                                                    if(crearDetalleCotizacion($id_encabezado_cotizacion,$id_func_final[$i],$funcionalidad_final[$i],$valor_final[$i],$descripcion_final[$i])){
                                                        $insert_ok =  true;
                                                    }
                                                }

                                            }

                                            if($insert_ok == true){
                                                echo 'Se ha creado la cotizacion con éxito';
                                            }else{
                                                echo 'Ha ocurrido un error en la base de datos al insertar la cotización';
                                            }

                                        }else{
                                            echo 'Debe ingresar la descripcion de  la funcionalidad';
                                        }
                                    }else{
                                        echo 'Debe ingresar el valor de la funcionalidad';
                                    }
                                }else{
                                    echo 'Debe ingresar la funcionalidad';
                                }
                            }else{
                                echo 'Debe ingresar el id de la funcionalidad';
                            }
                    }else{
                        echo 'Debe seleccionar un proyecto para esta cotizacion';
                    }
                }else{
                    echo 'Debe seleccionar un servicio';
                }
            }else{
                echo 'Debe seleccionar un servicio';
            }
        }else{
            echo 'Debe seleccionar un cliente';
        }
    }else{
        echo 'Debe seleccionar un cliente';
    }
}else{
    echo 'El prestador de servicios no puede estar vacio';
}
   
    




?>