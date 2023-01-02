<?php
require_once('../../config.php');
require_once('../../model/usuario.php');
require_once('../../model/mailing.php');
if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}


$usuario_model = new Model\usuario;
$mailing_model = new Model\mailing;
$usuario['id'] = trim($_POST['id']);
$usuario['estado'] = trim($_POST['estado']);


//$usuario['imagen_perfil'] = trim($_POST['imagen_perfil']);
$validacion_usuario = 0;
foreach ($usuario as $key => $value) {
if ($value == '') {
$validacion_usuario++;
}
}
if ($validacion_usuario > 0) {
    //print_r($usuario);
    echo json_encode(array('status' => 'error','mensaje'=>'Los Campos resaltados son obligatorios'));
    die();
}



$objusuarioexistente= $usuario_model->getbyID($usuario['id']);
if ($objusuarioexistente)
{
    //sigue de largo
}else{
    echo json_encode(array('status' => 'error','mensaje'=>'no se ha encontrado el usuario seleccionado.'));
    die();
}
// print_r($usuario);
// die();

$usuario_result = $usuario_model->cambiarestado($usuario['id'] ,$usuario['estado'] );
if ($usuario_result==null)
{
    if ($objusuarioexistente['temporal']==1)
    {
        $tokenenviarmail=md5($objusuarioexistente['email'].rand(1000,1000000));
        $tokenaccesotemporal=md5($tokenenviarmail);
       // echo "enviar:".$tokenenviarmail."temporal:".$tokenaccesotemporal;
        $usuario_model->cambiarclaveAdmin($usuario['id'] ,$tokenaccesotemporal );
        $mailingresult=$mailing_model->EnviarMailNuevoUsuario($objusuarioexistente['nombre'],$objusuarioexistente['apellido'],$objusuarioexistente['email'],$tokenenviarmail);
        if ($mailingresult)
        {
            echo json_encode(array('status' => 'success','url' => SITEROOT.'usuario'));
        }else{
            echo json_encode(array('status' => 'error','mensaje'=>'Se ha habilitado el usuario pero no se pudo enviar el email con los datos de acceso.'));
            die();
        }
    }else{
        echo json_encode(array('status' => 'success','url' => SITEROOT.'usuario'));
    }
    
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$usuario_result));
    die();
}




?>
