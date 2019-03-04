<?php
include 'funciones/funciones.php';

$nombre = $_POST["nombre"];
$email = $_POST["correo"];
$telefono = $_POST["telefono"];
$servicio =  $_POST["servicio"];
$detalle = $_POST["detalle"];

if(insertarCotizacion($nombre,$email,$telefono,$servicio,$detalle)){
    echo "Se ha enviado tu cotización correctamente";
}else{
    echo 'Ha ocurrido un error al enviar la cotización , intenta nuevamente';
}

  

?>