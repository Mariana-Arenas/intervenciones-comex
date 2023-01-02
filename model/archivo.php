<?php
namespace Model;
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
define('IN_PHP', true);

require_once('database.php');

 
class archivo{

    function getbynombre($NOMBRE,$FILTRO){
        $db = database::getInstance();
        $usuarioID=$_SESSION['comex']['usuario']['ID'];
        $SQL = "SELECT * FROM archivousuario_cabecera ac 
        where  (ac.nombre_archivo like '%$NOMBRE%'   or ac.codigomoneda like '%$NOMBRE%') ";
        $SQL.=" and ac.usuarioID='$usuarioID' ";

        if ($FILTRO=='P')
        {
            $SQL.=" and ac.procesado=0 ";
        }
        if ($FILTRO=='E')
        {
            $SQL.=" and ac.procesado=2 ";
        }
        if ($FILTRO=='F')
        {
            $SQL.=" and ac.procesado=1 ";   
        }
        $SQL.=" ORDER BY fecha_creacion desc";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
        }
        function getDetallebyID($id){
            $db = database::getInstance();
            $SQL = "SELECT ac.* 
            FROM archivousuario_detalle ac 
            where  ac.archivodetalleId='$id' ";
            //echo $SQL;
            $db->query($SQL);
    
            return $db->fetch();
            }

        function GetDetalleSeleccion ($inicio,$archivoid)
        {
            $db = database::getInstance();
            $SQL = "SELECT ac.* 
            FROM archivousuario_detalle ac 
            where  ac.archivoId='$archivoid' and fila=$inicio and error_num=0";
            //echo $SQL;
            $db->query($SQL);
    
            return $db->fetch();
        }
        function getDetallebynombre($NOMBRE,$FILTRO){
            $db = database::getInstance();
            $archivodetalleid=$_SESSION['comex']['archivoerror']['ID'];
            // $SQL = "SELECT ac.archivodetalleId,ac.fila,ac.ncm,ac.origen,ac.fob,ac.cantidad,ac.codigo_articulo,
            // ac.descripcion_articulo,ac.peso,ea.error_num,ea.descripcion as descripcion_error,pm.codigoPais,ea.avisar_admin 
            // FROM archivousuario_detalle ac inner JOIN pais_moneda pm  on (ac.origen= pm.Pais or ac.origen = pm.codigoPais)
            // inner join errores_archivo ea on ac.error_num=ea.error_num
            // where  (ac.ncm like '%$NOMBRE%' or pm.pais like '%$NOMBRE%'  or ac.origen like '%$NOMBRE%' 
            // or ac.codigo_articulo like '%$NOMBRE%' or ac.descripcion_articulo like '%$NOMBRE%' ) ";
            $SQL = "SELECT ac.archivodetalleId,ac.fila,ac.ncm,ac.origen,ac.fob,ac.cantidad,ac.codigo_articulo,
            ac.descripcion_articulo,ac.peso,ea.error_num,ea.descripcion as descripcion_error,ea.avisar_admin 
            FROM archivousuario_detalle ac
            inner join errores_archivo ea on ac.error_num=ea.error_num
            where  (ac.ncm like '%$NOMBRE%'  or ac.origen like '%$NOMBRE%' 
            or ac.codigo_articulo like '%$NOMBRE%' or ac.descripcion_articulo like '%$NOMBRE%' ) ";
            $SQL.=" and ac.archivoId='$archivodetalleid' ";
            // if ($FILTRO=='P')
            // {
            //     $SQL.=" and ea.error_num<>0";
            // }
            // if ($FILTRO=='C')
            // {
            //     $SQL.=" and ea.error_num=0";
            // }
            // if ($FILTRO=='T')
            // {
                $SQL.=" and ea.error_num<>0";
            // }
            $SQL.=" ORDER BY ac.fila asc";
            //echo $SQL;
            $db->query($SQL);
    
            return $db->fetchAll();
            }

            function GetValorCriterioById($id)
            {
                $db = database::getInstance();
        
                $SQL = "SELECT  vc.pancm,vc.descripcion_mercaderia,vc.valor_fob_dol,vc.unidad_medida,vc.norma
                FROM valorcriterios vc 
                where vc.valorcriterioId=$id ";
                //echo $SQL;
                $db->query($SQL);
        
                return $db->fetch();
            }
    function GetValorCriterio($ncm,$pais)
    {
        $db = database::getInstance();

        $SQL = "SELECT distinct vc.pancm,vc.descripcion_mercaderia,vc.valor_fob_dol,vc.unidad_medida,vc.norma,gp.Pais,gp.codigo FROM valorcriterios vc inner join grupospaises gp on vc.grupopais=gp.GrupoID 
        where vc.ncm=$ncm ";
        
        if (is_numeric($pais))
         {
            $SQL.= " and gp.codigo='$pais' "; 
         }else{
            $SQL.= " and gp.pais like '$pais%' "; 
         }
         $SQL.=" order by vc.pancm,gp.pais";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

    function GetValorCriterioSeleccionarUsuario($NOMBRE,$id)
    {
        $db = database::getInstance();

        $SQL = "SELECT vc.valorcriterioId,vc.valor_fob_dol,vc.descripcion_mercaderia,vc.unidad_medida 
        FROM valorcriterios vc inner join grupospaises gp on vc.grupopais=gp.GrupoID 
         inner join archivousuario_detalle ud on vc.pancm= substr(replace(ud.ncm,'.',''),1,8) and gp.codigo=ud.origen
        where 
            ud.archivodetalleId=$id
            and (vc.descripcion_mercaderia like '%$NOMBRE%')
         order by vc.valor_fob_dol desc";
       // echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();
    }

    function GetPendienteClienteProcesar ($tipo_archivo)
    {
        $db = database::getInstance();
        $usuarioID=$_SESSION['comex']['usuario']['ID'];
        $SQL = "SELECT ac.*,u.email,u.nombre,u.apellido 
        FROM archivousuario_cabecera ac 
            inner join usuarios u on ac.usuarioID=u.usuarioID 
        where ac.procesado=0 and 
                ac.tipo_archivo='$tipo_archivo' and 
                u.idestado=1 ";
        $SQL.=" ORDER BY fecha_creacion asc";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetchAll();

    }

    
    function GetParametriaUsuarioTipoArchivo ($tipo_archivo,$usuarioID)
    {
        $db = database::getInstance();
       
        $SQL = "SELECT * FROM archivo_parametria ap 
        where ap.usuarioID='$usuarioID' and ap.tipoarchivo='$tipo_archivo' ";
        //echo $SQL;
        $db->query($SQL);

        return $db->fetch();

    }


    function GetByFobValorCriterio($codigo,$descripcion,$pais,$buscar_fob,$fob_maximo)
    {
        $db = database::getInstance();
        $SQL = "SELECT valor_fob_dol,unidad_medida FROM valorcriterios vc 
        inner join grupospaises gp on vc.grupopais = gp.GrupoID
         where";
         if ($codigo!=null)
         {
            $SQL.=" vc.pancm like substr('$codigo%',1,8) ";
         }
         if ($descripcion!=null)
         {
            $SQL.=" vc.descripcion_mercaderia like '%$descripcion%' ";
         }
         if (is_numeric($pais))
         {
            $SQL.= " and gp.codigo='$pais' "; 
         }else{
            $SQL.= " and gp.pais like '$pais%' "; 
         }
         
         
         if ($buscar_fob==1)
         {
             if ($fob_maximo==1)
             {
                $SQL.=" order by valor_fob_dol desc";
             }else{
                $SQL.=" order by valor_fob_dol asc";
             }
         }
         
        //  if ($pais==310)
        //  {
             //echo $codigo;
             //echo $SQL;
            // die();
        //  }
        
        $db->query($SQL);

        return $db->fetchAll();
        }

    function agregar_archivo_usuario_vc ($ncm,$origen,$fob,$cantidad,$peso_neto,$fob_buscar,$fob_buscar_maximo,$nombre_archivo,$archivo_fisico,$codigomoneda,$cotizacion,$codigo_articulo,$descripcion_articulo,$gravamenes,$intervencion_mostrar,$gravamenes_todos){
        $db = database::getInstance();
        
        $usuarioID=$_SESSION['comex']['usuario']['ID'];
        $db->Begintransaction();

        if ($gravamenes_todos==1)
        {
            $gravamenes="13,17,10,16,11,18,20,19,14";
        }

        $SQL = "insert into archivousuario_cabecera (
                nombre_archivo,
                archivo_fisico,
                tipo_archivo
                ,usuarioID,codigomoneda,cotizacion,gravamenes,intervencion_mostrar) values ('$nombre_archivo','$archivo_fisico','VC','$usuarioID','$codigomoneda','$cotizacion','$gravamenes','$intervencion_mostrar')";
       //echo $SQL;
        $resultado=$db->queryTransaction($SQL,0);

        if ($resultado=="")
        {
            $origen=strtoupper($origen);
            $fob= strtoupper($fob);
            $cantidad= strtoupper($cantidad);
            $peso_neto = strtoupper($peso_neto);
            $fob_buscar =strtoupper($fob_buscar);
            $codigo_articulo = strtoupper($codigo_articulo);
            $descripcion_articulo= strtoupper($descripcion_articulo);
            
            $SQL = "update  archivo_parametria set
            ncm='$ncm',
            origen='$origen',
            fob='$fob',
            cantidad='$cantidad',
            pesoneto='$peso_neto',
            fob_buscar='$fob_buscar',
            fob_buscar_maximo='$fob_buscar_maximo',
            codigo_articulo='$codigo_articulo',
            descripcion_articulo='$descripcion_articulo',
            gravamenes ='$gravamenes'
            where tipoarchivo='VC' and usuarioID='$usuarioID'";
            $resultado=$db->queryTransaction($SQL,0);
            //echo $SQL;
        }

        if ($resultado=="")
        {
            $db->Committransaction();
        }else{
            $db->RollBacktransaction();
        }
        
        return $resultado;

    }

    function agregar_archivo_detalle_error_vc ($objarchivo_error,$archivoid){
        $db = database::getInstance();
    
        $db->Begintransaction();

        $SQL="delete from archivousuario_detalle where error_num<>0 and  archivoId=".$archivoid;
        $resultado=$db->queryTransaction($SQL,0);
            
            foreach ($objarchivo_error as $key => $value) {
                    $fila=$value->fila;
                    $error=$value->error;
                    $ncm=$value->ncm;
                    $origen=$value->origen;
                    $fob=$value->fob;
                    $cantidad=$value->cantidad;
                    $peso=$value->peso;
                    $codigo=$value->codigo;
                    $descripcion=$value->descripcion;

                    $SQL = "insert into archivousuario_detalle (
                            archivoId,
                            fila,
                            ncm,
                            origen,
                            fob,
                            cantidad,
                            peso,
                            codigo_articulo,
                            descripcion_articulo,
                            error_num
                            ) values ('$archivoid','$fila','$ncm','$origen','$fob','$cantidad','$peso','$codigo','$descripcion','$error')";
                        echo $SQL;
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
    function cron_procesar_archivo ($tipo,$objarchivo){
        $db = database::getInstance();
         $resultado="";
         $db->Begintransaction();
         
        
        if ($tipo=='CARGA_GRUPO_PAIS')
        { 
            $SQL="delete from grupospaises";
            $resultado=$db->queryTransaction($SQL,0);
            foreach ($objarchivo as $key => $value) {
                
                    $grupoid=$value->grupoid;
                    $pais=$value->pais;
                    $codigo=$value->codigo;
                    $SQL = "insert into grupospaises (
                            grupoid,
                            pais,
                            codigo
                            ) values ('$grupoid','$pais','$codigo')";
                       // echo $SQL;
                    $resultado=$db->queryTransaction($SQL,0);
                    if ($resultado!="")
                    {
                        break;
                    }
            }
        }

        if ($tipo=='CARGA_NCM')
        { 
            $pos=0;
            $SQL="delete from valorcriterios";
           $resultado=$db->queryTransaction($SQL,0);
            foreach ($objarchivo as $key => $value) {
                $pos++;
              //  print_r($value);
               
                    $pancm=$value->pancm;
                    $descripcion_mercaderia=$value->descripcion_mercaderia;
                    $valor_fob_dol=$value->valor_fob_dol;
                    $unidad_medida=$value->unidad_medida;
                    $grupopais=$value->grupopais;
                    $norma=$value->norma;

                    $SQL = "insert into valorcriterios (
                        pancm,
                        descripcion_mercaderia,
                        valor_fob_dol,
                        unidad_medida,
                        grupopais,
                        norma
                        ) values ('$pancm','$descripcion_mercaderia','$valor_fob_dol','$unidad_medida','$grupopais','$norma')";

                    $resultado=$db->queryTransaction($SQL,0);
                    if ($resultado!="")
                    {
                        break;
                    }
            }
        }

        if ($tipo=='CARGA_GRAVAMEN')
        { 
            $SQL="delete from valorgravamenes";
            $resultado=$db->queryTransaction($SQL,0);

            foreach ($objarchivo as $key => $value) {
                                    
                    $ncm=$value->ncm;
                    $gravamen_10=$value->gravamen_10;
                    $gravamen_11=$value->gravamen_11;
                    $gravamen_13=$value->gravamen_13;
                    $gravamen_14=$value->gravamen_14;
                    $gravamen_16=$value->gravamen_16;
                    $gravamen_17=$value->gravamen_17;
                    $gravamen_18=$value->gravamen_18;
                    $gravamen_19=$value->gravamen_19;
                    $gravamen_20=$value->gravamen_20;
                    
                    $SQL = "insert into valorgravamenes (
                            ncm,
                            valor_gravamen_10,
                            valor_gravamen_11,
                            valor_gravamen_13,
                            valor_gravamen_14,
                            valor_gravamen_16,
                            valor_gravamen_17,
                            valor_gravamen_18,
                            valor_gravamen_19,
                            valor_gravamen_20
                            ) values ('$ncm','$gravamen_10','$gravamen_11','$gravamen_13','$gravamen_14','$gravamen_16','$gravamen_17','$gravamen_18','$gravamen_19','$gravamen_20')";
                       
                    $resultado=$db->queryTransaction($SQL,0);
                    if ($resultado!="")
                    {
                        echo $SQL;
                        break;
                    }
            }
        }

        if ($tipo=='CARGA_INTERVENCION')
        { 
            $SQL="delete from valorintervencion";
            $resultado=$db->queryTransaction($SQL,0);
            foreach ($objarchivo as $key => $value) {
                                    
                    $ncm=$value->ncm;
                    $eti_7905=$value->eti_7905;
                    $estampillado_2133=$value->estampillado_2133;
                    $bk=$value->bk;
                    $lna=$value->lna;
                    $antidumping_3775=$value->antidumping_3775;
                    $chas=$value->chas;
                    $djcp=$value->djcp;
                    $pilas_y_baterias=$value->pilas_y_baterias;
                    $seg_electrica=$value->seg_electrica;
                    $seg_gas=$value->seg_gas;
                    
                    
                    if ($ncm)
                    {
                        $SQL = "insert into valorintervencion (
                                ncm,
                                eti_7905,
                                estampillado_2133,
                                bk,
                                lna,
                                antidumping_3775,
                                chas,
                                djcp,
                                pilas_y_baterias,
                                seg_electrica,
                                seg_gas
                                ) values ('$ncm','$eti_7905','$estampillado_2133','$bk','$lna','$antidumping_3775','$chas','$djcp','$pilas_y_baterias','$seg_electrica','$seg_gas')";
                       // echo $SQL;
                        $resultado=$db->queryTransaction($SQL,0);
                    }                    
                    
                    if ($resultado!="")
                    {
                        break;
                    }
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

    function Finalizar_Archivo_Cliente ($id,$errores){
        $db = database::getInstance();
        $estado=1;
        if ($errores>0){
            $estado=2;//errores
        }
        $SQL = "update  archivousuario_cabecera set
                procesado=$estado
                where archivoId='$id'";
       //echo $SQL;
        $resultado=$db->query($SQL);

       
        return $resultado;

    }


    
    function editarDetalleSeleccion ($fob,$unidad_medida,$ncm,$archivoid){
        $db = database::getInstance();
       
        $SQL = "update  archivousuario_detalle set
                fob_seleccionado='$fob',
                medida_seleccionado='$unidad_medida',
                error_num=0
                where ncm='$ncm' and error_num=100 and archivoId=$archivoid";
       //echo $SQL;
        
        $resultado=$db->query($SQL);

        if ($resultado=='')
        {
            $SQL = "update  archivousuario_cabecera set
                procesado=0
            where archivoId=$archivoid  and procesado=2 and archivoId not in (select distinct archivoId from archivousuario_detalle
                                                            where error_num<>0)";
                                                       //     echo $SQL;
            $resultado=$db->query($SQL);
        }
       
        return $resultado;

    }


    function eliminar ($archivoid){
        $db = database::getInstance();
    
        $db->Begintransaction();

        $SQL="delete from archivousuario_detalle where archivoId=".$archivoid;
        $resultado=$db->queryTransaction($SQL,0);
        if ($resultado=="")
        {
            $SQL="delete from archivousuario_cabecera where archivoId=".$archivoid;
        }   
         
       $resultado=$db->queryTransaction($SQL,0);
                    
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
