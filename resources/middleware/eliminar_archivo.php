<?php
require_once('../../config.php');
require_once('../../model/archivo.php');
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}



$archivo_model = new Model\archivo;

$archivoid = trim($_POST['archivoid']);


$archivo_result = $archivo_model->eliminar($archivoid);
if ($archivo_result==null)
{
    echo json_encode(array('status' => 'success','url' => SITEROOT.'archivo'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$archivo_result));
    die();
}



?>
