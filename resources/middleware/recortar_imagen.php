<?php
 error_reporting( E_ALL );
 ini_set('display_errors', 1);
//define('IN_PHP', true);
require_once('../../config.php');
require_once('../../model/usuario.php');;

$usuario_model = new Model\usuario;

$imagen_perfil="";
$img = $_FILES["image"]["name"]; //stores the original filename from the client
$tmp = $_FILES["image"]["tmp_name"]; //stores the name of the designated temporary file
$errorimg = $_FILES["image"]["error"];

$ubicacion=croppicture();

    echo json_encode(array('status' => 'success','mensaje' =>$ubicacion));

function croppicture ()
{
    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    $path = '../../uploads/temporal/'; // upload directory
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
                return "uploads/temporal/".$imagen_perfil; 
            }
        } 
        else 
        {
          return false;
        }
    }

    //no hace falta porque se hace desde la hoja de estilo -->class="profile"
    // $filename = $path;
    // $image_s = imagecreatefromstring(file_get_contents($filename));
    // $width = imagesx($image_s);
    // $height = imagesy($image_s);
    // $newwidth = 285;
    // $newheight = 285;
    // $image = imagecreatetruecolor($newwidth, $newheight);
    // imagealphablending($image, true);
    // imagecopyresampled($image, $image_s, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    // //create masking
    // $mask = imagecreatetruecolor($newwidth, $newheight);
    // $transparent = imagecolorallocate($mask, 255, 0, 0);
    // imagecolortransparent($mask,$transparent);
    // imagefilledellipse($mask, $newwidth/2, $newheight/2, $newwidth, $newheight, $transparent);
    // $red = imagecolorallocate($mask, 0, 0, 0);
    // imagecopymerge($image, $mask, 0, 0, 0, 0, $newwidth, $newheight, 100);
    // imagecolortransparent($image,$red);
    // imagefill($image, 0, 0, $red);
    // //output, save and free memory
    // //header('Content-type: image/png');
    // imagepng($image);
    // imagepng($image,$imagen_perfil);
    // imagedestroy($image);
    // imagedestroy($mask);
    // return "uploads/temporal/".$imagen_perfil;

}
?>
