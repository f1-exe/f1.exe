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

  //obtener nombre cliente por id
  function getNombreCliente($id){
    global $conn;
    $query = "SELECT nombre_cliente FROM clientes WHERE id  = ".$id."";
    $resp =  mysqli_query($conn,$query);
    $nombre =  mysqli_fetch_array($resp);

    return $nombre["nombre_cliente"];

  }

  //obtener logo cliente por id 
  function getLogoCliente($id){
    global $conn;
    $query = "SELECT logo_cliente FROM clientes WHERE id= ".$id."";
    $resp = mysqli_query($conn,$query);
    $logo = mysqli_fetch_array($resp);

    return $logo["logo_cliente"];
  }

  //listar clientes
  function listarClientes(){
    global $conn;
    $query =  "SELECT * FROM clientes";
    $resp =  mysqli_query($conn,$query);

    return $resp;
  }

  //listar clientes por id
  function listarClientesPorId($id_cliente){
    global $conn;
    $query =  "SELECT * FROM clientes WHERE id = ".$id_cliente."";
    $resp =  mysqli_query($conn,$query);
    $row = mysqli_fetch_array($resp);

    return $row;
  }

  //funcion para editar los datos de un cliente cuando este ya tiene una imagen
  function editarClienteSinImagen($id_cliente,$nombre_cliente,$email_cliente,$telefono_cliente,$nombre_representante){
    global $conn;
    $query = "UPDATE clientes SET nombre_cliente = '".$nombre_cliente."',email_cliente =  '".$email_cliente."',telefono_cliente = ".$telefono_cliente.", nombre_representante = '".$nombre_representante."' WHERE id  =  ".$id_cliente."";
    $resp =  mysqli_query($conn, $query);

    if($resp){
      return true;
    }else{
      return false;
    }
  }

  //funcion para editar los datos de un cliente cuando no tiene imagen
  function editarClienteConImagen($id_cliente,$nombre_cliente,$email_cliente,$telefono_cliente,$nombre_representante,$logo_cliente){
    global $conn;
    $query = "UPDATE clientes SET nombre_cliente = '".$nombre_cliente."',email_cliente =  '".$email_cliente."',telefono_cliente = ".$telefono_cliente.", nombre_representante = '".$nombre_representante."', logo_cliente = '".$logo_cliente."' WHERE id  =  ".$id_cliente."";
    $resp =  mysqli_query($conn, $query);

    if($resp){
      return true;
    }else{
      return false;
    }
  }

  //funcion para crear proyectos
  function crearProyecto($nombre_proyecto,$estado_proyecto,$fecha_inicio,$fecha_termino,$id_cliente,$comentario){
    global $conn;
    $query = "INSERT INTO proyectos (id, nombre_proyecto, estado_proyecto, fecha_inicio, fecha_termino, id_cliente, comentario)
              VALUES (NULL,'".$nombre_proyecto."',".$estado_proyecto.",'".$fecha_inicio."','".$fecha_termino."',".$id_cliente.",'".$comentario."')";
    $resp =  mysqli_query($conn,$query);
    
    if($resp){
      return true;
    }else{
      return false;
    }
    
  }

  //funcion para listar los proyectos
  function listarProyectos(){
    global $conn;
    $query = "SELECT * FROM proyectos";
    $resp =  mysqli_query($conn,$query);

    return $resp;

  }

  //listar proyectos por id
  function listarProyectosPorId($id_proyecto){
    global $conn;
    $query =  "SELECT * FROM proyectos WHERE id = ".$id_proyecto."";
    $resp =  mysqli_query($conn,$query);
    $row = mysqli_fetch_array($resp);

    return $row;
  }

  //obtener nombre de proyecto por id
  function getNombreProyecto($id_proyecto){
    global $conn;
    $query = "SELECT nombre_proyecto FROM proyectos WHERE id =  ".$id_proyecto."";
    $resp = mysqli_query($conn,$query);
    $nombre_proyecto = mysqli_fetch_array($resp);

    return $nombre_proyecto["nombre_proyecto"];

  }

  function listarProyectosPorIdCliente($id_cliente){
    global $conn;
    $query =  "SELECT nombre_proyecto,id FROM proyectos WHERE id_cliente =  ".$id_cliente."";
    $resp =  mysqli_query($conn, $query);
  
    return $resp;
  }

//editar proyectos
function editarPoryecto($nombre_proyecto,$estado_proyecto,$fecha_inicio,$fecha_termino,$id_cliente,$comentario,$id_proyecto){
  global $conn;
  $query = "UPDATE proyectos SET nombre_proyecto = '".$nombre_proyecto."', estado_proyecto = ".$estado_proyecto.", fecha_inicio = '".$fecha_inicio."', fecha_termino = '".$fecha_termino."', id_cliente = ".$id_cliente.", comentario = '".$comentario."' WHERE id =  ".$id_proyecto."";
  $resp =  mysqli_query($conn,$query);
  

  if($resp){
    return true;
  }else{
    return false;
  }

}

//crear encabezado cotizacion
function crearEncabezadoCotizacion($prestador_servicio,$id_cliente,$servicio,$boleta,$sub_total,$total,$total_sin_boleta,$id_proyecto){
  global $conn;
  $query = "INSERT INTO encabezado_cotizacion (id,prestador_servicio,cliente,servicio,boleta,sub_total,total,total_sin_boleta,id_proyecto)
            VALUES (NULL,'".$prestador_servicio."', '".$id_cliente."','".$servicio."',".$boleta.",'".$sub_total."','".$total."','".$total_sin_boleta."',".$id_proyecto.")";
  $resp = mysqli_query($conn,$query);
  
  if($resp){
    return  mysqli_insert_id($conn);
  }else{
    return false;
  }

}

//crear detalle cotizacion
function crearDetalleCotizacion($id_encabezado_cotizacion,$num_funcionalidad,$funcionalidad,$valor,$descripcion){
  global $conn;
  $query = "INSERT INTO detalle_cotizacion (id,id_encabezado_cotizacion,num_funcionalidad,funcionalidad,valor,descripcion)
            VALUES (NULL,".$id_encabezado_cotizacion.",".$num_funcionalidad.",'".$funcionalidad."','".$valor."','".$descripcion."')";
  $resp =  mysqli_query($conn,$query);

  if($resp){
    return true;
  }else{
    return false;
  }

}


//listar encabezado cotizacion
function listarEncabezadoCotizacion(){
  global $conn;
  $query =  "SELECT * FROM encabezado_cotizacion";
  $resp =  mysqli_query($conn,$query);
  
  return $resp;
}

//listar encabezado cotizacion por id
function listarEncabezadoCotizacionPorId($id_encabezado_cotizacion){
  global $conn;
  $query =  "SELECT * FROM encabezado_cotizacion WHERE id =  ".$id_encabezado_cotizacion."";
  $resp =  mysqli_query($conn,$query);
  $row  = mysqli_fetch_array($resp);
  
  return $row;
}

//listar detalle cotizacion
function listarDetalleCotizacion($id_encabezado_cotizacion){
  global $conn;
  $query =  "SELECT * FROM detalle_cotizacion WHERE id_encabezado_cotizacion =  ".$id_encabezado_cotizacion."";
  $resp =  mysqli_query($conn,$query);
  
  return $resp;
}




?>