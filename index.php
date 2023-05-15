<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina principal</title>
  <link rel="stylesheet" href="CSS/index_style.css">
  <link rel="stylesheet" href="CSS/menu&footer_style.css">
  <?php
require_once 'PHP/class/class_shop.php';
require_once 'PHP/parts/header.php';
?>

    <header>
      <h1>ADRENALINE OLLIE</h1>
    </header>
    <section class="section-1"> 
        <p>Nacimos como una marca por y para skaters</p>
        <h2>Nuestra marca</h2>

        <img class="mobile_image" src="ASSETS/IMG/INDEX/skateboard-316565-removebg-preview.png" alt="">
        <img class="desktop_image" src="ASSETS/IMG/INDEX/skater.png" alt="">
    </section>
    

    
    <section class="section-2"> 
        <h2>Nuestros diseños</h2>
        <div class="slider">
            <img src="ASSETS/IMG/skates/skate1.png" alt="" class="slide active">
            <img src="ASSETS/IMG/skates/skate2.png" alt="" class="slide">
            <img src="ASSETS/IMG/skates/skate3.png" alt="" class="slide">
        </div>
 
    </section>

    <section class="section-3"> 
        <h2>Haz tu propio skate</h2>
        <p>Crea tu skate con tu propio diseño desde cero
            y personaliza tu skate con las mejores marcas
          </p>
        <div>

          <img  src="ASSETS/IMG/INDEX/marcas/pngwing.com (4).png" alt="">
          <img  src="ASSETS/IMG/INDEX/marcas/pngwing.com (6).png" alt="">
          <img  src="ASSETS/IMG/INDEX/marcas/pngwing.com (5).png" alt="">
        </div>

        <img class="main-img mobile_image" src="ASSETS/IMG/INDEX/best-skateboard-brands-decks-trucks-wheels.jpg" alt="">
        <img class="main-img desktop_image" src="ASSETS/IMG/INDEX/piezas.png" alt="">

      </section>
    <script src="JS/index_script.js"></script>
<?php
  require_once 'PHP/parts/footer.php';
?>