<?php
require_once('../../config.php');
require_once('../../model/usuario.php');;
$usuario_model = new Model\usuario;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}
$result_usuario = $usuario_model->getbynombre($_POST['nombre']);

//print_r($result_usuario);
$json = array();
if ($result_usuario) {
foreach ($result_usuario as $key => $value) {
$estado=1;
$icono_estado="fa fa-thumbs-up";
if ($value['idestado']==1)
{
	$estado=2;
	$icono_estado="fa fa-thumbs-down";
}
$acciones="";
if ($value['usuarioID']!=$_SESSION['comex']['usuario']['ID'])
{
	$acciones = '<a href='.SITEROOT.'usuario/'.$value['usuarioID'].' class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
	$acciones .= '<a onclick="CambiarEstado('.$value['usuarioID'].','.$estado.');" class="btn btn-sm btn-outline-primary"><i class="'.$icono_estado.'"></i></a>';
}

$aux_data = array($value['email'],$value['nombre'],$value['apellido'],$value['estado'],$value['nombre_rol'],$value['fecha_creacion'], $acciones);
$json[] = $aux_data;
unset($aux_atributos,$aux2_atributos,$aux_data,$aux);
}
}
echo json_encode(array('json' => $json));

?>
