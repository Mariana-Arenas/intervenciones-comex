<?php
require_once('../../config.php');
require_once('../../model/cotizacion.php');;
$cotizacion_model = new Model\cotizacion;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}
$result_cotizacion= $cotizacion_model->getbynombre($_POST['nombre']);

//print_r($result_usuario);
$json = array();
if ($result_cotizacion) {
foreach ($result_cotizacion as $key => $value) {

$acciones="";

$actualizar='Manual';
if ($value['automatico']==1)
{
	$actualizar='Automatico';
}
	$acciones = '<a href='.SITEROOT.'cotizacion/'.$value['codigopais'].' class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';

$aux_data = array($value['codigopais'],$value['pais'],$value['moneda'],'USD '.$value['cotizaciondolar'],$actualizar, $acciones);
$json[] = $aux_data;
unset($aux_atributos,$aux2_atributos,$aux_data,$aux);
}
}
echo json_encode(array('json' => $json));

?>
