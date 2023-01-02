<?php
require_once('../../config.php');

if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}

$_SESSION['comex']['archivoerror']['ID']=$_POST['archivodetalle'];
echo json_encode(array('status' => 'success','url' => SITEROOT.archivo_detalle));


?>
