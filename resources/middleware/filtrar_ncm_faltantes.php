<?php
require_once('../../config.php');
require_once('../../model/ncm.php');;
$ncm_model = new Model\ncm;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}
$result_ncm = $ncm_model->getfaltantebynombre($_POST['nombre']);

//print_r($result_ncm);
$json = array();
if ($result_ncm) {
foreach ($result_ncm as $key => $value) {
	
	$ncm=substr(str_replace(".","",$value['ncm']),0,8);	
	$funcion="MarcarNoValida('$ncm')";
	$acciones = '<a href='.SITEROOT.'ncm_faltantes/'.$ncm.' class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
	$acciones .= ' <a href="#" onclick='.$funcion.' class="btn btn-sm btn-outline-warning"><i class="fas fa-ban"></i></a>';
	$aux_data = array($value['ncm'],$value['origen'],$acciones);
	$json[] = $aux_data;
	unset($aux_atributos,$aux2_atributos,$aux_data,$aux);
}
}
echo json_encode(array('json' => $json));

?>
