<?php


require_once 'PHP/class/class_shop.php';
$sh = new Shop();
$modo = isset($_COOKIE['modo']) ? $_COOKIE['modo'] : '';
echo '
<link rel="shortcut icon" href="ASSETS/IMG/icons/main-icon.png" type="image/x-icon">
</head>
<body class="' . ($modo === "dark-mode" ? "dark-mode" : "") . '">
    <nav id="menu">
        <input type="checkbox" id="responsive-menu" onclick="updatemenu()"><label></label>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="shop.php" class="dropdown-arrow">PRODUCTOS</a>
                <ul class="sub-menus">
                    <li><a href="shop.php#Skates">SKATES COMPLETOS</a></li>
                    <li><a href="shop.php#Tablas">TABLAS</a></li>
                    <li><a href="shop.php#Ruedas">RUEDAS</a></li>
                    <li><a href="shop.php#Rodamientos">RODAMIENTOS</a></li>
                    <li><a href="shop.php#Trucks">TRUCKS</a></li>
                </ul>

            </li>
';

if (!isset($_COOKIE["cliente"])) {
    echo '<li><a href="start_session.php">INICIAR SESION</a></li>';
}

echo '<li><a href="trolley.php"><img src="ASSETS/IMG/INDEX/anadir-a-la-cesta.png" alt=""></a></li>
      <li><a href="contact.php">CONTACTANOS</a></li>';

      if (isset($_COOKIE["cliente"])) {
        
        $cliente = json_decode($_COOKIE["cliente"], true);
        $email = $cliente['email'];
   
        $cliente = $sh->select_values('cliente', 'Nombre_cliente', "WHERE Correo_electronico_cliente = '$email'");
        $nombre = $cliente[0]['Nombre_cliente'];
        echo "<li><a href='user_account.php'>$nombre</a></li>";
    }
    

echo '<li><button id="cambiar_modo" class="button_change-mode" onclick="toggleColorMode()"><img src="../../ASSETS/IMG/ICONS/night.png" alt=""></button></li>
</ul>

    </nav>'
?>


<script>
  var body = document.body;
  var sections = document.getElementsByTagName("section");
  var button = document.getElementsByTagName("button")[0]; 
  var divs = document.getElementsByTagName("div");
  var modals = document.getElementsByClassName("modal");


  function toggleColorMode() {
    if (localStorage.getItem("colorMode") === "dark") {
      localStorage.setItem("colorMode", "light");
    
      light_mode()

      
    } else {
      localStorage.setItem("colorMode", "dark");
     
        dark_mode()
    
      
    }
  }

  if (localStorage.getItem("colorMode") === "dark") {
    document.addEventListener("DOMContentLoaded", function(event) {
        dark_mode()
      });
  } else {

    light_mode()
    
  }

  function light_mode(){
    button.innerHTML = '<img src="../../ASSETS/IMG/ICONS/night.png" alt="">';
      body.classList.remove("dark-mode");
      for (var i = 0; i < sections.length; i++) {
        sections[i].classList.remove("dark-mode_section-div");
        divs[i].classList.remove("dark-mode_section-div");
        for (var j = 0; j < modals.length; j++) {
          modals[j].classList.remove("dark-mode_modal");
        }
     
      }

  }

  function dark_mode(){
    button.innerHTML = '<img src="../../ASSETS/IMG/ICONS/day.png" alt="">';
      body.classList.add("dark-mode");
      for (var i = 0; i < sections.length; i++) {
        sections[i].classList.add("dark-mode_section-div");
        divs[i].classList.add("dark-mode_section-div");
        for (var j = 0; j < modals.length; j++) {
          modals[j].classList.add("dark-mode_modal");
        }
 
      }
  }



</script>

