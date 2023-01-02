<?php
require_once('view/agregar_archivo.php');
require_once('model/cotizacion.php');
require_once('model/archivo.php');
$v = new View\agregar_archivo;

$cotizacion_model = new Model\cotizacion;
$archivo_model = new Model\archivo;

$v->monedacotizacion= $cotizacion_model->GetMonedaCotizacion();

$v->archivo= $archivo_model->GetParametriaUsuarioTipoArchivo('VC',$_SESSION['comex']['usuario']['ID']);
$v->nav = $nav;
$v->render();
?>
