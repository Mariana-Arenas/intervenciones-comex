<?php
require_once('../../config.php');
require_once('../../model/cotizacion.php');


if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}
$cotizacion_model = new Model\cotizacion;
$cotizacion['idcodigopais'] = trim($_POST['idcodigopais']);
$cotizacion['codigopais'] = trim($_POST['codigopais']);
$cotizacion['pais'] = trim($_POST['pais']);
$cotizacion['cotizacion'] = trim($_POST['cotizacion']);
$cotizacion['automatico'] = trim($_POST['automatico']);
$cotizacion['moneda'] = trim($_POST['moneda']);


$validacion_cotizacion = 0;
foreach ($cotizacion as $key => $value) {
if ($value == '') {
$validacion_cotizacion++;
}
}
if ($validacion_cotizacion > 0) {
    print_r($cotizacion);
    echo json_encode(array('status' => 'error','mensaje'=>'Los Campos resaltados son obligatorios'));
    die();
}

$cotizacion_result = $cotizacion_model->editar($cotizacion['idcodigopais'],$cotizacion['codigopais'] ,$cotizacion['pais'],$cotizacion['cotizacion'],$cotizacion['automatico'],$cotizacion['moneda']);
if ($cotizacion_result==null)
{
    echo json_encode(array('status' => 'success','url' => SITEROOT.'cotizacion'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$cotizacion_result));
    die();
}

?>
