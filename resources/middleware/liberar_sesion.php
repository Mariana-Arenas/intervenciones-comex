<?php
require_once('../../config.php');
require_once('../../model/usuario.php');;

if (!isset($_SESSION['comex']['usuario']['ID'])) {
    if (!isset($_SESSION['comex']['usuario']['IDtemporal'])) {
        echo "sin permisos";
        die();
    }else{
        $codigousuario=$_SESSION['comex']['usuario']['IDtemporal'];
    }
}else{
    $codigousuario=$_SESSION['comex']['usuario']['ID'];
}

$usuario_model = new Model\usuario;

$usuario_result = $usuario_model->actualizaripconexion($codigousuario,null);

if ($usuario_result==null)
{
    session_destroy();
echo json_encode(array('status' => 'success'));
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$usuario_result));
    die();
}
function validarseleccionoption(& $valor)
{
if (!isset($valor))
{
return null;
}
return $valor;
}



?>
