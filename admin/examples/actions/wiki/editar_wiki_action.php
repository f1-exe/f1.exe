<?php

include '../../funciones_admin/funciones.php';

$id_wiki =  $_POST["id_wiki"];
$cliente =  $_POST["cliente"];
$tema = $_POST["tema"];
$descripcion = $_POST["descripcion"];

if(isset($cliente) && !empty($cliente)){
    if(isset($tema) && !empty($tema)){
        if(strlen($tema)<100){
            if(isset($descripcion) && !empty($descripcion)){
                if(editarWiki($cliente,$tema,$descripcion,$id_wiki)){
                    echo 'Se ha editado la wiki con exito';
                }else{
                    echo 'Ha ocurrido un error en la base de datos';
                }
            }else{
                echo 'La descripcion es obligatoria';
            }
        }else{
            echo 'El nombre del tema no puede superar los 100 carácteres';
        }
    }else{
        echo 'Debe indicar el tema del wiki';
    }
}else{
    echo 'Debe seleccionar un cliente';
}

?>