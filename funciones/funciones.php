<?php

include '../conexion/BDconexion.php';

//reCaptcha
function getCaptcha($secreKey){

  $url = "https://www.google.com/recaptcha/api/siteverify?secret=6Le3VIkUAAAAAO60G-COdGNRLA6fPFq_sRSKKtOA&response={$secreKey}";
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  $file_contents = curl_exec($ch);
  curl_close($ch);
  $json =  json_decode($file_contents);
  return $json;
}


//funcion de correo
function enviarCorreo($mail_user, $nombre, $asunto, $tipo , $noti){
  require_once 'lib/sm/lib/swift_required.php';

  $pEmailGmail = 'contacto@felmatseguridad.cl';

  $pPasswordGmail = 'Felmatseguridad2018.';

  $pFromName = 'Felmat Contacto'; //display name



  $pTo = trim($mail_user);

  $pSubjetc = $asunto;



  $template = '';



  if($tipo == 1){

    $template = 'plantillas/mailCliente.html';

  }else if($tipo == 2){

    $template = 'plantillas/mailFelmat.html';

  }else if($tipo == 3){

    $template = 'plantillas/mailFelmatNoti.html';

  }

  

  $pBody = file_get_contents($template);



  if($tipo == 1){

    $pBody = str_replace("#USUARIO#", $nombre, $pBody);

  }else if($tipo == 2){

    $pBody = str_replace("#CLIENTE#", $nombre, $pBody);

  }else if($tipo == 3){

    $pBody = str_replace("#CLIENTE#", $nombre, $pBody);

    $pBody = str_replace("#NUMERO#", $noti, $pBody);

  }



  $transport = Swift_SmtpTransport::newInstance('mail.felmatseguridad.cl', 587, 'tls')

          ->setUsername($pEmailGmail)

          ->setPassword($pPasswordGmail);



  $mMailer = Swift_Mailer::newInstance($transport);

  $mEmail = Swift_Message::newInstance();

  $mEmail->setSubject($pSubjetc);

  $mEmail->setTo($pTo);

  

  $mEmail->setFrom(array($pEmailGmail => $pFromName));

  $mEmail->setBody($pBody, 'text/html');



  if($mMailer->send($mEmail) == 1){

    return true;

  }else{

    return false;

  }

}



//obtener nombre de usuario
function obtieneNombre($usuario){
  global $conn;
  $nombre="";
  $query = "SELECT nombre FROM usuario WHERE usuario = '".$usuario."'";
  $resp = mysqli_query($conn, $query);
  while($row = mysqli_fetch_row($resp)){
    $nombre = $row[0];
  }
    return $nombre;
}



function registrarUsuario($nombre, $usuario, $clave, $tipo_usuario, $foto, $cargo){

  global $conn;

  $query = "INSERT INTO usuario (nombre, usuario, clave, tipo, foto, cargo) VALUES ('".$nombre."','".$usuario."','".$clave."',".$tipo_usuario.",'".$foto."',".$cargo.")";

  $resp = mysqli_query($conn, $query);



  if($resp){

    echo "SI";

    return true;

  }else{

    echo "NO".mysqli_error($conn);

    return false;

  }

}


//insertar mensaje de contacto
function insertarContacto($nombre, $email, $telefono, $mensaje){
  global $conn;
  $query = "INSERT INTO contacto (nombre, correo, telefono, mensaje, fecha_registro) VALUES ('".$nombre."','".$email."','".$telefono."','".$mensaje."',NULL)";
  $resp = mysqli_query($conn, $query);

  if($resp){
    return true;
  }else{
    echo "NO".mysqli_error($conn);
    return false;
  }
}

//insertar cotizaciones
function insertarCotizacion($nombre,$email,$telefono,$tipo,$detalle){
  global $conn;
  $query = "INSERT INTO cotizacion (nombre, correo, telefono, tipo, detalle, fecha_registro) VALUES ('".$nombre."','".$email."',".$telefono.",".$tipo.",'".$detalle."',NULL)";
  $resp = mysqli_query($conn, $query);

  if($resp){
    return true;
  }else{
    echo "NO".mysqli_error($conn);
    return false;
  }
}


function notificaciones(){
  global $conn;
  $noti = '';
  $query = "SELECT COUNT(*) FROM contacto WHERE gestion = 0";
  $resp = mysqli_query($conn, $query);
  while($row = mysqli_fetch_row($resp)){
    $noti = $row[0];
  }
    return $noti;
}

