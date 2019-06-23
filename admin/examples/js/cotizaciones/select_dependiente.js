$(document).ready(function(){
    $('#cliente').on('change',function(){
        var id_cliente = $(this).val();
        if(id_cliente){
            $.ajax({
                type:'POST',
                url:'actions/cotizaciones/select_dependiente.php',
                data:'id_cliente='+id_cliente,
                success:function(html){
                    $('#proyecto').html(html);
                    
                }
            }); 
        }else{
            $('#proyecto').html('<option value="0">Seleccione proyecto primero</option>');
           
        }
    });
    
    
});
