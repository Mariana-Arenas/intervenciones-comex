<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

class parametria{

    function GetPendienteProcesar(){
        $db = database::getInstance();
       
        $SQL = "SELECT * FROM parametria  
        where parametriaID in ('CARGA_GRUPO_PAIS','CARGA_NCM','CARGA_INTERVENCION','CARGA_GRAVAMEN') and valor=1";
        
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
        }


    function activar_carga_archivo ($parametro){
        $db = database::getInstance();

        $SQL = "update  parametria set
                valor=1,
                fecha_carga=null,
                fecha_fin=null
                where parametriaID='$parametro'";
       //echo $SQL;
        $resultado=$db->query($SQL);

       
        return $resultado;

    }

    function inicio_carga_archivo ($parametro){
        $db = database::getInstance();
        $fecha=  date('d/m/Y H:i:s');
        $SQL = "update  parametria set
                fecha_carga=str_to_date('$fecha','%d/%m/%Y %H:%i:%s')
                where parametriaID='$parametro'";
      // echo $SQL;
        $resultado=$db->query($SQL);

       
        return $resultado;

    }

    function fin_carga_archivo ($parametro){
        $db = database::getInstance();
        $fecha=  date('d/m/Y H:i:s');
        $SQL = "update  parametria set
                fecha_fin=str_to_date('$fecha','%d/%m/%Y %H:%i:%s'),
                valor=0
                where parametriaID='$parametro'";
       //echo $SQL;
        $resultado=$db->query($SQL);

       
        return $resultado;

    }

    

}
?>
