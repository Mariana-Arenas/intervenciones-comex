<?php
require_once('../../config.php');
require_once('../../model/ncm.php');;
$ncm_model = new Model\ncm;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}
$result_ncm = $ncm_model->getbynombre($_POST['nombre']);

//print_r($result_ncm);
$json = array();
if ($result_ncm) {
foreach ($result_ncm as $key => $value) {
	$acciones = '<a href='.SITEROOT.'ncm/'.$value['valorcriterioId'].' class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
	$acciones .= '<a onclick="Eliminar('.$value['valorcriterioId'].');" class="btn btn-sm btn-outline-primary"><i class="fas fa-trash"></i></a>';
	$aux_data = array($value['pancm'],$value['descripcion_mercaderia'],'USD '.$value['valor_fob_dol'],$value['unidad_medida'],$value['grupopais'],$value['norma'],$acciones);
	$json[] = $aux_data;
	unset($aux_atributos,$aux2_atributos,$aux_data,$aux);
}
}
echo json_encode(array('json' => $json));

?>
