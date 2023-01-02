<?php
require_once('view/ver_archivo.php');
require_once('model/archivo.php');
$v = new View\ver_galeria;

$objarchivo = new Model\archivo;

$v->archivo  = $objarchivo->getById($ID);
$v->nav = $nav;
$v->render();
?>




