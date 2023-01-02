<?php
require_once('view/archivo_detalle.php');
$v = new View\archivo_detalle;
$v->nav = $nav;
$v->render();
?>
