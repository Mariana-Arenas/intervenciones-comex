<?php
require_once('../../config.php');
require_once('../../model/parametria.php');

if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}

$parametria_model = new Model\parametria;
$parametria['tipo_archivo'] = trim($_POST['tipo_archivo']);

//$usuario['imagen_perfil'] = trim($_POST['imagen_perfil']);
$validacion_parametria = 0;
foreach ($parametria as $key => $value) {
if ($value == '') {
$validacion_parametria++;
}
}
if ($validacion_parametria > 0) {
    //print_r($usuario);
    echo json_encode(array('status' => 'error','mensaje'=>'Los Campos resaltados son obligatorios'));
    die();
}
    switch ($parametria['tipo_archivo']) {
        case 'NC':
            $parametro='CARGA_NCM';
            $path = '../../uploads/ncm/'; // upload directory
            $nombre_guardar='NCM.xlsx';
            break;
        case 'GP':
            $parametro='CARGA_GRUPO_PAIS';
            $path = '../../uploads/grupopais/'; // upload directory
            $nombre_guardar='GrupoPais.xlsx';
            break;
        case 'GV':
            $parametro='CARGA_GRAVAMEN';
            $path = '../../uploads/gravamen/'; // upload directory
            $nombre_guardar='Gravamen.xlsx';
            break;
        case 'IV':
            $parametro='CARGA_INTERVENCION';
            $path = '../../uploads/intervencion/'; // upload directory
            $nombre_guardar='Intervencion.xlsx';
            break;
        default:
            # code...
            break;
    }

    $img = $_FILES["image"]["name"]; //stores the original filename from the client
    $tmp = $_FILES["image"]["tmp_name"]; //stores the name of the designated temporary file
    $errorimg = $_FILES["image"]["error"]; //stores any error code resulting from the transfer

    if ($img!="")
    {
        if (!MoverImagen($parametria['tipo_archivo'],$path,$nombre_guardar))
        {
            echo json_encode(array('status' => 'error','mensaje'=>'El archivo no se ha podido cargar.'));
            die();
        }
    }else{
        echo json_encode(array('status' => 'error','mensaje'=>'Falta seleccionar el archivo.'));
            die();
    }

    
    


$parametria_result = $parametria_model->activar_carga_archivo($parametro);
if ($parametria_result==null)
{
    // $mailingresult=$mailing_model->EnviarMailNuevoUsuario($usuario['nombre'],$usuario['apellido'],$usuario['email'],$tokenenviarmail);
    // if ($mailingresult)
    // {
         echo json_encode(array('status' => 'success','url' => SITEROOT.dashboard));
    // }else{
    //     echo json_encode(array('status' => 'error','mensaje'=>'Se ha dado de alta el archivo pero no se pudo enviar el email con el aviso'));
    //     die();
    // }
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$parametria_result));
    die();
}


function MoverImagen($tipo_archivo,$path,$nombre_guardar)
{
    $valid_extensions = array('xlsx'); // valid extensions
    
    if(!empty($_POST['name']) ||  $_FILES['image'])
    {
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        
        
        // check's valid format
        if(in_array($ext, $valid_extensions)) 
        { 
            $path = $path.$nombre_guardar; 
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
