<?php
require_once('view/ver_cotizacion.php');
require_once('model/cotizacion.php');
$v = new View\ver_cotizacion;

$objcotizacion = new Model\cotizacion;

$v->cotizacion  = $objcotizacion->getById($ID);
$v->moneda = $objcotizacion->GetMonedasCotizar();
$v->nav = $nav;
$v->render();
?>




