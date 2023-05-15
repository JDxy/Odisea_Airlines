
<?php

echo '
<link rel="shortcut icon" href="../ASSETS/IMG/icons/main-icon.png" type="image/x-icon">
</head>
    <body>
        <nav id="menu">
        <input type="checkbox" id="responsive-menu" onclick="updatemenu()"><label></label>
            <ul>
              <li><a href="admin_index.php">HOME</a></li>
              <li><a href="admin_start_session.php">INICIAR SESION</a></li>
              ';
            ?>

            <?php
      
            if (isset($_SESSION['admin_name'])) {
              echo '
              <li><a class="dropdown-arrow">TABLAS</a>
                <ul class="sub-menus">
                  <li><a href="admin_show_table_clients.php">CLIENTES</a></li>
                  <li><a href="admin_show_table_products.php">PRODUCTOS</a></li>
                  <li><a href="admin_show_table_orders.php">PEDIDOS</a></li>
                </ul>

              </li>';
            };

            ?>

            
            <?php

            echo '</ul>
          </nav>';
          ?>
         


