<?php
include '../../conexion/BDconexion.php';

//Se valida si el usuario se encuentra registrado en la BD
function validaUsuario($usuario){
    global $conn;
    $usu = "";
    $query = "SELECT usuario FROM usuario WHERE usuario = '".$usuario."'";
    $resp = mysqli_query($conn, $query);
  
    while($row = mysqli_fetch_row($resp)){
      $usu = $row[0];
    }
  
    if($usu === $usuario){
      return true;
    }else{
      return false;
    }
  
  }
  
  //Se valida clave del usuario al momento de loguearse
  function validaClave($usuario, $clave){
    global $conn;
    $pass="";
    $query = "SELECT clave FROM usuario WHERE usuario = '".$usuario."'";
    $resp = mysqli_query($conn, $query);
  
    while($row = mysqli_fetch_row($resp)){
      $pass = $row[0];
    }
  
    if($clave === $pass){
      return true;
    }else{
      return false;
    }
  
  }

?>