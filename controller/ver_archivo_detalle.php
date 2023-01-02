<?php
require_once('view/ver_archivo_detalle.php');
require_once('model/archivo.php');
$v = new View\ver_archivo_detalle;
$v->nav = $nav;

$model_archivo= new Model\archivo;


$v->id=$ID;
$v->detalle= $model_archivo->getDetallebyID($ID);
$v->render();
?>
