<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODISEA_AIRLINE</title>
    <link rel="stylesheet" href="../../../CSS/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="assets/img/icons/avion.png" type="image/x-icon"> 
    <link rel="shortcut icon" href="../../assets/viajar.png" type="image/x-icon">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../../index.php">Odisea Airlines</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-primary" aria-current="page" href="user_login.php">LOGIN USUARIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" href="user_register.php">REGISTRARSE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" href="admin_login.php">LOGIN ADMIN</a>
        </li>
        <?php if(isset($_COOKIE["admin"])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-primary" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              ADMINISTRADOR
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="admin_del_user.php">Eliminar cliente</a></li>
              <li><a class="dropdown-item" href="admin_del_plane.php">Eliminar avion</a></li>
              <li><a class="dropdown-item" href="admin_del_place.php">Eliminar destino</a></li>
              <li><a class="dropdown-item" href="admin_new_place.php">Nuevo destino</a></li>
              <li><a class="dropdown-item" href="admin_new_plane.php">Nuevo avion</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if(isset($_COOKIE["usuario"]) and !isset($_COOKIE["admin"])){ ?>
          <li class="nav-item">
            <a class="nav-link text-primary" href="user_reserve_flight.php">RESERVAR UN VUELO</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-primary" href="user_update_user.php">AJUSTES DE CUENTA</a>
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
<!-- CREAR APARTADO PARA ADMINS EN EL CUAL PUEDA ELIMINAR HACER SUS FUNCIONES -->

