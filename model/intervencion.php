<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
ini_set('memory_limit','512M');
define('IN_PHP', true);

require_once('database.php');

 
class intervencion{

    function getbynombre($NOMBRE){
        $db = database::getInstance();
        $SQL = "SELECT * FROM valorintervencion
        ORDER BY valorintervencionid asc";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    } 
    function getbyncm($NCM){
        $db = database::getInstance();
        $SQL = "SELECT * FROM valorintervencion 
        where ncm='$NCM'";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetch();
    }        

}
?>
