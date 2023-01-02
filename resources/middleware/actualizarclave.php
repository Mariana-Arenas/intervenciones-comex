<?php
require_once('../../config.php');
require_once('../../model/usuario.php');;
if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}

$usuario_model = new Model\usuario;
$usuario['clave'] = trim($_POST['cambiarclave']);


//$usuario['imagen_perfil'] = trim($_POST['imagen_perfil']);
$validacion_usuario = 0;
foreach ($usuario as $key => $value) {
if ($value == '') {
$validacion_usuario++;
}
}
if ($validacion_usuario > 0) {
    //print_r($usuario);
    echo json_encode(array('status' => 'error','mensaje'=>'Falta que ingrese la nueva clave'));
    die();
}

checkPassword($usuario['clave'],$errors);

if ($errors!="")
{
    echo json_encode(array('status' => 'error','mensaje'=>$errors));
    die();
}

// print_r($usuario);
// die();

$usuario_result = $usuario_model->cambiarclave(md5($usuario['clave']) );

if ($usuario_result==null)
{
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

 function checkPassword($pwd, &$errors) {
    $errors_init = $errors;

    if (strlen($pwd) < 8) {
        $errors[] = "La clave debe tener minimo 8 caracteres!<br>";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors[] = "Por lo menos debe contener 1 numero!<br>";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors[] = "Por lo menos debe contener una letra!<br>";
    }     

    return ($errors == $errors_init);
}


?>
