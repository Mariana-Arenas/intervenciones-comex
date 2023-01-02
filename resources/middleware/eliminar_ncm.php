<?php
require_once('../../config.php');
require_once('../../model/ncm.php');
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}



$ncm_model = new Model\ncm;

$idncm = trim($_POST['id']);


$ncm_result = $ncm_model->eliminar($idncm);
if ($ncm_result==null)
{
    echo json_encode(array('status' => 'success','url' => SITEROOT.'ncm'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$ncm_result));
    die();
}



?>
