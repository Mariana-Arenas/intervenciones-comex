<?php
 error_reporting( E_ALL );
 ini_set('display_errors', 1);
//define('IN_PHP', true);
require_once('../../config.php');



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

   

}
?>
