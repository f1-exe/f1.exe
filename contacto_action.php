<?php
include 'funciones/funciones.php';

echo '<pre>';
var_dump($_POST);

$nombre = $_POST["nombre"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$mensaje = $_POST["mensaje"];

if(insertarContacto($nombre, $email, $telefono, $mensaje)){
    echo  'contacto insertado';
}else{
    echo 'error al insertar contacto';
}

  

?>