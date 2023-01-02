<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

 
class ncm{

    function getbynombre($NOMBRE){
        $db = database::getInstance();
        $usuarioID=$_SESSION['comex']['usuario']['ID'];
        $SQL = "SELECT * FROM valorcriterios vc 
        where  (pancm like '%$NOMBRE%' or descripcion_mercaderia like '%$NOMBRE%'  or unidad_medida like '%$NOMBRE%' or grupopais like '%$NOMBRE%')
        ORDER BY pancm asc";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

    function getfaltantebynombre($NOMBRE){
        $db = database::getInstance();
        $SQL = "SELECT distinct substr(ncm,1,10) ncm,origen FROM archivousuario_detalle 
        where  (ncm like '%$NOMBRE%' or origen like '%$NOMBRE%' ) and error_num=200
        ORDER BY ncm asc";
       // echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }
    function getbyID($ID){
        $db = database::getInstance();
        $SQL = "SELECT * FROM  valorcriterios
        where  valorcriterioId='$ID'";
        $db->query($SQL);
        return $db->fetch();
        }
    
    function getFaltanteById($ID){
        $db = database::getInstance();
        $SQL = "SELECT distinct ncm FROM  archivousuario_detalle
        where  substr(replace(ncm,'.',''),1,8)='$ID'";
        //echo $SQL;
        $db->query($SQL);
        return $db->fetch();
        }

    function agregar ($pancm,$descripcion_mercaderia,$valor_fob_dol,$unidad_medida,$grupopais,$norma){
        $db = database::getInstance();
        $SQL = "insert into valorcriterios (
            pancm,
            descripcion_mercaderia,
            valor_fob_dol,
            unidad_medida,
            grupopais,
            norma
            ) values ('$pancm','$descripcion_mercaderia','$valor_fob_dol','$unidad_medida','$grupopais','$norma')";


        $resultado= $db->query($SQL);
        

        return $resultado;

    
    }

    function agregar_faltantes ($id,$pancm,$descripcion_mercaderia,$valor_fob_dol,$unidad_medida,$grupopais,$norma){
        $db = database::getInstance();

        $db->Begintransaction();
        $SQL = "insert into valorcriterios (
            pancm,
            descripcion_mercaderia,
            valor_fob_dol,
            unidad_medida,
            grupopais,
            norma
            ) values ('$id','$descripcion_mercaderia','$valor_fob_dol','$unidad_medida','$grupopais','$norma')";
            //echo $SQL;
            $resultado=$db->queryTransaction($SQL,0);
            if ($resultado=="")
            {
                $SQL="delete from  archivousuario_detalle 
                where substr(replace(ncm,'.',''),1,8)='$id' and error_num=200
                and (origen in (select pais from grupospaises where grupoID='$grupopais') 
                or  origen in (select codigo from grupospaises where grupoID='$grupopais'))";
            }
           //echo $SQL;
            $resultado=$db->queryTransaction($SQL,0);
 
            if ($resultado=="")
            {
                $SQL="update archivousuario_cabecera ac set procesado=0 
                where procesado=2 and not exists (select 1 from archivousuario_detalle ad where ac.archivoId= ad.archivoId) ";
            }
           //echo $SQL;
            $resultado=$db->queryTransaction($SQL,0);
           
            if ($resultado=="")
            {
                $db->Committransaction();
            }else{
                $db->RollBacktransaction();
            }
        
        return $resultado;

    
    }

    function editar ($id,$pancm,$descripcion_mercaderia,$valor_fob_dol,$unidad_medida,$grupopais,$norma){
        $db = database::getInstance();
        $SQL = "update  valorcriterios set
            pancm='$pancm',
            descripcion_mercaderia='$descripcion_mercaderia',
            valor_fob_dol='$valor_fob_dol',
            unidad_medida='$unidad_medida',
            grupopais='$grupopais',
            norma='$norma'
            where valorcriterioId=$id";
           


        $resultado= $db->query($SQL);
        

        return $resultado;

    }

    function eliminar ($id){
        $db = database::getInstance();
        $SQL = "delete from valorcriterios  where valorcriterioId=$id";
    
        $resultado= $db->query($SQL);
        
        return $resultado;

    }
        
    

}
?>
