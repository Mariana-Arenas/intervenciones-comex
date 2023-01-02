<?php
//  error_reporting( E_ALL );
//  ini_set('display_errors', 1);
//define('IN_PHP', true);
require_once('../../config.php');
require_once('../../model/usuario.php');
require_once('../../model/mailing.php');

$usuario_model = new Model\usuario;
$mailing_model = new Model\mailing;
$imagen_perfil="";


    $imagen_perfil="";
    $img = $_FILES["image"]["name"]; //stores the original filename from the client
    $tmp = $_FILES["image"]["tmp_name"]; //stores the name of the designated temporary file
    $errorimg = $_FILES["image"]["error"]; //stores any error code resulting from the transfer

    if ($img!="")
    {
        if (!MoverImagen($imagen_perfil))
        {
            echo json_encode(array('status' => 'error','mensaje'=>'La imagen no se ha podido cargar.'));
            die();
        }
    }

$usuario['nombre'] = trim($_POST['nombre']);
$usuario['apellido'] = trim($_POST['apellido']);
$usuario['email'] = trim($_POST['email']);
// $usuario['password'] = trim($_POST['password']);
$usuario['celular'] = trim($_POST['celular']);
$usuario['cuit'] = trim($_POST['cuit']);
$usuario['cargo'] = trim($_POST['cargo']);
$usuario['razon_social'] = trim($_POST['razon_social']);
  
$validacion_usuario = 0;
$campo="";
foreach ($usuario as $key => $value) {
    if ($value == '') {
        $campo=$usuario;
        $validacion_usuario++;
    }
}
if ($validacion_usuario > 0) {
  // print_r($usuario);
    echo json_encode(array('status' => 'error','mensaje'=>'campos marcados con * incompletos'));
    die();
}

$usuario['imagen_perfil'] = trim($imagen_perfil);

$objusuarioexistente= $usuario_model->getUsuarioByEmail($usuario['email']);
if ($objusuarioexistente)
{
    echo json_encode(array('status' => 'error','mensaje'=>'El email ingresado ya se encuentra registrado'));
    die();
}

$tokenenviarmail=md5($usuario['email'].rand(1000,1000000));
$tokenaccesotemporal=md5($tokenenviarmail);
$usuario_result = $usuario_model->registrar($usuario['nombre'] ,
                                              $usuario['apellido'],
                                              $usuario['email'],
                                              $usuario['celular'],
                                              $usuario['cuit'],
                                              $usuario['cargo'],
                                              $usuario['razon_social'],
                                              $tokenenviarmail );
if ($usuario_result==null)
{
    $mailingresult=$mailing_model->EnviarMailNuevoUsuarioAvisoAdmin($usuario['email'],$usuario['nombre'],$usuario['apellido'],$usuario['razon_social']);
   
    echo json_encode(array('status' => 'success','mensaje'=>'Se ha generado el usuario correctamente y ahora quedará en estado de revisión.','url'=>'ingresar'));
    die();
    
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
    $path = '../../uploads/usuarios/'; // upload directory
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

 function validaRut ( $rutCompleto ) {
	if ( !preg_match("/^[0-9]+-[0-9kK]{1}/",$rutCompleto)) return false;
		$rut = explode('-', $rutCompleto);
		return strtolower($rut[1]) == dv($rut[0]);
	}
 function dv ( $T ) {
		$M=0;$S=1;
		for(;$T;$T=floor($T/10))
			$S=($S+$T%10*(9-$M++%6))%11;
		return $S?$S-1:'k';
	}

    function EdadActual ( $fechanacimiento) {
    
     //   echo $fechanacimiento;
     $brithdate = explode('/', $fechanacimiento);
    $brithdateFormated = $brithdate[2] . "-" . $brithdate[1] . "-" . $brithdate[0];
    
        $date1 = new DateTime($brithdateFormated);
        $date2 = new DateTime(date("Y-m-d"));
        $diff = $date1->diff($date2);
       return $diff->y;

    }
?>
