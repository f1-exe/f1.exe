function modal(nombre,telefono,representante,correo,logo){
    Swal({
        title: '<h1>Perfil cliente</h1>',
        imageUrl: 'img_clientes/'+logo,
        html:'<div class="container" style="text-align:left;">'+
         '<div class="row">'+
         '<div class="col-md-5">Nombre: </div> <div class="col-md-7">'+nombre+'</div>'+
            '<div class="col-md-5">Representante: </div> <div class="col-md-7">'+representante+'</div>'+
            '<div class="col-md-5">Teléfono: </div> <div class="col-md-7">'+telefono+'</div>'+
            '<div class="col-md-5">Email: </div> <div class="col-md-7">'+correo+'</div>'+
         '</div>'+
         '</div>',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Logo cliente',
        animation: true
      });
}