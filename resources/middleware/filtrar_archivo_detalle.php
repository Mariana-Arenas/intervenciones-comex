<?php
require_once('../../config.php');
require_once('../../model/archivo.php');;
$archivo_model = new Model\archivo;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}
$result_archivo = $archivo_model->getDetallebynombre($_POST['nombre'],$_POST['opcion_filtro']);

//print_r($result_archivo);
$json = array();
if ($result_archivo) {
foreach ($result_archivo as $key => $value) {

	$acciones="";
	$resuelve='Administrador';
	if ($value['error_num']==0)
	{
		$resuelve='Reprocesar';
	}
	if ($value['avisar_admin']==0 && $value['error_num']!=0 )
	{
		$resuelve='Usuario';
		$acciones = '<a href='.SITEROOT.'archivo_detalle/'.$value['archivodetalleId'].' class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
	}

$aux_data = array($value['fila'],$value['ncm'],$value['origen'],$value['fob'],
$value['cantidad'],$value['codigo_articulo'],$value['descripcion_articulo'],
$value['peso'],$value['descripcion_error'],$resuelve,$acciones);
$json[] = $aux_data;
unset($aux_atributos,$aux2_atributos,$aux_data,$aux);
}
}
echo json_encode(array('json' => $json));

?>
