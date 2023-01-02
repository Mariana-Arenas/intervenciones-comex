<?php
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
require_once('../../config.php');
require_once('../../model/gravamen.php');
require('PHPExcel.php');
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}



$gravamen_model = new Model\gravamen;




$gravamen_result = $gravamen_model->getbynombre("");
//print_r($gravamen_result);
$inicia ="2";
if ($gravamen_result!=null)
{
    $objPHPExcel = new PHPExcel;
    $objReader = PHPExcel_IOFactory::createReader("Excel2007");
    $objPHPExcel= $objReader->load("../../Templates_Archivos/Gravamen.xlsx");
    foreach ($gravamen_result as $key => $value) {
        $objPHPExcel->getSheet(0)->setCellValue("A$inicia",$value["ncm"]);
        $objPHPExcel->getSheet(0)->setCellValue("H$inicia",$value["valor_gravamen_10"]);
        $objPHPExcel->getSheet(0)->setCellValue("J$inicia",$value["valor_gravamen_11"]);
        $objPHPExcel->getSheet(0)->setCellValue("G$inicia",$value["valor_gravamen_13"]);
        $objPHPExcel->getSheet(0)->setCellValue("I$inicia",$value["valor_gravamen_14"]);
        $objPHPExcel->getSheet(0)->setCellValue("C$inicia",$value["valor_gravamen_16"]);
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["valor_gravamen_17"]);
        $objPHPExcel->getSheet(0)->setCellValue("D$inicia",$value["valor_gravamen_18"]);
        $objPHPExcel->getSheet(0)->setCellValue("F$inicia",$value["valor_gravamen_19"]);
        $objPHPExcel->getSheet(0)->setCellValue("E$inicia",$value["valor_gravamen_20"]);
        $inicia++;
          
    }
    //echo $inicia;
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $objWriter->save("../../uploads/gravamen/gravamen_actual.xlsx");
               
    echo json_encode(array('status' => 'success'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$gravamen_result));
    die();
}



?>
