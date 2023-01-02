<?php
require_once('../../config.php');
require_once('../../model/usuario.php');;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}


$usuario_model = new Model\usuario;
$usuario['idusuario'] = trim($_POST['idusuario']);
$usuario['nombre'] = trim($_POST['nombre']);
$usuario['apellido'] = trim($_POST['apellido']);
$usuario['email'] = trim($_POST['email']);
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
    //print_r($objusuarioexistente);
    if ($objusuarioexistente["usuarioID"]!=$usuario['idusuario'])
    {
        echo json_encode(array('status' => 'error','mensaje'=>'ya existe un usuario para esta cuenta de correo.'));
        die();
    }
   
}




// print_r($usuario);
// die();

$usuario_result = $usuario_model->editar($usuario['idusuario'],$usuario['nombre'] ,$usuario['apellido'],$usuario['email'],$usuario['celular'] ,$usuario['cuit'],$usuario['cargo'],$usuario['razon_social']);

if ($usuario_result==null)
{
echo json_encode(array('status' => 'success','url' => SITEROOT.'usuario'));
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

function MoverImagen(& $imagen_perfil)
{
    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = '../../img/'; // upload directory
    if(!empty($_POST['name']) ||  $_FILES['image'])
    {
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $imagen_perfil = strtolower(rand(1000,1000000).$img);
        // check's valid format
        if(in_array($ext, $valid_extensions)) 
        { 
            $path = $path.strtolower($imagen_perfil); 
            if(move_uploaded_file($tmp,$path)) 
            {
                return true;
            }
        } 
        else 
        {
          return false;
        }
    }
}


?>
