<?php
require_once('../../config.php');
require_once('../../model/ncm.php');


if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}
$ncm_model = new Model\ncm;
$ncm['idncm'] = trim($_POST['idncm']);
$ncm['ncm'] = trim($_POST['ncm']);
$ncm['descripcion'] = trim($_POST['descripcion']);
$ncm['fob'] = trim($_POST['fob']);
$ncm['unidadmedida'] = trim($_POST['unidadmedida']);
$ncm['grupopais'] = trim($_POST['grupopais']);
$ncm['norma'] = trim($_POST['norma']);


$validacion_ncm = 0;
foreach ($ncm as $key => $value) {
if ($value == '') {
$validacion_ncm++;
}
}
if ($validacion_ncm > 0) {
    //print_r($ncm);
    echo json_encode(array('status' => 'error','mensaje'=>'Los Campos resaltados son obligatorios'));
    die();
}

$ncm_result = $ncm_model->agregar_faltantes($ncm['idncm'],$ncm['ncm'] ,$ncm['descripcion'],$ncm['fob'],$ncm['unidadmedida'],$ncm['grupopais'],$ncm['norma']  );
if ($ncm_result==null)
{
    echo json_encode(array('status' => 'success','url' => SITEROOT.'ncm_faltantes'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$ncm_result));
    die();
}

?>
