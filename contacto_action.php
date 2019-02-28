<?php
include 'funciones/funciones.php';


$nombre = $_POST["nombre"];
$email = $_POST["correo"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];

if(insertarContacto($nombre, $email, $telefono, $mensaje)){
    echo "Se ha enviado tu mensaje correctamente";
}else{
    echo 'Ha ocurrido un error al enviar el mensaje , intenta nuevamente';
}

  

?>