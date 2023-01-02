<?php
 ini_set('display_errors', 'On');
 ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

require('PHPExcel.php');
require_once('../../config.php');

require_once('../../model/mailing.php');
require_once('../../model/archivo.php');
require_once('../../model/log.php');
require_once('../../model/gravamen.php');
require_once('../../model/intervencion.php');

$mailing_model= new Model\mailing;
$archivo_model= new Model\archivo;
$log_model= new Model\log;
$gravamen_model= new Model\gravamen;
$intervencion_model= new Model\intervencion;

$objPHPExcel = new PHPExcel;
$objReader = PHPExcel_IOFactory::createReader("Excel2007");



$result_archivo= $archivo_model->GetPendienteClienteProcesar('VC');
$archivoID=0;
$errores_avisar_admin=0;

if ($result_archivo) 
{
  foreach ($result_archivo as $key => $valuearchivo) 
  { 
      $objPHPExcel= $objReader->load("../../uploads/archivo_usuario/".$valuearchivo['archivo_fisico']);
      $archivoID=$valuearchivo['archivoId'];
      $cotizacion_moneda=$valuearchivo['cotizacion'];
      $gravamenes=$valuearchivo['gravamenes'];
      $intervencion_mostrar=$valuearchivo['intervencion_mostrar'];
    
      $gravamenes_array = explode(',',$gravamenes); 
     // echo("archivo:".$valuearchivo['archivo_fisico']." gravamenes:" .$gravamenes);
          
      //die();
      //$cotizacion_pais=$valuearchivo['codigopais'];
      $result_archivo_parametria= $archivo_model->GetParametriaUsuarioTipoArchivo('VC',$valuearchivo['usuarioID']);
     // print_r($result_archivo_parametria);
      $param_ncm=$result_archivo_parametria['ncm'];
      $param_origen=$result_archivo_parametria['origen'];
     // $param_pais=$result_archivo_parametria['pais'];
      $param_fob=$result_archivo_parametria['fob'];
      $param_cantidad=$result_archivo_parametria['cantidad'];
      $param_pesoneto=$result_archivo_parametria['pesoneto'];
      $param_codigo_articulo=$result_archivo_parametria['codigo_articulo'];
      $param_descripcion_articulo=$result_archivo_parametria['descripcion_articulo'];

      $fob_buscar=$result_archivo_parametria['fob_buscar'];
      $fob_buscar_maximo=$result_archivo_parametria['fob_buscar_maximo'];
      
      //busco la ultima columna con datos
      $fincolumna=0;
      $columnas="A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AB,AC,AD,AE,AF,AG,AH,AI,AJ,AK,AL,AM,AN,AO,AP,AQ,AR,AS,AT,AU,AV,AW,AX,AY,AZ,BA,BB,BC,BD,BE,BF,BG,BH,BI,BJ,BK,BL";
      $poscolumna=0;
      $columna= explode(',',$columnas);
      $posiciontitulo=1;
      
      while($fincolumna != 1) 
      {
        $buscarcolumna=$columna[$poscolumna];
        
        $valor=$objPHPExcel->getSheet(0)->getCell("$buscarcolumna$posiciontitulo")->getCalculatedValue();

        if ($valor!=null)
        {
          $poscolumna++;          
        }else{
          $fincolumna=1;
          
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Validacion');
          $posicion_agregado=$posiciontitulo +1;
          $buscarcolumna=$columna[$poscolumna + 1];
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Cotizacion');
          $buscarcolumna=$columna[$poscolumna + 2];
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'VC Dolar');
          $buscarcolumna=$columna[$poscolumna + 3];
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Unidad VC');
          $buscarcolumna=$columna[$poscolumna + 4];
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'VC');
          $buscarcolumna=$columna[$poscolumna + 5];
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Precio Kilo/Unidad');
          $buscarcolumna=$columna[$poscolumna + 6];
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Diferencia VAC');
          $buscarcolumna=$columna[$poscolumna + 7];
          $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Ajuste');

         
          if ($gravamenes!="")
          {
            $valor_columna_gravamen=8;
            foreach ($gravamenes_array as $key => $value) 
            {                 
              $buscarcolumna=$columna[$poscolumna + $valor_columna_gravamen];
              switch ($value) 
              {
                case "10":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Derecho Importacion (Extrazona)');
                  $columna_gravamen_10=$columna[$poscolumna+ $valor_columna_gravamen];
                  break;
                case "11":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Estadisticas (Extrazona)');
                  $columna_gravamen_11=$columna[$poscolumna + $valor_columna_gravamen];
                  break;
                case "13":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Derecho Exportación (Extrazona)');
                  $columna_gravamen_13=$columna[$poscolumna + $valor_columna_gravamen];
                  break;
                case "14":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Reintegro (Extrazona)');
                  $columna_gravamen_14=$columna[$poscolumna + $valor_columna_gravamen];            
                  break;
                case "16":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Derecho Importacion (Intrazona)');
                  $columna_gravamen_16=$columna[$poscolumna + $valor_columna_gravamen];
                  break;
                case "17":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Derecho Exportación (Intrazona)');
                  $columna_gravamen_17=$columna[$poscolumna + $valor_columna_gravamen];
                  break;
                case "18":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Reintegro Brasil (Intrazona)');
                  $columna_gravamen_18=$columna[$poscolumna + $valor_columna_gravamen];
                  echo "columna 18 ".$columna_gravamen_18;
                  break;
                case "19":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Reintegro Uruguay (Intrazona)');
                  $columna_gravamen_19=$columna[$poscolumna + $valor_columna_gravamen];
                  echo "columna 19 ".$columna_gravamen_19;
                  break;
                case "20":
                  $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Reintegro Paraguay (Intrazona)');
                  $columna_gravamen_20=$columna[$poscolumna + $valor_columna_gravamen];
                  echo "columna 20 ".$columna_gravamen_20;
                  break;
                default:
                  echo "falta definir gravamen-".$value."-";
                  break;
              } 
              $valor_columna_gravamen++;           
            }
          } else{
            $valor_columna_gravamen=8;
          }
          
          if ($intervencion_mostrar==1)
          {
              //columna de intervenciones
            $buscarcolumna=$columna[$poscolumna + $valor_columna_gravamen];
            $objPHPExcel->getSheet(0)->setCellValue("$buscarcolumna$posiciontitulo",'Intervenciones');
            $columna_intervencion=$columna[$poscolumna + $valor_columna_gravamen];         
          }
          
        }        
      }

      //fin buscar la ultima columna con datos
   
      $error_cantidad=0;
      $inicia ="2";
      $fin=0;
      $pos=0;
      $columna_error= $columna[$poscolumna];
      $columna_cotizacion= $columna[$poscolumna +1];
      $columna_vc_dolar= $columna[$poscolumna +2];
      $columna_unidad_vc= $columna[$poscolumna +3];
      $columna_vc= $columna[$poscolumna +4];
      $columna_precio_kilo= $columna[$poscolumna +5];
      $columna_diferencia_vac= $columna[$poscolumna +6];
      $columna_diferencia_ajuste= $columna[$poscolumna +7];
      $columna_varios_fobs= $columna[$poscolumna+8];
         
     

      while($fin != 1) 
      {       
        $ncm_valor=$objPHPExcel->getSheet(0)->getCell("$param_ncm$inicia")->getCalculatedValue();        
        if ($ncm_valor=="")
        {
          $fin=1;
        }else
        {               
            $origen_valor=$objPHPExcel->getSheet(0)->getCell("$param_origen$inicia")->getCalculatedValue();                       
            //$pais_valor=$objPHPExcel->getSheet(0)->getCell("$param_pais$inicia")->getCalculatedValue();        
            $fob_valor=$objPHPExcel->getSheet(0)->getCell("$param_fob$inicia")->getCalculatedValue();
            
            $codigo_articulo_valor=$objPHPExcel->getSheet(0)->getCell("$param_codigo_articulo$inicia")->getCalculatedValue();
            $descripcion_articulo_valor=$objPHPExcel->getSheet(0)->getCell("$param_descripcion_articulo$inicia")->getCalculatedValue();

            $cantidad_valor=$objPHPExcel->getSheet(0)->getCell("$param_cantidad$inicia")->getCalculatedValue();
            $pesoneto_valor=$objPHPExcel->getSheet(0)->getCell("$param_pesoneto$inicia")->getCalculatedValue();
            $error=false;
           
            if ($origen_valor==null)
            {
              $error=true;
              $codigoerror=300;
              $mensajeerror="Falta el valor Origen";
              $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia",$mensajeerror);
            }
            if ($fob_valor==null)
            {
              $error=true;
              $codigoerror=301;
              $mensajeerror="Falta el valor Fob";
              $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia",$mensajeerror);
            }

            if ($cantidad_valor==null && $pesoneto_valor==null)
            {
              $error=true;
              $codigoerror=302;
              $mensajeerror="Falta la cantidad o el peso neto";
              $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia",$mensajeerror);
            }
          
            if ($error==false)
            {
               //voy a buscar el fob
               $result_archivo_fob= $archivo_model->GetByFobValorCriterio(str_replace(".","",$ncm_valor),
                                                                          null,
                                                                          $origen_valor,
                                                                          $fob_buscar,
                                                                          $fob_buscar_maximo);
                                                              
               if ($result_archivo_fob) 
               {
                 
                  //encontro por codigo
               }else{
                
                  //busca por descripcion
                  $result_archivo_fob= $archivo_model->GetByFobValorCriterio(null,
                  str_replace(".","",$ncm_valor),
                  $origen_valor,
                  $fob_buscar,
                  $fob_buscar_maximo);
               }

               if ($result_archivo_fob) 
               {
                  if (count($result_archivo_fob)>=1)
                  {
                    if ($fob_buscar==1)
                    {
                        $fob_encontrado=$result_archivo_fob[0]['valor_fob_dol'];
                    }else{
                        if (count($result_archivo_fob)==1)
                        {
                          $fob_encontrado=$result_archivo_fob[0]['valor_fob_dol'];
                        }else{
                          //busco en el detalle porque ya se agrego
                          $obj_detalle=$archivo_model->GetDetalleSeleccion($inicia,$archivoID);
                          //  echo 'llegue'.count($obj_detalle);
                          //  print_r($obj_detalle);
                          //  die();
                          if (isset($obj_detalle))
                          {
                          // echo 'llego';
                          // die();
                            $fob_encontrado=$obj_detalle['fob_seleccionado'];
                          }else{
                            $multiple_fob=true;
                            $error=true;
                            $codigoerror=100;
                            $mensajeerror="Se encontro mas de un valor FOB";
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia",$mensajeerror);
                          }
                          
                        }
                      
                      }
                  }else{
                      $errores_avisar_admin=1;
                      $error=true;
                      $codigoerror=200;
                      $mensajeerror="NCM sin Valor Criterio.";
                      $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia",$mensajeerror);
                    
                  }
               }else
               {
                  $errores_avisar_admin=1;
                  $error=true;
                  $codigoerror=200;
                  $mensajeerror="NCM sin Valor Criterio.";
                  $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia",$mensajeerror);
              
               }

            }else{
              //echo 'salio con error';
            }
                         

            if ($error==false)
            {
              
              if ($result_archivo_fob[0]['valor_fob_dol']!=0)
              {
                $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia","OK"); 
                $objPHPExcel->getSheet(0)->setCellValue("$columna_cotizacion$inicia",$cotizacion_moneda);
              
                $objPHPExcel->getSheet(0)->setCellValue("$columna_vc_dolar$inicia",$result_archivo_fob[0]['valor_fob_dol']);
                
                $unidad_medida_valor=$result_archivo_fob[0]['unidad_medida'];
                $objPHPExcel->getSheet(0)->setCellValue("$columna_unidad_vc$inicia",$unidad_medida_valor);
                
                $vc_dol_valor=$result_archivo_fob[0]['valor_fob_dol'] /$cotizacion_moneda;
                $objPHPExcel->getSheet(0)->setCellValue("$columna_vc$inicia",$vc_dol_valor);
                
                if (strtoupper($unidad_medida_valor)=='KILOGRAMOS')
                {
                  $precio_kilo_valor= $fob_valor / $pesoneto_valor;
                }else{
                  $precio_kilo_valor= $fob_valor / $cantidad_valor;
                }
            //    echo "fob:".$fob_valor."PesoNeto:".$pesoneto_valor;                
                
            //    echo "resultado:".$precio_kilo_valor;
                $objPHPExcel->getSheet(0)->setCellValue("$columna_precio_kilo$inicia",$precio_kilo_valor);
                
                $dif_vac_valor=$vc_dol_valor - $precio_kilo_valor;
                $objPHPExcel->getSheet(0)->setCellValue("$columna_diferencia_vac$inicia",$dif_vac_valor);
                
                if ( strtoupper($unidad_medida_valor)=='KILOGRAMOS')
                {
                  $ajuste_valor=$dif_vac_valor * $pesoneto_valor;
                }else{
                  $ajuste_valor=$dif_vac_valor * $cantidad_valor;
                }
               
                $objPHPExcel->getSheet(0)->setCellValue("$columna_diferencia_ajuste$inicia",$ajuste_valor);

                
              }else{
                print_r($result_archivo_fob); 
                echo "salio ";
                //die();
                $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia","No Corresponde"); 
                $objPHPExcel->getSheet(0)->setCellValue("$columna_vc_dolar$inicia",$result_archivo_fob[0]['valor_fob_dol']);
                $objPHPExcel->getSheet(0)->setCellValue("$columna_unidad_vc$inicia","");
                $objPHPExcel->getSheet(0)->setCellValue("$columna_vc$inicia",0);
                $objPHPExcel->getSheet(0)->setCellValue("$columna_precio_kilo$inicia",0);
                $objPHPExcel->getSheet(0)->setCellValue("$columna_diferencia_vac$inicia",0);
                $objPHPExcel->getSheet(0)->setCellValue("$columna_diferencia_ajuste$inicia",0);
              }
              
            }else
            {
              if ($codigoerror!=2000000)
              {
                $objerror[$error_cantidad]->fila=$inicia;
                $objerror[$error_cantidad]->error=$codigoerror;
                $objerror[$error_cantidad]->ncm=$ncm_valor;
                $objerror[$error_cantidad]->origen=$origen_valor;
             //   $objerror[$error_cantidad]->pais=$pais_valor;
                $objerror[$error_cantidad]->fob=$fob_valor;
                $objerror[$error_cantidad]->cantidad=$cantidad_valor;
                $objerror[$error_cantidad]->peso=$pesoneto_valor;
                $objerror[$error_cantidad]->codigo=$codigo_articulo_valor;
                $objerror[$error_cantidad]->descripcion=$descripcion_articulo_valor;
                $error_cantidad++;
              }else{
                $objPHPExcel->getSheet(0)->setCellValue("$columna_error$inicia","NCM sin Valor Criterio."); 
                $objPHPExcel->getSheet(0)->setCellValue("$columna_vc_dolar$inicia","");
                $objPHPExcel->getSheet(0)->setCellValue("$columna_unidad_vc$inicia","");
                $objPHPExcel->getSheet(0)->setCellValue("$columna_vc$inicia",0);
                $objPHPExcel->getSheet(0)->setCellValue("$columna_precio_kilo$inicia",0);
                $objPHPExcel->getSheet(0)->setCellValue("$columna_diferencia_vac$inicia",0);
                $objPHPExcel->getSheet(0)->setCellValue("$columna_diferencia_ajuste$inicia",0);
              }         
            }

           
//if ($error==false)
            //{
              if ($gravamenes!="")
              {
                  $result_gravamen= $gravamen_model->getbyncm($ncm_valor);
                  if ($result_gravamen)
                  {
                    // if ( strtoupper($unidad_medida_valor)=='KILOGRAMOS')
                    //   {
                    //     $cantidad=$pesoneto_valor;
                    //   }else{
                    //     $cantidad=$cantidad_valor;
                    //   }
                      $cantidad= $fob_valor;

                      foreach ($gravamenes_array as $key => $value) 
                      {                 
                        //$buscarcolumna=$columna[$poscolumna + $valor_columna_gravamen];
                        switch ($value) 
                        {
                          case "10":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_10'] /100);
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_10$inicia",$calculo);                     
                            break;
                          case "11":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_11'] /100);
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_11$inicia",$calculo);  
                            break;
                          case "13":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_13'] /100);
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_13$inicia",$calculo);  
                            break;
                          case "14":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_14'] /100);
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_14$inicia",$calculo);             
                            break;
                          case "16":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_16'] /100);
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_16$inicia",$calculo);  
                            break;
                          case "17":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_17'] /100);
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_17$inicia",$calculo);  
                            break;
                          case "18":

                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_18'] /100);
                            echo "columna 18 calculo:".$calculo.' porcentaje'.$result_gravamen['valor_gravamen_18'];
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_18$inicia",$calculo);  
                            break;
                          case "19":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_19'] /100);
                            echo "columna 19 calculo:".$calculo.' porcentaje'.$result_gravamen['valor_gravamen_19'];
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_19$inicia",$calculo);  
                            break;
                          case "20":
                            $calculo= $cantidad * ($result_gravamen['valor_gravamen_20'] /100);
                            echo "columna 20 calculo:".$calculo.' porcentaje'.$result_gravamen['valor_gravamen_20'];
                            $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_20$inicia",$calculo);  
                            break;
                          default:
                            echo "falta definir gravamen ".$value;
                            break;
                        }
                      }                 
                  }else{
                    foreach ($gravamenes_array as $key => $value) 
                    {        
                      $valor_no_encontrado ="N/A";                                             
                      switch ($value) 
                      {
                        case "10":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_10$inicia",$valor_no_encontrado);                     
                          break;
                        case "11":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_11$inicia",$valor_no_encontrado);  
                          break;
                        case "13":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_13$inicia",$valor_no_encontrado);  
                          break;
                        case "14":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_14$inicia",$valor_no_encontrado);             
                          break;
                        case "16":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_16$inicia",$valor_no_encontrado);  
                          break;
                        case "17":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_17$inicia",$valor_no_encontrado);  
                          break;
                        case "18":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_18$inicia",$valor_no_encontrado);  
                          break;
                        case "19":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_19$inicia",$valor_no_encontrado);  
                          break;
                        case "20":
                          $objPHPExcel->getSheet(0)->setCellValue("$columna_gravamen_20$inicia",$valor_no_encontrado);  
                          break;
                        default:
                          echo "falta definir gravamen ".$value;
                          break;
                      } 
                    }           
                  }   
                }       
           // } 

            if ($intervencion_mostrar==1)
            { 
              //if ($error==false)
              //{
                $result_intervencion= $intervencion_model->getbyncm($ncm_valor);
                $concatenar_intervenciones="";
                if ($result_intervencion)
                {
                  ($result_intervencion['eti_7905']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['eti_7905']. '-' : "") ;
                  ($result_intervencion['estampillado_2133']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['estampillado_2133'].'-' : "") ;
                  ($result_intervencion['bk']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['bk'].'-' : "") ;
                  ($result_intervencion['lna']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['lna'].'-' : "") ;
                  ($result_intervencion['antidumping_3775']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['antidumping_3775'].'-'  : "") ;
                  ($result_intervencion['chas']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['chas'].'-' : "") ;
                  ($result_intervencion['djcp']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['djcp'].'-'  : "") ;
                  ($result_intervencion['pilas_y_baterias']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['pilas_y_baterias'].'-'  : "") ;
                  ($result_intervencion['seg_electrica']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['seg_electrica'].'-'  : "") ;
                  ($result_intervencion['seg_gas']!='N/A' ? $concatenar_intervenciones.= $result_intervencion['seg_gas'].'-'  : "") ;
                  
                  $objPHPExcel->getSheet(0)->setCellValue("$columna_intervencion$inicia",$concatenar_intervenciones);                                   
                }else{
                  $objPHPExcel->getSheet(0)->setCellValue("$columna_intervencion$inicia",'N/A');        
                }          
              //} 
            }
          $pos++;
          $inicia++;
        }            
      }

    
    if ($pos!=0)
    {         
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $objWriter->save("../../uploads/archivo_usuario/resultado_".$valuearchivo['archivo_fisico']);
                
      $resultado_archivo= $archivo_model->Finalizar_Archivo_Cliente ($valuearchivo['archivoId'],$error_cantidad);

      if (isset($objerror))
      {
        echo "entro a guardar los errores encontrados";
        $resultado_archivo_error= $archivo_model->agregar_archivo_detalle_error_vc($objerror,$valuearchivo['archivoId']);
      }else{
        $resultado_archivo_error="";
      }
      

       $mailingresult=$mailing_model->EnviarMailArchivoProcesado($valuearchivo['nombre'],$valuearchivo['apellido'],$valuearchivo['email'],$valuearchivo['archivo_fisico'],$error_cantidad);
      

      echo $resultado_archivo.' '.$resultado_archivo_error. ' '.$mailingresult;              
    }

   if ($errores_avisar_admin==1)
   {
     echo "entro a enviar mail al administrador";
    $mailingresult=$mailing_model->EnviarMailArchivoAdminFaltantes();
    echo $mailingresult;        
   }
  }
}


$log_model->registrar_log_cron('Carga Archivos Clientes VC');
//echo "finalizo el proceso del archivo del cliente VC";

?>