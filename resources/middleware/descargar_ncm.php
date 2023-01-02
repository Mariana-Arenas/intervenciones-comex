<?php
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
require_once('../../config.php');
require_once('../../model/ncm.php');
require('PHPExcel.php');
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}



$ncm_model = new Model\ncm;




$ncm_result = $ncm_model->getbynombre("");
$inicia ="2";
if ($ncm_result!=null)
{
    $objPHPExcel = new PHPExcel;
    $objReader = PHPExcel_IOFactory::createReader("Excel2007");
    $objPHPExcel= $objReader->load("../../Templates_Archivos/NCM.xlsx");
    foreach ($ncm_result as $key => $value) {
        $objPHPExcel->getSheet(0)->setCellValue("A$inicia",$value["pancm"]);
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["descripcion_mercaderia"]);
        $objPHPExcel->getSheet(0)->setCellValue("C$inicia",$value["valor_fob_dol"]);
        $objPHPExcel->getSheet(0)->setCellValue("D$inicia",$value["unidad_medida"]);
        $objPHPExcel->getSheet(0)->setCellValue("E$inicia",$value["grupopais"]);
        $objPHPExcel->getSheet(0)->setCellValue("F$inicia",$value["norma"]);
        $inicia++;
          
    }
    //echo $inicia;
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $objWriter->save("../../uploads/ncm/ncm_actual.xlsx");
               
    echo json_encode(array('status' => 'success'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$ncm_result));
    die();
}



?>
