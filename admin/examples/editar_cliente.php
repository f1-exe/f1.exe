<?php 
include 'funciones_admin/funciones.php';

$id =  $_GET["id"];
$row =  listarClientesPorId($id);

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>F1.exe - Clientes | Panel de administración</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.ico" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">

  <link rel="stylesheet" href="../assets/css/animate.css">

  <!-- SWAL CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="../index.php">
        <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Settings</span>
            </a>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Activity</span>
            </a>
            <a href="profile.php" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Support</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" onclick="logoutAdmin()" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../index.php">
                <img src="../assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
         <!-- Navigation -->
         <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contactos.php">
              <i class="ni ni-bullet-list-67 text-red"></i> Contactos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cotizaciones.php">
              <i class="ni ni-check-bold text-blue"></i> Cotizaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes.php">
              <i class="ni ni-single-02 text-blue"></i> Clientes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="proyectos.php">
              <i class="ni ni-archive-2 text-orange"></i> Proyectos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="wiki.php">
              <i class="ni ni-ruler-pencil text-red"></i> Wiki
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cotizacion.php">
              <i class="ni ni-single-copy-04 text-info"></i> Generar Cotización
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <i class="ni ni-circle-08 text-red"></i> Perfil de usuario
            </a>
          </li> 
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Documentation</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
              <i class="ni ni-spaceship"></i> Getting started
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
              <i class="ni ni-palette"></i> Foundation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
              <i class="ni ni-ui-04"></i> Components
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Clientes</a>
        
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Jessica Jones</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="profile.php" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="profile.php" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="profile.php" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="profile.php" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" onclick="logoutAdmin()" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Volver</h5>
                      <span class="h2 font-weight-bold mb-0">Clientes</span>
                    </div>
                    <div class="col-auto">
                        <a href="clientes.php"> 
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-list-ul"></i>
                            </div>
                        </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card bg-secondary shadow">
                          <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                              <div class="col-8">
                                <h3 class="mb-0">Editar cliente</h3>
                              </div>
                            </div>
                          </div>
                          <div class="card-body">
                            <form id="form_cliente" name="form_cliente" method="POST" enctype="multipart/form-data" action="">
                              <h6 class="heading-small text-muted mb-4">información del cliente</h6>
                              <div class="pl-lg-4">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" for="input-username">Nombre Cliente</label>
                                      <input type="text" id="nombre_cliente" class="form-control form-control-alternative" placeholder="Empresa Spa" value="<?php echo $row["nombre_cliente"];?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" for="input-email">Email contacto</label>
                                      <input type="email" id="email_cliente" class="form-control form-control-alternative" placeholder="jesse@example.com" value="<?php echo $row["email_cliente"];?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" for="input-first-name">Teléfono</label>
                                      <input type="text" id="telefono_cliente" class="form-control form-control-alternative" placeholder="569 1234 5678" value="<?php echo $row["telefono_cliente"];?>">
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label" for="input-last-name">Nombre representante</label>
                                      <input type="text" id="nombre_representante" class="form-control form-control-alternative" placeholder="Jessica Rojas" value="<?php echo $row["nombre_representante"];?>">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <hr class="my-4" />
                              <!-- Address -->
                              <h6 class="heading-small text-muted mb-4">Imagen</h6>
                              <div class="pl-lg-4">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="form-control-label" for="input-address">Logo de la empresa</label>
                                      <input id="logo_empresa" type="file" class="form-control form-control-alternative">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <img  src="img_clientes/<?php echo $row["logo_cliente"];?>" alt="imagen empresa" wdth="200" height="300">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="pl-lg-4">
                                <div class="form-group">
                                    <button id="btn_guardar" class="btn btn-info">Guardar</button>
                                    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $row["id"];?>">  
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                </div>
            </div>
        <!-- Page content -->
    
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
  <script src="js/logout.js"></script>
  <script src="js/clientes/editar_cliente.js"></script>
</body>

</html>