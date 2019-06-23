<?php

include '../../funciones_admin/funciones.php';

if(isset($_POST["id_cliente"]) && !empty($_POST["id_cliente"])){
    
    $id_cliente =  $_POST["id_cliente"];
   
    $listarProyectosPorIdCliente =  listarProyectosPorIdCliente($id_cliente);

    while ($row = mysqli_fetch_array($listarProyectosPorIdCliente)){
        
        if($row["nombre_proyecto"] == ""){
            echo '<option value="0">No se ha agregado proyecto al cliente</option>';
        }else{
            echo '<option value="'.$row['id'].'">'.$row['nombre_proyecto'].'</option>';
        }
        
    }
   
}else{

    echo '<option value="0">Seleccione proyecto</option>';
}

?>