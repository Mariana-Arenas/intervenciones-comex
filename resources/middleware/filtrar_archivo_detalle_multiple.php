<?php
require_once('../../config.php');
require_once('../../model/archivo.php');
$archivo_model = new Model\archivo;

if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}

//echo "valor:".$_POST['idncm'];
$result_archivo = $archivo_model->GetValorCriterioSeleccionarUsuario($_POST['nombrebuscar'],$_POST['idncm']);

//print_r($result_archivo);
$json = array();
if ($result_archivo) {
	foreach ($result_archivo as $key => $value) {
		$acciones = ' <a href="#" onclick="seleccionar('.$value["valorcriterioId"].')" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
		$aux_data = array($value['valor_fob_dol'],$value['descripcion_mercaderia'],$value['unidad_medida'],$acciones);
		$json[] = $aux_data;
		unset($aux_atributos,$aux2_atributos,$aux_data,$aux);
	}
}
echo json_encode(array('json' => $json));

?>
