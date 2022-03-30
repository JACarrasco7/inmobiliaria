<?php

include 'views/modules/header.php';

if (isset($_GET['ruta'])) {
    $accion = $_GET['ruta'];
    include "views/modules/" . $accion . ".php";
} else {
    include "views/modules/inicio.php";
}



include 'views/modules/footer.php';
