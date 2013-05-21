<?php
include ROOT . DS . 'app' . DS . 'libs' . DS . 'PHPExcel' . DS . 'PHPExcel.php';
include ROOT . DS . 'app' . DS . 'libs' . DS . 'PHPExcel' . DS . 'PHPExcel' . DS . 'Writer' . DS . 'Excel2007.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$titles = array(
	'User Id', 'Name', 'Last Name', 'Email', 'Telephone', 'User Type', 'Company Name',
	'Carrier', 'Country', 'State', 'Invitation Points', 'Training Points',
	'Invitation Team Points', 'Training Team Points'
);

foreach ($titles as $row => $title) {
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($row, 1, $title);
}

foreach ($users as $row => $user) {
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row + 2, $user['User']['id']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row + 2, $user['User']['name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row + 2, $user['User']['last_name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row + 2, $user['User']['email']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row + 2, $user['User']['telephone']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row + 2, $user['UserType']['name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row + 2, (!empty($user['Dealer']['name']) ? $user['Dealer']['name'] : $user['User']['company_name']));
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row + 2, $user['Carrier']['name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row + 2, $user['Country']['name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row + 2, $user['State']['name']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row + 2, $user['User']['invitation_points']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row + 2, $user['User']['training_points']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row + 2, $user['User']['team_invitation_points']);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row + 2, $user['User']['team_training_points']);
}

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');