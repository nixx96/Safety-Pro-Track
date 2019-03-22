<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Ok, we're done with the table heading, lets connect to the database
$link = mysqli_connect("localhost", "root", "", "jsw1");

    // Check connection

if($link === false){
die("ERROR: Could not connect. " . mysqli_connect_error());
    }
$from = $_POST["from"];
$to=$_POST["to"];
$status=$_POST["srs"];
$dic=$_POST["dic1"];
$dept=$_POST["dept1"];
if($status=='open'){
	if($dept==''&&$dic!=null){
		$sql="SELECT * FROM safety_adm_observation where date between '".$from."' and '".$to."' and status like '$status' and dic like '$dic'";
			$spreadsheet = new Spreadsheet();
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(100);
			$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(100);
			$spreadsheet->setActiveSheetIndex(0);
			$query=mysqli_query($link, $sql);
			$spreadsheet->getActiveSheet()->setCellValue('A1','OBSERVATION_ID');
			$spreadsheet->getActiveSheet()->setCellValue('B1','DATE');
			$spreadsheet->getActiveSheet()->setCellValue('C1','TIME');
			$spreadsheet->getActiveSheet()->setCellValue('D1','LOCATION');
			$spreadsheet->getActiveSheet()->setCellValue('E1','DESCRIPTION');
			$spreadsheet->getActiveSheet()->setCellValue('F1','ACT OR CONDITION');
			$spreadsheet->getActiveSheet()->setCellValue('G1','CATEGORY OF VIOLATION');
			$spreadsheet->getActiveSheet()->setCellValue('H1','RESPONSIBLE MANAGER');
			$spreadsheet->getActiveSheet()->setCellValue('I1','DEPARTMENT');
			$spreadsheet->getActiveSheet()->setCellValue('J1','DIC');
			$spreadsheet->getActiveSheet()->setCellValue('K1','HOD');
			$spreadsheet->getActiveSheet()->setCellValue('L1','CONTRACTOR');
			$spreadsheet->getActiveSheet()->setCellValue('M1','NOTICE');
			$spreadsheet->getActiveSheet()->setCellValue('N1','BEFORE_IMAGE');
			$spreadsheet->getActiveSheet()->setCellValue('O1','STATUS');
			
			$row=2;

			function addImage($path,$coordinates,$sheet){
				$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
				$drawing->setPath($path);
				$drawing->setCoordinates($coordinates);
				$drawing->setWidth(100);                 //set width, height
				$drawing->setHeight(100);  
				$drawing->setWorksheet($sheet);
			}
			
			
			while($data = mysqli_fetch_object($query)){
				$spreadsheet->getActiveSheet()
						->setCellValue('A'.$row,$data->OBSERVATION_ID)
						->setCellValue('B'.$row,$data->DATE)
						->setCellValue('C'.$row,$data->TIME)
						->setCellValue('D'.$row,$data->LOCATION)
						->setCellValue('E'.$row,$data->DESCRIPTION)
						->setCellValue('F'.$row,$data->ACT_OR_CONDITION)
						->setCellValue('G'.$row,$data->CATEGORY_OF_VIOLATION)
						->setCellValue('H'.$row,$data->RESPONSIBLE_MANAGER)
						->setCellValue('I'.$row,$data->DEPARTMENT)
						->setCellValue('J'.$row,$data->DIC)
						->setCellValue('K'.$row,$data->HOD)
						->setCellValue('L'.$row,$data->CONTRACTOR)
						->setCellValue('M'.$row,$data->NOTICE)
						->setCellValue('O'.$row,$data->STATUS);
						$path='\\'.$data->BEFORE_IMAGE;
						$coor='N'.$row;
						$sheet=$spreadsheet->getActiveSheet();
						addImage($path,$coor,$sheet);
						
						
				$row++;
			}	

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="myfile.xls"');
			header('Cache-Control: max-age=0');
		
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
		}
	
		else{
			$sql="SELECT * FROM safety_adm_observation where date between '".$from."' and '".$to."' and department like '$dept' and status like '$status'";
			$spreadsheet = new Spreadsheet();
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(100);
			$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(100);
			$spreadsheet->setActiveSheetIndex(0);
			$query=mysqli_query($link, $sql);
			$spreadsheet->getActiveSheet()->setCellValue('A1','OBSERVATION_ID');
			$spreadsheet->getActiveSheet()->setCellValue('B1','DATE');
			$spreadsheet->getActiveSheet()->setCellValue('C1','TIME');
			$spreadsheet->getActiveSheet()->setCellValue('D1','LOCATION');
			$spreadsheet->getActiveSheet()->setCellValue('E1','DESCRIPTION');
			$spreadsheet->getActiveSheet()->setCellValue('F1','ACT OR CONDITION');
			$spreadsheet->getActiveSheet()->setCellValue('G1','CATEGORY OF VIOLATION');
			$spreadsheet->getActiveSheet()->setCellValue('H1','RESPONSIBLE MANAGER');
			$spreadsheet->getActiveSheet()->setCellValue('I1','DEPARTMENT');
			$spreadsheet->getActiveSheet()->setCellValue('J1','DIC');
			$spreadsheet->getActiveSheet()->setCellValue('K1','HOD');
			$spreadsheet->getActiveSheet()->setCellValue('L1','CONTRACTOR');
			$spreadsheet->getActiveSheet()->setCellValue('M1','NOTICE');
			$spreadsheet->getActiveSheet()->setCellValue('N1','BEFORE_IMAGE');
			$spreadsheet->getActiveSheet()->setCellValue('O1','STATUS');
			
			$row=2;

			function addImage($path,$coordinates,$sheet){
				$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
				$drawing->setPath($path);
				$drawing->setCoordinates($coordinates);
				$drawing->setWidth(100);                 //set width, height
				$drawing->setHeight(100);  
				$drawing->setWorksheet($sheet);
			}
			
			
			while($data = mysqli_fetch_object($query)){
				$spreadsheet->getActiveSheet()
						->setCellValue('A'.$row,$data->OBSERVATION_ID)
						->setCellValue('B'.$row,$data->DATE)
						->setCellValue('C'.$row,$data->TIME)
						->setCellValue('D'.$row,$data->LOCATION)
						->setCellValue('E'.$row,$data->DESCRIPTION)
						->setCellValue('F'.$row,$data->ACT_OR_CONDITION)
						->setCellValue('G'.$row,$data->CATEGORY_OF_VIOLATION)
						->setCellValue('H'.$row,$data->RESPONSIBLE_MANAGER)
						->setCellValue('I'.$row,$data->DEPARTMENT)
						->setCellValue('J'.$row,$data->DIC)
						->setCellValue('K'.$row,$data->HOD)
						->setCellValue('L'.$row,$data->CONTRACTOR)
						->setCellValue('M'.$row,$data->NOTICE)
						->setCellValue('O'.$row,$data->STATUS);
						$path='\\'.$data->BEFORE_IMAGE;
						$coor='N'.$row;
						$sheet=$spreadsheet->getActiveSheet();
						addImage($path,$coor,$sheet);
						
						
				$row++;
			}	

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="myfile.xls"');
			header('Cache-Control: max-age=0');
		
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
			}
	}
	if($status=='closed'){
		if($dept==''&&$dic!=null){
		$sql="SELECT * FROM safety_adm_observation o, safety_adm_closed_observations c where o.date between '".$from."' and '".$to."' and o.observation_id=c.observation_id and dic like '$dic'";
		$spreadsheet = new Spreadsheet();
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(100);
			$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(100);
			$spreadsheet->setActiveSheetIndex(0);
			$query=mysqli_query($link, $sql);
			$spreadsheet->getActiveSheet()->setCellValue('A1','OBSERVATION_ID');
			$spreadsheet->getActiveSheet()->setCellValue('B1','DATE');
			$spreadsheet->getActiveSheet()->setCellValue('C1','TIME');
			$spreadsheet->getActiveSheet()->setCellValue('D1','LOCATION');
			$spreadsheet->getActiveSheet()->setCellValue('E1','DESCRIPTION');
			$spreadsheet->getActiveSheet()->setCellValue('F1','ACT OR CONDITION');
			$spreadsheet->getActiveSheet()->setCellValue('G1','CATEGORY OF VIOLATION');
			$spreadsheet->getActiveSheet()->setCellValue('H1','RESPONSIBLE MANAGER');
			$spreadsheet->getActiveSheet()->setCellValue('I1','DEPARTMENT');
			$spreadsheet->getActiveSheet()->setCellValue('J1','DIC');
			$spreadsheet->getActiveSheet()->setCellValue('K1','HOD');
			$spreadsheet->getActiveSheet()->setCellValue('L1','CONTRACTOR');
			$spreadsheet->getActiveSheet()->setCellValue('M1','NOTICE');
			$spreadsheet->getActiveSheet()->setCellValue('N1','BEFORE_IMAGE');
			$spreadsheet->getActiveSheet()->setCellValue('O1','STATUS');
			$spreadsheet->getActiveSheet()->setCellValue('P1','AFTER IMAGE');
			$spreadsheet->getActiveSheet()->setCellValue('Q1','DESCRIPTION');
			$spreadsheet->getActiveSheet()->setCellValue('R1','ACTION TAKEN ON DATE');
			$spreadsheet->getActiveSheet()->setCellValue('S1','ACTION TAEKN ON TIME');
			$row=2;

			function addImage($path,$coordinates,$sheet){
				$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
				$drawing->setPath($path);
				$drawing->setCoordinates($coordinates);
				$drawing->setWidth(100);                 //set width, height
				$drawing->setHeight(100);  
				$drawing->setWorksheet($sheet);
			}
			
			
			while($data = mysqli_fetch_object($query)){
				$spreadsheet->getActiveSheet()
						->setCellValue('A'.$row,$data->OBSERVATION_ID)
						->setCellValue('B'.$row,$data->DATE)
						->setCellValue('C'.$row,$data->TIME)
						->setCellValue('D'.$row,$data->LOCATION)
						->setCellValue('E'.$row,$data->DESCRIPTION)
						->setCellValue('F'.$row,$data->ACT_OR_CONDITION)
						->setCellValue('G'.$row,$data->CATEGORY_OF_VIOLATION)
						->setCellValue('H'.$row,$data->RESPONSIBLE_MANAGER)
						->setCellValue('I'.$row,$data->DEPARTMENT)
						->setCellValue('J'.$row,$data->DIC)
						->setCellValue('K'.$row,$data->HOD)
						->setCellValue('L'.$row,$data->CONTRACTOR)
						->setCellValue('M'.$row,$data->NOTICE)
						->setCellValue('O'.$row,$data->STATUS)
						->setCellValue('Q'.$row,$data->DATE)
						->setCellValue('R'.$row,$data->TIME)
						->setCellValue('S'.$row,$data->DESCRIPTION);
						$path='\\'.$data->BEFORE_IMAGE;
						$path1='\\'.$data->AFTER_PHOTO;
						$coor='N'.$row;
						$coor1='P'.$row;
						$sheet=$spreadsheet->getActiveSheet();
						addImage($path,$coor,$sheet);
						addImage($path1,$coor1,$sheet);
						
				$row++;
			}	

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="myfile.xls"');
			header('Cache-Control: max-age=0');
		
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
		}
	
		else{
			$sql="SELECT * FROM safety_adm_observation o, safety_adm_closed_observations c where o.date between '".$from."' and '".$to."' and o.observation_id=c.observation_id and department like '$dept'";
			$spreadsheet = new Spreadsheet();
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(100);
			$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(100);
			$spreadsheet->setActiveSheetIndex(0);
			$query=mysqli_query($link, $sql);
			$spreadsheet->getActiveSheet()->setCellValue('A1','OBSERVATION_ID');
			$spreadsheet->getActiveSheet()->setCellValue('B1','DATE');
			$spreadsheet->getActiveSheet()->setCellValue('C1','TIME');
			$spreadsheet->getActiveSheet()->setCellValue('D1','LOCATION');
			$spreadsheet->getActiveSheet()->setCellValue('E1','DESCRIPTION');
			$spreadsheet->getActiveSheet()->setCellValue('F1','ACT OR CONDITION');
			$spreadsheet->getActiveSheet()->setCellValue('G1','CATEGORY OF VIOLATION');
			$spreadsheet->getActiveSheet()->setCellValue('H1','RESPONSIBLE MANAGER');
			$spreadsheet->getActiveSheet()->setCellValue('I1','DEPARTMENT');
			$spreadsheet->getActiveSheet()->setCellValue('J1','DIC');
			$spreadsheet->getActiveSheet()->setCellValue('K1','HOD');
			$spreadsheet->getActiveSheet()->setCellValue('L1','CONTRACTOR');
			$spreadsheet->getActiveSheet()->setCellValue('M1','NOTICE');
			$spreadsheet->getActiveSheet()->setCellValue('N1','BEFORE_IMAGE');
			$spreadsheet->getActiveSheet()->setCellValue('O1','STATUS');
			$spreadsheet->getActiveSheet()->setCellValue('P1','AFTER IMAGE');
			$spreadsheet->getActiveSheet()->setCellValue('Q1','DESCRIPTION');
			$spreadsheet->getActiveSheet()->setCellValue('R1','ACTION TAKEN ON DATE');
			$spreadsheet->getActiveSheet()->setCellValue('S1','ACTION TAEKN ON TIME');
			$row=2;

			function addImage($path,$coordinates,$sheet){
				$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
				$drawing->setPath($path);
				$drawing->setCoordinates($coordinates);
				$drawing->setWidth(100);                 //set width, height
				$drawing->setHeight(100);  
				$drawing->setWorksheet($sheet);
			}
			
			
			while($data = mysqli_fetch_object($query)){
				$spreadsheet->getActiveSheet()
						->setCellValue('A'.$row,$data->OBSERVATION_ID)
						->setCellValue('B'.$row,$data->DATE)
						->setCellValue('C'.$row,$data->TIME)
						->setCellValue('D'.$row,$data->LOCATION)
						->setCellValue('E'.$row,$data->DESCRIPTION)
						->setCellValue('F'.$row,$data->ACT_OR_CONDITION)
						->setCellValue('G'.$row,$data->CATEGORY_OF_VIOLATION)
						->setCellValue('H'.$row,$data->RESPONSIBLE_MANAGER)
						->setCellValue('I'.$row,$data->DEPARTMENT)
						->setCellValue('J'.$row,$data->DIC)
						->setCellValue('K'.$row,$data->HOD)
						->setCellValue('L'.$row,$data->CONTRACTOR)
						->setCellValue('M'.$row,$data->NOTICE)
						->setCellValue('O'.$row,$data->STATUS)
						->setCellValue('Q'.$row,$data->DATE)
						->setCellValue('R'.$row,$data->TIME)
						->setCellValue('S'.$row,$data->DESCRIPTION);
						$path='\\'.$data->BEFORE_IMAGE;
						$path1='\\'.$data->AFTER_PHOTO;
						$coor='N'.$row;
						$coor1='P'.$row;
						$sheet=$spreadsheet->getActiveSheet();
						addImage($path,$coor,$sheet);
						addImage($path1,$coor1,$sheet);
						
				$row++;
			}	

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="myfile.xls"');
			header('Cache-Control: max-age=0');
		
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
			}
		
	}
	
?>