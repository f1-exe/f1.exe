Vue.component('modal',{
    template://html
    `
    <div>
        <div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="modalRequestLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalRequestLabel">Solicitar cotización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="#">
                            <div class="form-group">
                                <!-- <label for="appointment_name" class="text-black">Full Name</label> -->
                                <input type="text" class="form-control" id="appointment_name" placeholder="Nombre & Apellido">
                            </div>
                            <div class="form-group">
                                <!-- <label for="appointment_email" class="text-black">Email</label> -->
                                <input type="text" class="form-control" id="appointment_email" placeholder="Correo Electrónico">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- <label for="appointment_date" class="text-black">Date</label> -->
                                        <input type="text" class="form-control" id="appointment_date" placeholder="Fecha">
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- <label for="appointment_time" class="text-black">Time</label> -->
                                        <input type="text" class="form-control" id="appointment_time" placeholder="Hora">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <!-- <label for="appointment_message" class="text-black">Message</label> -->
                                <textarea name="" id="appointment_message" class="form-control" cols="30" rows="10" placeholder="Mensaje"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Enviar Cotización" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `
});

Vue.component('navbar',{
    template://html 
    `
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
            <a class="navbar-brand" href="index.html">F1.EXE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li v-for="(item, index) in items" class="nav-item" :class="{'active' : item.active}"><a :href="item.ref" @click="estado(index)" class="nav-link">{{item.name}}</a></li>
                    <li class="nav-item cta"><a href="contacto.html" class="nav-link" data-toggle="modal" data-target="#modalRequest"><span>Cotizar</span></a></li>
                </ul>
            </div>
            </div>
        </nav>
    </div>
    `,
    data(){
        return{
            items: [
                {name: 'Inicio', ref: 'index.html', active: true},
                {name: 'Nosotros', ref: 'nosotros.html',active: false},
                {name: 'Servicios', ref: 'servicios.html', active: false},
                {name: 'Testimonios', ref: 'testimonios.html', active: false},
                {name: 'Equipo', ref: 'equipo.html', active: false},
                {name: 'Contacto', ref: 'contacto.html', active: false}
            ]
        }
    },
    methods: {
        estado(index){
            localStorage.clear();

            for(var i = 0; i < this.items.length; i+=1){
                this.items[i].active = false;
            }
            
            this.items[index].active = true;
            localStorage.setItem('datos-navbar', JSON.stringify(this.items));
            //console.log(this.items);
        }
    },
    created: function(){
        let datos = JSON.parse(localStorage.getItem('datos-navbar'));
        if(datos === null){
            datos = this.items;
        }else{
            this.items = datos;
        }
    }
});

Vue.component('futer',{
    template://html
    `
    <div>
        <footer class="ftco-footer ftco-bg-dark ftco-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">F1.EXE</h2>
                            <p>
                               Da el primer paso en ésta era digital de la mano de este gran equipo.  
                            </p>
                        </div>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft ">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                        </div>
                        <div class="col-md-2">
                        <div class="ftco-footer-widget mb-4 ml-md-5">
                            <h2 class="ftco-heading-2">Menú</h2>
                            <ul class="list-unstyled">
                            <li><a href="nosotros.html" class="py-2 d-block">Nosotros</a></li>
                            <li><a href="servicios.html" class="py-2 d-block">Servicios</a></li>
                            <li><a href="testimonios.html" class="py-2 d-block">Testimonios</a></li>
                            <li><a href="equipo.html" class="py-2 d-block">Equipo</a></li>
                            <li><a href="contacto.html" class="py-2 d-block">Contacto</a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="col-md-4 pr-md-4">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Trabajos recientes</h2>
                            <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/felmat_foo.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="testimonios.html">Felmat Seguridad</a></h3>
                                <!--<div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Sept 15, 2018</a></div>
                                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>-->
                            </div>
                            </div>
                            <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="testimonios.html">Nayer-Desayunos</a></h3>
                                <!--<div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> Sept 15, 2018</a></div>
                                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>-->
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Información de contacto</h2>
                            <div class="block-23 mb-3">
                                <ul>
                                    <li><span class="icon icon-map-marker"></span><span class="text">Río Madeira 1259, Conchalí, Santiago, Chile</span></li>
                                    <li><a href="tel://+56975144189"><span class="icon icon-phone"></span><span class="text">+56 9 7514 4189</span></a></li>
                                    <li><a href="mailto:contactof1.exe@gmail.com"><span class="icon icon-envelope"></span><span class="text">contactof1.exe@gmail.com</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>Copyright &copy;2019 Todos los derechos reservados | Esta plantilla esta hecha con <i class="icon-heart" aria-hidden="true"></i> por <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    `
});

var navbar = new Vue({
    el: '#navbar'
});

var futer = new Vue({
    el: '#futer'
});

var modal = new Vue({
    el: '#modal'
});