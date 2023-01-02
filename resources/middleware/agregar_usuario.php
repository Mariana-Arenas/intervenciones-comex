<?php
require_once('../../config.php');
require_once('../../model/usuario.php');
require_once('../../model/mailing.php');

if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}


$mailing_model= new Model\mailing;
$usuario_model = new Model\usuario;

$usuario['nombre'] = trim($_POST['nombre']);
$usuario['apellido'] = trim($_POST['apellido']);
$usuario['email'] = trim($_POST['email']);
// $usuario['password'] = trim($_POST['password']);
$usuario['celular'] = trim($_POST['celular']);
$usuario['cuit'] = trim($_POST['cuit']);
$usuario['cargo'] = trim($_POST['cargo']);
$usuario['razon_social'] = trim($_POST['razon_social']);


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

$objusuarioexistente= $usuario_model->getUsuarioByEmail($usuario['email']);
if (!$objusuarioexistente)
{
    //sigue de largo
}else{
    echo json_encode(array('status' => 'error','mensaje'=>'ya existe un usuario para esta cuenta de correo.'));
    die();
}

$tokenenviarmail=md5($usuario['email'].rand(1000,1000000));
$tokenaccesotemporal=md5($tokenenviarmail);
$usuario_result = $usuario_model->agregar($usuario['nombre'] ,
                                              $usuario['apellido'],
                                              $usuario['email'],
                                              $usuario['celular'],
                                              $usuario['cuit'],
                                              $usuario['cargo'],
                                              $usuario['razon_social'],
                                              $tokenenviarmail );
if ($usuario_result==null)
{
    $mailingresult=$mailing_model->EnviarMailNuevoUsuario($usuario['nombre'],$usuario['apellido'],$usuario['email'],$tokenenviarmail);
    if ($mailingresult)
    {
        echo json_encode(array('status' => 'success','url' => SITEROOT.'usuario'));
    }else{
        echo json_encode(array('status' => 'error','mensaje'=>'Se ha generado el usuario pero no se pudo enviar el email con los datos de acceso.'));
        die();
    }
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
