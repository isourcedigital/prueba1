<?php
include ROOT . DS . 'app' . DS . 'libs' . DS . 'PHPExcel' . DS . 'PHPExcel.php';
include ROOT . DS . 'app' . DS . 'libs' . DS . 'PHPExcel' . DS . 'PHPExcel' . DS . 'Writer' . DS . 'Excel2007.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

foreach ($rows as $i => $row) {
	if ($i == 0) {
		$k = 0;
		foreach ($row as $key => $value) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k, 1, $key);
			$k++;
		}
		reset($row);
	}
	$k = 0;
	foreach ($row as $j => $value) {
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($k, $i + 2, $value);
		$k++;
	}
}

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');