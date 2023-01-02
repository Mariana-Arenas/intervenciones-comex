<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
// define('IN_PHP', true);

require_once('database.php');


class home{


function gethome(){
    $db = database::getInstance();
    $SQL = "SELECT * FROM home limit 1";
   // echo $SQL;
    $db->query($SQL);
    return $db->fetch();
}


function editar ($id,$titulo,$subtitulo,$link,$banner){
    $db = database::getInstance();
 
    $campo_imagen="";
    if (strlen($banner)>0)
    {
        $campo_imagen=",banner='$banner' ";
    }
    
    $SQL = "update home set titulo='$titulo',subtitulo='$subtitulo',link='$link' ".$campo_imagen."  where idhome='$id'";
    
    $resultado= $db->query($SQL);
    

    return $resultado;

}
}
?>
