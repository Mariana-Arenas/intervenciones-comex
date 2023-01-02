<?php
// ini_set('display_errors', 'On');
// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);

require_once('../../config.php');

require_once('../../model/mailing.php');
require_once('../../model/cotizacion.php');
require_once('../../model/log.php');



$mailing_model= new Model\mailing;
$cotizacion_model= new Model\cotizacion;
$log_model= new Model\log;


 $result_cotizacion= $cotizacion_model->GetMonedasCotizar();

 if ($result_cotizacion) {
    $pos=0;
    foreach ($result_cotizacion as $key => $valuecotizacion) 
    {
             $respuestacotizacion=ObtenerCotizacion($valuecotizacion['moneda']);
             if (isset($respuestacotizacion['result']['updated']))
             {
              $objcotizacion[$pos]->moneda = $valuecotizacion['moneda'];
              $objcotizacion[$pos]->fecha = $respuestacotizacion['result']['updated'];
              $objcotizacion[$pos]->valor =  $respuestacotizacion['result']['value'];  
              $pos++;
             }else{
               //no lo encontro o tiro un error
             }
              
    }

    if ($pos!=0)
    {
     // print_r($objcotizacion);
      $result_cotizacion= $cotizacion_model->cron_procesar_cotizacion ($objcotizacion);
  
      echo $result_cotizacion;
    }
    $log_model->registrar_log_cron('Cotizacion');

 }



 function ObtenerCotizacion($moneda)
 {
  $key='6384|fTWfFWxbC64*7MK9UgxH1JcAhPjkDQcT';
  $url="https://api.cambio.today/v1/quotes/$moneda/USD/json?quantity=1&key=$key";

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
  ));


$response = curl_exec($curl);

if (!curl_errno($curl)) {
    switch ($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) {
      case 200:  # OK
        $res=json_decode($response,true);
        echo $response;
         echo json_encode(array('status' => 'success','mensaje' =>'Modalidad:'.$res['modo'].'<br>'.'Alicuota:'.$res['alicuota'].'<br>'.'Importe a Retener: $'.$res['importe']));
        break;
      default:  # not found
        echo "error";
        $res=json_decode($response,true);
        break;
       
    }
  }
  
  curl_close($curl);
  return $res;


 }



  
  



// $parametria= $parametria_model->GetPendienteProcesar();

// foreach ($parametria as $key => $value) 
// {
   
//   //  $res=  $mailing_model->EnviarMailClienteParaCalificar($value['reservaID']);
   

//   //   if ($res)
//   //   {
//   //     $res= $reserva_model->finalizarreserva($value['reservaID'],$value['clienteID'],$value['especialistaID']);
  
//   //   }
// }

echo "finalizo el proceso de carga de cotizacion";
?>