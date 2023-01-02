<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
ini_set('memory_limit','512M');
define('IN_PHP', true);

require_once('database.php');

 
class gravamen{

    function getbynombre($NOMBRE){
        $db = database::getInstance();
        $SQL = "SELECT * FROM valorgravamenes 
        ORDER BY valorgravamenid asc";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    } 
    function getbyncm($NCM){
        $db = database::getInstance();
        $SQL = "SELECT * FROM valorgravamenes 
        where ncm='$NCM'";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetch();
    }        

}
?>
