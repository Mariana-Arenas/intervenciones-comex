<?php
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
require_once('../../config.php');
require_once('../../model/grupopais.php');
require('PHPExcel.php');
if (!isset($_SESSION['comex']['usuario']['ID'])) {
die();
}



$grupopais_model = new Model\grupopais;




$grupopais_result = $grupopais_model->getbynombre("");
$inicia ="2";
if ($grupopais_result!=null)
{
    $objPHPExcel = new PHPExcel;
    $objReader = PHPExcel_IOFactory::createReader("Excel2007");
    $objPHPExcel= $objReader->load("../../Templates_Archivos/GrupoPais.xlsx");
    foreach ($grupopais_result as $key => $value) {
        $objPHPExcel->getSheet(0)->setCellValue("C$inicia",$value["GrupoID"]);
        $objPHPExcel->getSheet(0)->setCellValue("B$inicia",$value["Pais"]);
        $objPHPExcel->getSheet(0)->setCellValue("A$inicia",$value["codigo"]);
        $inicia++;
          
    }
    //echo $inicia;
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $objWriter->save("../../uploads/grupopais/GrupoPais_actual.xlsx");
               
    echo json_encode(array('status' => 'success'));
    die();
}else{
    echo json_encode(array('status' => 'error','mensaje'=>$ncm_result));
    die();
}



?>
