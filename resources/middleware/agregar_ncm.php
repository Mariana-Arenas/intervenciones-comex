<?php
require_once('../../config.php');
require_once('../../model/ncm.php');
require_once('../../model/grupopais.php');


if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}
$ncm_model = new Model\ncm;
$grupopais_model = new Model\grupopais;
$ncm['ncm'] = trim($_POST['ncm']);
$ncm['descripcion'] = trim($_POST['descripcion']);
$ncm['fob'] = trim($_POST['fob']);
$ncm['unidadmedida'] = trim($_POST['unidadmedida']);
$ncm['pais'] = trim($_POST['pais']);
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

$grupopais_result = $grupopais_model->GetGrupoPais($ncm['pais']);

$ncm_result = $ncm_model->agregar($ncm['ncm'] ,$ncm['descripcion'],$ncm['fob'],$ncm['unidadmedida'],$grupopais_result['grupopais'],$ncm['norma']  );
if ($ncm_result==null)
{
    echo json_encode(array('status' => 'success','url' => SITEROOT.'ncm'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$ncm_result));
    die();
}

?>
