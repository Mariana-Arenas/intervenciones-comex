<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

class log{

   

    function registrar_log_cron ($proceso){
        $db = database::getInstance();

        $SQL = "insert into  log_cron(proceso) values ('$proceso')";
             
       //echo $SQL;
        $resultado=$db->query($SQL);

       
        return $resultado;

    }


}
?>
