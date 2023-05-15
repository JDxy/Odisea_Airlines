<?php


if (isset($_POST["add_trolley"])) {
  $cantidad = 1;
  $producto = [$_POST["ID_producto"], $_POST["Img_producto"], $_POST["Nombre_producto"], $_POST["precio"], $cantidad];

  if (isset($_COOKIE['trolley'])) {
    $lista = json_decode($_COOKIE['trolley'], true);
    $producto_existente = false;
    foreach ($lista as $key => $value) {
      if ($value[0] == $producto[0]) {
        $producto_existente = true;
        $lista[$key][4] += 1;
        break;
      }
    }
    if (!$producto_existente) {
      array_push($lista, $producto);
    }
  } else {
    $lista = array($producto);
  }

  setcookie('trolley', json_encode($lista), time()+3600); 
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="CSS/shop_style.css">

    <link rel="stylesheet" href="CSS/menu&footer_style.css">

<?php
require_once 'PHP/parts/header.php';
?>




<img class="etiqueta" src="ASSETS/IMG/STORE/etiqueta.png" alt="">

<div class="slider">

    <?php
      
      $producto = $sh->select_values('Producto', 'Img_producto', 'ORDER BY ID_producto DESC LIMIT 3');
      foreach ($producto as $key => $value) {
        echo '<img src="' . substr($value['Img_producto'],3) . '" alt="" class="slide">';
      }
    ?>

  </div>




<div class="productos">
</div>

<!-- Sección para los skates -->

<section>
<h2 id="Skates">Skates</h2>
  <?php
  
  $sh->show_products('SKATE');
  ?>
</section>

<!-- Sección para las tablas -->


<section>
<h2 id="Tablas">Tablas</h2>
  <?php
    $sh->show_products('TABLA');
  ?>
</section>

<!-- Sección para las ruedas -->


<section>
<h2 id="Ruedas">Ruedas</h2>
  <?php
    $sh->show_products('RUEDAS');
  ?>
</section>

<!-- Sección para los rodamientos -->

<section>
<h2 id="Rodamientos">Rodamientos</h2>

  <?php
    $sh->show_products('RODAMIENTOS');
  ?>
</section>

<!--  Sección para los trucks -->


<section>
<h2 id="Trucks">Trucks</h2>
  <?php
    $sh->show_products('TRUCKS');
  ?>
</section>
</div>

<script>
// Get all trigger buttons
var buttons = document.querySelectorAll('[data-modal]');

// Get all modals
var modals = document.querySelectorAll('.modal');

// Get all close buttons
var closeBtns = document.querySelectorAll('.close');

// Add click event listener to all trigger buttons
buttons.forEach(function(button) {
  button.addEventListener('click', function() {
    var modalId = this.getAttribute('data-modal');
    var modal = document.getElementById(modalId);
    modal.style.display = 'block';
  });
});

// Add click event listener to all close buttons
closeBtns.forEach(function(closeBtn) {
  closeBtn.addEventListener('click', function() {
    modals.forEach(function(modal) {
      modal.style.display = 'none';
    });
  });
});

// Add click event listener to window to close modals when clicking outside of them
window.addEventListener('click', function(event) {
  if (event.target.classList.contains('modal')) {
    modals.forEach(function(modal) {
      modal.style.display = 'none';
    });
  }
});
</script>

<script src="JS/shop_script.js"></script>

<?php
 require_once 'PHP/parts/footer.php';

?>