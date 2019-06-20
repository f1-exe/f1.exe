function modal(logo,nombre_proyecto,fecha_incio, fecha_termino,comentario){
    Swal({
        title: '<h1>Detalle proyecto</h1>',
        imageUrl: 'img_clientes/'+logo,
        html:'<div class="container" style="text-align:left;">'+
         '<div class="row">'+
         '<div class="col-md-5">Nombre: </div> <div class="col-md-7">'+nombre_proyecto+'</div>'+
            '<div class="col-md-5">Fecha inicio: </div> <div class="col-md-7">'+fecha_incio+'</div>'+
            '<div class="col-md-5">Fecha término: </div> <div class="col-md-7">'+fecha_termino+'</div>'+
            '<div class="col-md-5">Observaciones: </div> <div class="col-md-7">'+comentario+'</div>'+
         '</div>'+
         '</div>',
        imageWidth: 300,
        imageHeight: 200,
        imageAlt: 'Logo cliente',
        animation: true
      });
}