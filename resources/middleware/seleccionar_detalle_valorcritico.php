<?php
require_once('../../config.php');
require_once('../../model/archivo.php');


if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();

}
$archivo_model = new Model\archivo;
$archivo['valorcritico'] = trim($_POST['valorcritico']);
$archivo['ncm'] = trim($_POST['ncm']);
$archivo['archivodetalleid']=trim($_POST['idncm']);

// print_r($archivo);
// die();
$validacion_archivo = 0;
foreach ($archivo as $key => $value) {
if ($value == '') {
$validacion_archivo++;
}
} 
if ($validacion_archivo > 0) {
    //print_r($archivo);
    echo json_encode(array('status' => 'error','mensaje'=>'Los Campos resaltados son obligatorios'));
    die();
}
$obj_seleccion= $archivo_model->GetValorCriterioById($archivo['valorcritico']);

$obj_archivodetalle= $archivo_model->getDetallebyID($archivo['archivodetalleid']);

//  print_r($obj_archivodetalle);
//   die();

$archivo_result = $archivo_model->editarDetalleSeleccion($obj_seleccion['valor_fob_dol'],$obj_seleccion['unidad_medida'] ,$archivo['ncm'],$obj_archivodetalle['archivoId']  );
if ($archivo_result==null)
{
    echo json_encode(array('status' => 'success','url' => SITEROOT.'archivo_detalle'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$archivo_result));
    die();
}

?>
