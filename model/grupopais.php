<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

 
class grupopais{

    function getbynombre($NOMBRE){
        $db = database::getInstance();
        $SQL = "SELECT * FROM grupospaises 
        ORDER BY GrupoID asc";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }
    //obtiene las diferentes monedas para ir a buscar su cotizacion a la api
    function GetsGruposDistintos(){
        $db = database::getInstance();
       
        $SQL = "SELECT distinct grupoID FROM grupospaises order by grupoID asc  ";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

    function GetsPaisesDistintos(){
        $db = database::getInstance();
       
        $SQL = "SELECT distinct Pais FROM pais_moneda order by Pais asc  ";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

    function GetGrupoPais(){
        $db = database::getInstance();
       
        $SQL = "SELECT grupoID FROM grupospaises order by Pais asc  ";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetch();
    }
    function GetsGruposDistintosNcmPaisFaltante($ncm){
        $db = database::getInstance();
       
        $SQL = "SELECT distinct grupoID from grupospaises 
                where  (pais in (SELECT distinct origen FROM  archivousuario_detalle where substr(replace(ncm,'.',''),1,8)='$ncm') or
                  codigo in (SELECT distinct origen FROM  archivousuario_detalle where substr(replace(ncm,'.',''),1,8)='$ncm') )
                    and  GrupoID not in (select grupopais 
                    from valorcriterios where pancm='$ncm') 
                    order by grupoID asc  ";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

}
?>
