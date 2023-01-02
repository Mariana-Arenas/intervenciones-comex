<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

 
class unidadmedida{

    //obtiene las diferentes monedas para ir a buscar su cotizacion a la api
    function Gets(){
        $db = database::getInstance();
       
        $SQL = "SELECT * FROM unidad_medida order by unidad_medida asc  ";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

}
?>
