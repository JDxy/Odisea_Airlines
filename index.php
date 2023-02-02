<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODISEA_AIRLINE</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/img/icons/avion.png" type="image/x-icon"> 
    <link rel="shortcut icon" href="assets/viajar.png" type="image/x-icon">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Odisea Airlines</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-primary" aria-current="page" href="PHP/PAGES/user_login.php">LOGIN USUARIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" href="PHP/PAGES/user_register.php">REGISTRARSE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" href="PHP/PAGES/admin_login.php">LOGIN ADMIN</a>
        </li>
        <?php if(isset($_COOKIE["admin"])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              ADMINISTRADOR
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="PHP/PAGES/admin_del_user.php">Eliminar cliente</a></li>
              <li><a class="dropdown-item" href="PHP/PAGES/admin_del_plane.php">Eliminar avion</a></li>
              <li><a class="dropdown-item" href="PHP/PAGES/admin_del_place.php">Eliminar destino</a></li>
              <li><a class="dropdown-item" href="PHP/PAGES/admin_new_place.php">Nuevo destino</a></li>
              <li><a class="dropdown-item" href="PHP/PAGES/admin_new_plane.php">Nuevo avion</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if(isset($_COOKIE["usuario"]) and !isset($_COOKIE["admin"])){ ?>
          <li class="nav-item">
            <a class="nav-link text-primary" href="PHP/PAGES/user_reserve_flight.php">RESERVAR UN VUELO</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-primary" href="PHP/PAGES/user_update_user.php">AJUSTES DE CUENTA</a>
          </li>
        <?php }else{
          echo '
          <li class="nav-item">
            <a class="nav-link text-secondary">RESERVAR UN VUELO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary">AJUSTES DE CUENTA</a>
          </li>';
          
        }?>
      </ul>
    </div>
  </div>
</nav>

<body id="page-top">
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">Odisea airlines</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">¡Tu aventura comienza aqui!</h2>
                       
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="about-section text-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Viaja a tus destinos soñados</h2>
                        <p class="text-white-50">
                           
                        </p>
                    </div>
                </div>
                <img class="img-fluid" src="../../../assets/img/lisbona-notte.jpg" alt="..." />
            </div>
        </section>
        <!-- Projects-->
        <section class="projects-section bg-light" id="projects">
            <div class="container px-4 px-lg-5">
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="../../../assets/img/representante-de-atención-al-pasajero-en-el-Aeropuerto.jpg" alt="..." /></div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <h4>SERVICIO DE ATENCION 24/7</h4>
                        </div>
                    </div>
                </div>
                <!-- Project One Row-->
                <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="../../../assets/img/adventure-ga5383f2ad_1920.jpg" alt="..." /></div>
                    <div class="col-lg-6">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">CUALQUIER LUGAR</h4>
                                    <p class="mb-0 text-white-50">Vive tu aventura en cualquier parte del mundo</p>
                                    <hr class="d-none d-lg-block mb-0 ms-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Project Two Row-->
                <div class="row gx-0 justify-content-center">
                    <div class="col-lg-6"><img class="img-fluid" src="../../../assets/img/escalator-gd22377d21_1920.jpg" alt="..." /></div>
                    <div class="col-lg-6 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">DISFRUTA CON TU FAMILIA Y AMIGOS</h4>
                                    <p class="mb-0 text-white-50">Tenemos precios rebajados si vas con mas personas de viaje</p>
                                    <hr class="d-none d-lg-block mb-0 me-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Signup-->
        <section class="signup-section" id="signup">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        
                      
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="contact-section bg-black">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">4923 Market Street, Orlando FL</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50"><a href="#!">odisea@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">+1 (555) 902-8832</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>


    <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Odisea airlines 2022</div></footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</html>