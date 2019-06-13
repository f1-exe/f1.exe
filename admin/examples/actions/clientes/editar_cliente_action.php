<?php

include '../../funciones_admin/funciones.php';

if($_POST["tipo"] == 0){

    $id_cliente =  $_POST["id_cliente"];
    $nombre_cliente = $_POST["nombre_cliente"];
    $email_cliente = $_POST["email_cliente"];
    $telefono_cliente = $_POST["telefono_cliente"];
    $nombre_representante = $_POST["nombre_representante"];
    $logo_empresa = $_POST["logo_empresa"];


    if(isset($nombre_cliente) && !empty($nombre_cliente)){
        if(strlen($nombre_cliente) <= 100){
            if(isset($email_cliente) && !empty($email_cliente)){
                if(filter_var($email_cliente, FILTER_VALIDATE_EMAIL)){
                    if(strlen($email_cliente <= 100)){
                        if(strlen($telefono_cliente) == 9){
                            if(is_numeric($telefono_cliente)){
                                if(isset($nombre_representante) && !empty($nombre_representante)){
                                    if(strlen($nombre_representante) <= 100){
                                        if(subirIMG()){
                                            if(editarClienteConImagen($id_cliente,$nombre_cliente,$email_cliente,$telefono_cliente,$nombre_representante,$logo_empresa)){
                                                echo "Se ha editado el cliente correctamente";
                                            }else{
                                                echo "Error en la base de datos al editar el cliente";
                                            }
                                            
                                        }else{
                                            echo 'Error al guardar la imagen, verifique la extension del archivo o que el peso no exceda 4 MB';
                                        }
                                    }else{
                                        echo "El largo del nombre del representante debe ser 100 o menor";
                                    }
            
                                }else{
                                    echo "El campo nombre del representante es obligatorio";
                                }
            
                            }else{
                                echo "Debe ingresar solo números en para indicar el teléfono";
                            }
                        }else{
                            echo "El campo teléfono debe contener 9 dígitos";
                        }

                    }else{
                        echo 'El largo del email debe ser de hasta 100 carácteres';
                    }
                }else{
                    echo 'El campo email no es válido, considere el formato ejemplo@dominio.cl';
                }
            }else{
                echo "El campo email es obligatorio";
            }

        }else{
            echo "El campo nombre debe tener un largo maximo de 100";
        }

    }else{
        echo "El campo nombre es obligatorio";
    }

}else{

    $id_cliente =  $_POST["id_cliente"];
    $nombre_cliente = $_POST["nombre_cliente"];
    $email_cliente = $_POST["email_cliente"];
    $telefono_cliente = $_POST["telefono_cliente"];
    $nombre_representante = $_POST["nombre_representante"];

    if(editarClienteSinImagen($id_cliente,$nombre_cliente,$email_cliente,$telefono_cliente,$nombre_representante)){
        echo "Se ha editado el cliente correctamente";
    }else{
        echo "Error en la base de datos al editar el cliente";

    }


}

function subirIMG(){
    $ruta = '../../img_clientes/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
    $respuesta = false;
   
    foreach ($_FILES as $key){ //Iteramos el arreglo de archivos
        if($key['error'] == UPLOAD_ERR_OK ){//Si el archivo se paso correctamente Ccontinuamos

            $NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
            $temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
            $Destino = $ruta.$NombreOriginal;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
            
            move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada
        }
    
        if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
            {
                $respuesta = true;
            }
        if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
            {
                $respuesta = false; 
            }
    }

    return $respuesta;
}

?>