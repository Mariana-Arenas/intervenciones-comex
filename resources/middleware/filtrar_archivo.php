<?php
require_once('../../config.php');
require_once('../../model/archivo.php');;
$archivo_model = new Model\archivo;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}

$result_archivo = $archivo_model->getbynombre($_POST['nombre'],$_POST['opcion_filtro']);

//print_r($result_archivo);
$json = array();
if ($result_archivo) {
foreach ($result_archivo as $key => $value) {

	$acciones="";
	if ($value['procesado']==0)
	{
		$procesado="Pendiente";
	}

	if ($value['procesado']==1)
	{
		$procesado="Finalizado";
		$archivo="uploads/archivo_usuario/resultado_".$value["archivo_fisico"];
		$acciones = '<a onclick="Descargar(\''.$archivo.'\')"  class="btn btn-sm btn-outline-primary"><i class="fas fa-cloud-download-alt"></i></a>';
	}

	if ($value['procesado']==2)
	{
		$procesado="Procesado con Errores";
		$acciones = '<a href="#" onclick="Seleccionar_Archivo('.$value['archivoId'].');" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
		$acciones .= ' <a onclick="Eliminar('.$value["archivoId"].')"  class="btn btn-sm btn-outline-warning"><i class="fas fa-trash"></i></a>';
	}


$aux_data = array($value['nombre_archivo'],$value['fecha_creacion'],$value['codigomoneda'],$value['cotizacion'],$procesado,$acciones);
$json[] = $aux_data;
unset($aux_atributos,$aux2_atributos,$aux_data,$aux);
}
}
echo json_encode(array('json' => $json));

?>
