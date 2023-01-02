<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

 
class cotizacion{

    function getbynombre($NOMBRE){
        $db = database::getInstance();
        $usuarioID=$_SESSION['comex']['usuario']['ID'];
        $SQL = "SELECT pm.codigopais,pm.pais,pm.moneda, c.cotizaciondolar,c.automatico 
        FROM pais_moneda pm inner join cotizacion c on pm.moneda=c.moneda
        where  (pm.codigopais like '%$NOMBRE%' or pm.pais like '%$NOMBRE%'  or pm.moneda like '%$NOMBRE%') ";
        $SQL.=" ORDER BY pm.pais desc";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
        }

    function getbyID($ID){
        $db = database::getInstance();
        $SQL = "SELECT pm.codigopais,pm.pais,pm.moneda, c.cotizaciondolar ,c.automatico
        FROM pais_moneda pm inner join cotizacion c on pm.moneda=c.moneda
        where  pm.codigopais='$ID'";
        $db->query($SQL);
        return $db->fetch();
    }

    //obtiene las diferentes monedas para ir a buscar su cotizacion a la api
    function GetMonedasCotizar(){
        $db = database::getInstance();
       
        $SQL = "SELECT distinct moneda FROM cotizacion order by moneda asc ";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

    function GetMonedasCotizarCron(){
        $db = database::getInstance();
       
        $SQL = "SELECT distinct moneda FROM cotizacion  where automatico=1 order by moneda asc ";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }
    
    function GetCotizacionPais($codigopais){
        $db = database::getInstance();
       
        $SQL = "SELECT c.cotizaciondolar as valor FROM pais_moneda pm inner join cotizacion c on pm.moneda=c.moneda where pm.codigoPais=$codigopais";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetch();
    }

    function GetCotizacionMoneda($codigomoneda){
        $db = database::getInstance();
       
        $SQL = "SELECT c.cotizaciondolar as valor FROM  cotizacion c where moneda='$codigomoneda'";
       
        //echo $SQL;
        $db->query($SQL);

        return $db->fetch();
    }
    
    function GetPaisMonedaCotizacion(){
        $db = database::getInstance();
        
        $SQL = "SELECT pm.codigopais, concat(pm.pais,' (',pm.moneda,') ','USD ',c.cotizaciondolar) as paismonedacotizacion FROM pais_moneda pm inner join cotizacion c on pm.moneda=c.moneda order by pm.pais asc ";
        
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
        }

        function GetMonedaCotizacion(){
            $db = database::getInstance();
            
            $SQL = "SELECT  moneda, concat(moneda ,' USD ',cotizaciondolar) as cotizacion FROM  cotizacion   order by moneda asc ";
            
            //echo $SQL;
            $db->query($SQL);
    
            return $db->fetchAll();
            }
    
        
    

    function cron_procesar_cotizacion ($objarchivo){
        $db = database::getInstance();
         $resultado="";
         $db->Begintransaction();
        
        foreach ($objarchivo as $key => $value) {

            $moneda=$value->moneda;
            $valor=$value->valor;
            $fecha=$value->fecha;

            $SQL = "update  cotizacion set
                    cotizaciondolar='$valor',
                    fecha =str_to_date('$fecha','%d/%m/%Y %H:%i:%s')
                    where moneda='$moneda'";
            //echo $SQL;
            $resultado=$db->queryTransaction($SQL,0);
            if ($resultado!="")
            {
                break;
            }
        }
        
        if ($resultado=="")
        {
            $db->Committransaction(); 
        }else{
            $db->RollBacktransaction();
        }
        
            
        
        return $resultado;

    }

    function editar ($idcodigopais,$codigopais,$pais,$cotizacion,$automatico,$moneda){
        $db = database::getInstance();
         $resultado="";
         $db->Begintransaction();
    
            $SQL = "update  cotizacion set
                    cotizaciondolar='$valor',
                    automatico=$automatico
            
                    where moneda='$moneda'";
            //echo $SQL;
            $resultado=$db->queryTransaction($SQL,0);
            if ($resultado=="")
            {
                $SQL = "update  pais_moneda set
                    pais='$pais',
                    moneda='$moneda',
                    codigoPais='$codigopais'
                    where codigopais='$idcodigopais'";
                $resultado=$db->queryTransaction($SQL,0);
            }
        
        if ($resultado=="")
        {
            $db->Committransaction(); 
        }else{
            $db->RollBacktransaction();
        }
        
            
        
        return $resultado;

    }


}
?>
