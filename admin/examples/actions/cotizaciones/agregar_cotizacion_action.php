<?php
include '../../funciones_admin/funciones.php';


$ie_array = $_POST["ie"];
$ie_semi_final = $ie_array; 
$detalle_ie_semi_final = $detalle_ie_array; 
$detalle_ie = explode("^",$detalle_ie_semi_final);

$id_oa = crearOa($oa,$descripcion_oa,$id_nivel,$id_asignatura,$id_unidad,$id_eje,$descripcion_unidad);

    $insert_ok =  false;
    for($i=0; $i < count($ie); $i++) { 
    
        if(crearIe($ie[$i],$detalle_ie[$i],$id_oa)){
            $insert_ok = true;
        }
    }

    if($insert_ok == true){
        echo 'Se ha creado el OA exitosamente';
    }else{
        echo 'Error en la base de datos al insertar el oa';
    }


?>