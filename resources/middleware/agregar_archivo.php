<?php
require_once('../../config.php');
require_once('../../model/archivo.php');
require_once('../../model/cotizacion.php');

if (!isset($_SESSION['comex']['usuario']['ID'])) {
    echo "sin permisos";
die();
}

$archivo_model = new Model\archivo;
$cotizacion_model = new Model\cotizacion;

$archivo['ncm'] = trim($_POST['ncm']);
$archivo['origen'] = trim($_POST['origen']);
$archivo['fob'] = trim($_POST['fob']);
$archivo['cantidad'] = trim($_POST['cantidad']);
$archivo['peso_neto'] = trim($_POST['peso_neto']);
$archivo['fob_buscar'] = trim($_POST['fob_buscar']);
$archivo['fob_buscar_maximo'] = trim($_POST['fob_buscar_maximo']);
$archivo['codigomoneda'] = trim($_POST['codigomoneda']);
$archivo['codigo_articulo'] = trim($_POST['codigo_articulo']);
$archivo['descripcion_articulo'] = trim($_POST['descripcion_articulo']);
$archivo['intervencion_mostrar'] = trim($_POST['intervencion_mostrar']);
$archivo['gravamenes_todos'] = trim($_POST['gravamenes_todos']);




//$usuario['imagen_perfil'] = trim($_POST['imagen_perfil']);
$validacion_archivo = 0;
foreach ($archivo as $key => $value) {
if ($value == '') {
$validacion_archivo++;
}
}
if ($validacion_archivo > 0) {
    //print_r($archivo);
    echo json_encode(array('status' => 'error','mensaje'=>'Los Campos resaltados son obligatorios'));
    die();
}



$archivo['gravamenes'] = trim($_POST['gravamenes_seleccionados']);

$archivo_fisico="";
    $img = $_FILES["image"]["name"]; //stores the original filename from the client
    $tmp = $_FILES["image"]["tmp_name"]; //stores the name of the designated temporary file
    $errorimg = $_FILES["image"]["error"]; //stores any error code resulting from the transfer

    if ($img!="")
    {
        if (!MoverImagen($archivo_fisico))
        {
            echo json_encode(array('status' => 'error','mensaje'=>'El archivo no se ha podido cargar.'));
            die();
        }
    }else{
        echo json_encode(array('status' => 'error','mensaje'=>'Falta seleccionar el archivo.'));
            die();
    }

$archivo['nombrearchivo']=str_replace('.xlsx',null,$img);
$archivo['archivofisico']=$archivo_fisico;

$cotizacion_result= $cotizacion_model->GetCotizacionMoneda($archivo['codigomoneda']);

if ($cotizacion_result==null)
{
    echo json_encode(array('status' => 'error','mensaje'=>'No se pudo obtener la cotización. Intente más tarde.'));
    die();
}else{
    $archivo['cotizacion']=$cotizacion_result['valor'];

}



$archivo_result = $archivo_model->agregar_archivo_usuario_vc($archivo['ncm'],
                                                             $archivo['origen'],
                                                             $archivo['fob'],
                                                             $archivo['cantidad'],
                                                             $archivo['peso_neto'],
                                                             $archivo['fob_buscar'],
                                                             $archivo['fob_buscar_maximo'],
                                                             $archivo['nombrearchivo'],
                                                             $archivo['archivofisico'],
                                                             $archivo['codigomoneda'],
                                                             $archivo['cotizacion'],
                                                             $archivo['codigo_articulo'],
                                                             $archivo['descripcion_articulo'],
                                                             $archivo['gravamenes'],
                                                             $archivo['intervencion_mostrar'],
                                                             $archivo['gravamenes_todos']
                                                            );
if ($archivo_result==null)
{
    // $mailingresult=$mailing_model->EnviarMailNuevoUsuario($usuario['nombre'],$usuario['apellido'],$usuario['email'],$tokenenviarmail);
    // if ($mailingresult)
    // {
         echo json_encode(array('status' => 'success','url' => SITEROOT.'archivo'));
    // }else{
    //     echo json_encode(array('status' => 'error','mensaje'=>'Se ha dado de alta el archivo pero no se pudo enviar el email con el aviso'));
    //     die();
    // }
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$archivo_result));
    die();
}


function MoverImagen(& $archivo_fisico)
{
    $valid_extensions = array('xlsx'); // valid extensions
    $path = '../../uploads/archivo_usuario/'; // upload directory
    if(!empty($_POST['name']) ||  $_FILES['image'])
    {
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $nombre=str_replace('.xlsx',null,$img);
        $archivo_fisico = strtolower($nombre.rand(1000,1000000).'.xlsx');
        // check's valid format
        if(in_array($ext, $valid_extensions)) 
        { 
            $path = $path.strtolower($archivo_fisico); 
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
