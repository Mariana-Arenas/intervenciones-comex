<?php
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
require_once('../../config.php');
require_once('../../model/intervencion.php');
require('PHPExcel.php');
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}



$intervencion_model = new Model\intervencion;




$intervencion_result = $intervencion_model->getbynombre("");
//print_r($gravamen_result);
$inicia ="2";
if ($intervencion_result!=null)
{
    $objPHPExcel = new PHPExcel;
    $objReader = PHPExcel_IOFactory::createReader("Excel2007");
    $objPHPExcel= $objReader->load("../../Templates_Archivos/Intervencion.xlsx");
    foreach ($intervencion_result as $key => $value) {
        $objPHPExcel->getSheet(0)->setCellValue("A$inicia",$value["ncm"]);
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["eti-7908"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["estampillado-2133"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["bk"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["lna"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["antidumping-3775"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["chas"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["djcp"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["pilas_y_baterias"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["seg_electrica"]); 
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["seg_gas"]); 
        $inicia++;
          
    }
  
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $objWriter->save("../../uploads/intervencion/intervencion_actual.xlsx");
               
    echo json_encode(array('status' => 'success'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$intervencion_result));
    die();
}



?>
