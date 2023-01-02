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

$ncm['idncm'] = trim($_POST['ncm']);
$ncm['ncm'] = $ncm['idncm'];
$ncm['descripcion'] = 'combinacion sin valor criterio';
$ncm['fob'] = '0';
$ncm['unidadmedida'] = 'no corresponde';

$ncm['norma'] = 'no corresponde';

$objgrupos=$grupopais_model->GetsGruposDistintosNcmPaisFaltante($ncm['idncm']);


$ncm['grupopais'] =$objgrupos[0]["grupoID"];

$validacion_ncm = 0;
foreach ($ncm as $key => $value) {
if ($value == '') {
    $validacion_ncm++;
    
}
}

if ($validacion_ncm > 0) {
   // print_r($ncm);
   if ($ncm['grupopais']!=null)
    {
        echo json_encode(array('status' => 'error','mensaje'=>'faltan datos para avanzar con la acción seleccionada'));
    }else{
        echo json_encode(array('status' => 'error','mensaje'=>'El campo Origen, no coincide con ningun Pais configurado en el sistema'));
    }
    
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
