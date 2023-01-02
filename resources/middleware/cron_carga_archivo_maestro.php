<?php
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

require('PHPExcel.php');
require_once('../../config.php');

require_once('../../model/mailing.php');
require_once('../../model/archivo.php');
require_once('../../model/parametria.php');
require_once('../../model/log.php');

$mailing_model= new Model\mailing;
$archivo_model= new Model\archivo;
$parametria_model= new Model\parametria;
$log_model= new Model\log;

$objPHPExcel = new PHPExcel;
$objReader = PHPExcel_IOFactory::createReader("Excel2007");



 $result_parametria= $parametria_model->GetPendienteProcesar();


 if ($result_parametria) {
    foreach ($result_parametria as $key => $valueparametro) 
    {
      $tipo_archivo="";

      if ("CARGA_GRUPO_PAIS"==$valueparametro['parametriaID'])
      {
        
        $objPHPExcel= $objReader->load("../../uploads/grupopais/GrupoPais.xlsx");
        $tipo_archivo="CARGA_GRUPO_PAIS";
        $parametria_model->inicio_carga_archivo($tipo_archivo);
        $inicia ="2";
        $fin=0;
        $pos=0;
        while($fin != 1) {
          $valor=$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
          if ($valor=="")
          {
            $fin=1;
          }else{
              $codigo=$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
              $pais=$objPHPExcel->getActiveSheet()->getCell("B$inicia")->getCalculatedValue();
              $grupoid=$objPHPExcel->getActiveSheet()->getCell("C$inicia")->getCalculatedValue();
            

              $objarchivo[$pos]->grupoid = $grupoid;
              $objarchivo[$pos]->pais = $pais;  
              $objarchivo[$pos]->codigo = $codigo;
              $pos++;
              $inicia++;
          }
        } 
        if ($pos!=0)
        {
          $resultado_archivo= $archivo_model->cron_procesar_archivo ($tipo_archivo,$objarchivo);
          $parametria_model->fin_carga_archivo($tipo_archivo);
          echo $resultado_archivo;
        }
      }
      

      if ("CARGA_NCM"==$valueparametro['parametriaID'])
      {
        $objPHPExcel= $objReader->load("../../uploads/ncm/NCM.xlsx");
        $tipo_archivo="CARGA_NCM";
        $parametria_model->inicio_carga_archivo($tipo_archivo);
        $inicia ="2";
        $fin=0;
        $pos=0;
        while($fin != 1) {
          $valor=$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
          if ($valor=="")
          {
            $fin=1;
          }else{
              $pancm=$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
              $descripcion_mercaderia=$objPHPExcel->getActiveSheet()->getCell("B$inicia")->getCalculatedValue();
              $valor_fob_dol=$objPHPExcel->getActiveSheet()->getCell("C$inicia")->getCalculatedValue();
              $unidad_medida=$objPHPExcel->getActiveSheet()->getCell("D$inicia")->getCalculatedValue();
              $grupopais=$objPHPExcel->getActiveSheet()->getCell("E$inicia")->getCalculatedValue();
              $norma=$objPHPExcel->getActiveSheet()->getCell("F$inicia")->getCalculatedValue();
            

              $objarchivo[$pos]->pancm = str_replace(".","",$pancm);
              $objarchivo[$pos]->descripcion_mercaderia = $descripcion_mercaderia;  
              $objarchivo[$pos]->valor_fob_dol = $valor_fob_dol;
              $objarchivo[$pos]->unidad_medida = $unidad_medida;
              $objarchivo[$pos]->grupopais = $grupopais;
              $objarchivo[$pos]->norma = $norma;
              $pos++;
              $inicia++;
          }
        } 
        if ($pos!=0)
        {
          //print_r($objarchivo);
         $resultado_archivo= $archivo_model->cron_procesar_archivo ($tipo_archivo,$objarchivo);
         $parametria_model->fin_carga_archivo($tipo_archivo);
          echo $resultado_archivo;
        }
      }

      if ("CARGA_GRAVAMEN"==$valueparametro['parametriaID'])
      {
        
        $objPHPExcel= $objReader->load("../../uploads/gravamen/Gravamen.xlsx");
        $tipo_archivo="CARGA_GRAVAMEN";
        $parametria_model->inicio_carga_archivo($tipo_archivo);
        $inicia ="2";
        $fin=0;
        $pos=0;
        while($fin != 1) {
          $valor=$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
          if ($valor=="")
          {
            $fin=1;
          }else{
              $ncm          =$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
              $gravamen_10  =$objPHPExcel->getActiveSheet()->getCell("H$inicia")->getCalculatedValue();
              $gravamen_11  =$objPHPExcel->getActiveSheet()->getCell("J$inicia")->getCalculatedValue();
              $gravamen_13  =$objPHPExcel->getActiveSheet()->getCell("G$inicia")->getCalculatedValue();
              $gravamen_14  =$objPHPExcel->getActiveSheet()->getCell("I$inicia")->getCalculatedValue();
              $gravamen_16  =$objPHPExcel->getActiveSheet()->getCell("C$inicia")->getCalculatedValue();
              $gravamen_17  =$objPHPExcel->getActiveSheet()->getCell("B$inicia")->getCalculatedValue();
              $gravamen_18  =$objPHPExcel->getActiveSheet()->getCell("D$inicia")->getCalculatedValue();
              $gravamen_19  =$objPHPExcel->getActiveSheet()->getCell("F$inicia")->getCalculatedValue();
              $gravamen_20  =$objPHPExcel->getActiveSheet()->getCell("E$inicia")->getCalculatedValue();


              $objarchivo[$pos]->ncm         = $ncm;
              $objarchivo[$pos]->gravamen_10 = $gravamen_10;  
              $objarchivo[$pos]->gravamen_11 = $gravamen_11;  
              $objarchivo[$pos]->gravamen_13 = $gravamen_13;  
              $objarchivo[$pos]->gravamen_14 = $gravamen_14;  
              $objarchivo[$pos]->gravamen_16 = $gravamen_16;  
              $objarchivo[$pos]->gravamen_17 = $gravamen_17;  
              $objarchivo[$pos]->gravamen_18 = $gravamen_18;  
              $objarchivo[$pos]->gravamen_19 = $gravamen_19;  
              $objarchivo[$pos]->gravamen_20 = $gravamen_20;  
              $pos++;
              $inicia++;
          }
        } 
        if ($pos!=0)
        {
          $resultado_archivo= $archivo_model->cron_procesar_archivo ($tipo_archivo,$objarchivo);
          $parametria_model->fin_carga_archivo($tipo_archivo);
          echo $resultado_archivo;
        }
      }

      if ("CARGA_INTERVENCION"==$valueparametro['parametriaID'])
      {
        
        $objPHPExcel= $objReader->load("../../uploads/intervencion/Intervencion.xlsx");
        $tipo_archivo="CARGA_INTERVENCION";
        $parametria_model->inicio_carga_archivo($tipo_archivo);
        $inicia ="2";
        $fin=0;
        $pos=0;
        while($fin != 1) {
          $valor=$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
          if ($valor=="")
          {
            $fin=1;
          }else{
              $ncm                    =$objPHPExcel->getActiveSheet()->getCell("A$inicia")->getCalculatedValue();
              $eti_7905               =$objPHPExcel->getActiveSheet()->getCell("B$inicia")->getCalculatedValue();
              $estampillado_2133      =$objPHPExcel->getActiveSheet()->getCell("C$inicia")->getCalculatedValue();
              $bk                     =$objPHPExcel->getActiveSheet()->getCell("D$inicia")->getCalculatedValue();
              $lna                    =$objPHPExcel->getActiveSheet()->getCell("E$inicia")->getCalculatedValue();
              $antidumping_3775       =$objPHPExcel->getActiveSheet()->getCell("F$inicia")->getCalculatedValue();
              $chas                   =$objPHPExcel->getActiveSheet()->getCell("G$inicia")->getCalculatedValue();
              $djcp                   =$objPHPExcel->getActiveSheet()->getCell("H$inicia")->getCalculatedValue();
              $pilas_y_baterias       =$objPHPExcel->getActiveSheet()->getCell("I$inicia")->getCalculatedValue();
              $seg_electrica          =$objPHPExcel->getActiveSheet()->getCell("J$inicia")->getCalculatedValue();
              $seg_gas                =$objPHPExcel->getActiveSheet()->getCell("K$inicia")->getCalculatedValue();
              
              

              $objarchivo[$pos]->ncm                  = $ncm;
              $objarchivo[$pos]->eti_7905             = $eti_7905;
              $objarchivo[$pos]->estampillado_2133    = $estampillado_2133;
              $objarchivo[$pos]->bk                   = $bk;
              $objarchivo[$pos]->lna                  = $lna;
              $objarchivo[$pos]->antidumping_3775     = $antidumping_3775;
              $objarchivo[$pos]->chas                 = $chas;
              $objarchivo[$pos]->djcp                 = $djcp;
              $objarchivo[$pos]->pilas_y_baterias     = $pilas_y_baterias;
              $objarchivo[$pos]->seg_electrica        = $seg_electrica;
              $objarchivo[$pos]->seg_gas              = $seg_gas;  
              
              $pos++;
              $inicia++;
          }
        } 
        if ($pos!=0)
        {
          $resultado_archivo= $archivo_model->cron_procesar_archivo ($tipo_archivo,$objarchivo);
          $parametria_model->fin_carga_archivo($tipo_archivo);
          echo $resultado_archivo;
        }
      }
   }
 }


 $log_model->registrar_log_cron('Carga Archivos Maestros');



  
  



// $parametria= $parametria_model->GetPendienteProcesar();

// foreach ($parametria as $key => $value) 
// {
   
//   //  $res=  $mailing_model->EnviarMailClienteParaCalificar($value['reservaID']);
   

//   //   if ($res)
//   //   {
//   //     $res= $reserva_model->finalizarreserva($value['reservaID'],$value['clienteID'],$value['especialistaID']);
  
//   //   }
// }

echo "finalizo el proceso de carga de archivo maestro";
?>