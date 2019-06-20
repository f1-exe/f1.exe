<?php

include '../../funciones_admin/funciones.php';

$nombre_proyecto = $_POST["nombre_proyecto"];
$estado_proyecto = $_POST["estado_proyecto"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_termino =  $_POST["fecha_termino"];
$id_cliente =  $_POST["id_cliente"];
$comentario =  $_POST["comentario"];

if(isset($nombre_proyecto) && !empty($nombre_proyecto)){
    if(strlen($nombre_proyecto) <= 100){
        if(isset($estado_proyecto) && !empty($estado_proyecto)){
            if($estado_proyecto > 0){
                if(isset($fecha_inicio) && !empty($fecha_inicio)){
                    if(isset($id_cliente) && !empty($id_cliente)){
                        if($id_cliente > 0){
                            if(crearProyecto($nombre_proyecto,$estado_proyecto,$fecha_inicio,$fecha_termino,$id_cliente,$comentario)){
                                echo 'Se ha creado el proyecto correctamente';
                            }else{
                                echo 'Error al insertar en la base de datos';
                            }
                             
                        }else{
                            echo'Debe indicar a que cliente corresponde este proyecto';
                        }
                    }else{
                        echo 'Debe indicar a que cliente corresponde este proyecto';
                    }
                }else{
                    echo 'Debe indicar una fecha de inicio para el proyecto';
                }
            }else{
                echo 'Debe indicar un estado para el proyecto';
            }
        }else{
            echo "Debe indicar un estado para el proyecto";
        }

    }else{
        echo "El campo nombre del proyecto debe tener un largo maximo de 100";
    }

}else{
    echo "El nombre del poryecto es obligatorio";
}



?>