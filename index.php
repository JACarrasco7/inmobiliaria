<?php

require_once 'Controllers/plantillaController.php';
require_once 'Controllers/ofertasController.php';
require_once 'Controllers/imagenesController.php';


require_once 'Models/ofertasModel.php';

$plantilla = new plantillaController();

$plantilla->ctrPlantilla();
