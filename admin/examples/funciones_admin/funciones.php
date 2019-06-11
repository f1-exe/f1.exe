<?php
// include '../../conexion/BDconexion.php';
include 'C:\xampp\htdocs\Proyectos\F1.exe Repositorio\f1.exe\conexion\BDconexion.php';



//echo '---a'.$_SERVER["DOCUMENT_ROOT"];

//var_dump(__DIR__);

//echo dirname(__FILE__);


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

  //listar los contactos de la pagina
  function listarContactos(){
    global $conn;
    $query = "SELECT * FROM contacto";
    $resp =  mysqli_query($conn,$query);

    return $resp;

  }

  //listar las cotizaciones hechas 
  function listarCotizaciones(){
    global $conn;
    $query = "SELECT * FROM cotizacion";
    $resp =  mysqli_query($conn,$query);
    
    return $resp;

  }

  //crear clientes
  function crearCliente($nombre_cliente,$email_cliente,$telefono_cliente,$nombre_representante,$logo_cliente){
    global $conn;
    $query = "INSERT INTO clientes(id, nombre_cliente, email_cliente, telefono_cliente, nombre_representante, logo_cliente) 
              VALUES (NULL,'".$nombre_cliente."','".$email_cliente."',".$telefono_cliente.",'".$nombre_representante."','".$logo_cliente."')";
    $resp =  mysqli_query($conn,$query);

    if($resp){
      return true;
    }else{
      return false;
    }

  }

  //listar clientes
  function listarClientes(){
    global $conn;
    $query =  "SELECT * FROM clientes";
    $resp =  mysqli_query($conn,$query);

    return $resp;
  }

?>