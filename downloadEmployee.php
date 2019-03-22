<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "jsw1";
                
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
				
// Ok, we're done with the table heading, lets connect to the database
$link = mysqli_connect("localhost", "root", "", "jsw1");
$a=$_POST['employee'];
    // Check connection

if($link === false){
die("ERROR: Could not connect. " . mysqli_connect_error());
    }
	$row=2;
			$sql="SELECT status FROM safety_adm_observation where RESPONSIBLE_MANAGER like '$a'";
			 $result = $conn->query($sql);
			
				if ($result->num_rows > 0) {
                 	          $sql="SELECT * FROM safety_adm_observation where  RESPONSIBLE_MANAGER like '$a'";
			$spreadsheet = new Spreadsheet();
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$spreadsheet->setActiveSheetIndex(0);
			$query=mysqli_query($link, $sql);
            
            
             $sql1="SELECT * FROM safety_adm_observation o, safety_adm_closed_observations c where o.observation_id=c.observation_id and RESPONSIBLE_MANAGER like '$a'";
			$query1=mysqli_query($link, $sql1);
            
			$spreadsheet->getActiveSheet()->setCellValue('A1','OBSERVATION_ID');
			$spreadsheet->getActiveSheet()->setCellValue('B1','DATE');
			$spreadsheet->getActiveSheet()->setCellValue('C1','TIME(24 HRS FORMAT)');
			$spreadsheet->getActiveSheet()->setCellValue('D1','DEPARTMENT');
			$spreadsheet->getActiveSheet()->setCellValue('E1','DIC');
			$spreadsheet->getActiveSheet()->setCellValue('F1','LOCATION');
			$spreadsheet->getActiveSheet()->setCellValue('G1','DESCRIPTION');
			$spreadsheet->getActiveSheet()->setCellValue('H1','RESPONSIBLE MANAGER');
			$spreadsheet->getActiveSheet()->setCellValue('I1','HEAD OF DEPARTMENT');
			$spreadsheet->getActiveSheet()->setCellValue('J1','INVOLVED CONTRACTOR');
			$spreadsheet->getActiveSheet()->setCellValue('K1','ACT OR CONDITION');
			$spreadsheet->getActiveSheet()->setCellValue('L1','CATEGORY OF VIOLATION');
			$spreadsheet->getActiveSheet()->setCellValue('M1','TYPE OF OBSERVATION');
			$spreadsheet->getActiveSheet()->setCellValue('N1','STATUS');
			$spreadsheet->getActiveSheet()->setCellValue('O1','TASK DONE ON DATE');
			$spreadsheet->getActiveSheet()->setCellValue('P1','CAPA');

			
			while($data = mysqli_fetch_object($query)){
				$spreadsheet->getActiveSheet()
						->setCellValue('A'.$row,$data->OBSERVATION_ID)
						->setCellValue('B'.$row,$data->DATE)
						->setCellValue('C'.$row,$data->TIME)
						->setCellValue('D'.$row,$data->DEPARTMENT)
						->setCellValue('E'.$row,$data->DIC)
						->setCellValue('F'.$row,$data->LOCATION)
						->setCellValue('G'.$row,$data->DESCRIPTION)
						->setCellValue('H'.$row,$data->RESPONSIBLE_MANAGER)
						->setCellValue('I'.$row,$data->HOD)
						->setCellValue('J'.$row,$data->CONTRACTOR)
						->setCellValue('K'.$row,$data->ACT_OR_CONDITION)
						->setCellValue('L'.$row,$data->CATEGORY_OF_VIOLATION)
						->setCellValue('M'.$row,$data->NOTICE)
						->setCellValue('N'.$row,$data->STATUS)
						->setCellValue('O'.$row,$data->DATE)
						->setCellValue('P'.$row,$data->DESCRIPTION);
						
				$row++;
			}	
            	while($data1 = mysqli_fetch_object($query1)){
				$spreadsheet->getActiveSheet()
						->setCellValue('A'.$row,$data1->OBSERVATION_ID)
						->setCellValue('B'.$row,$data1->DATE)
						->setCellValue('C'.$row,$data1->TIME)
						->setCellValue('D'.$row,$data1->DEPARTMENT)
						->setCellValue('E'.$row,$data1->DIC)
						->setCellValue('F'.$row,$data1->LOCATION)
						->setCellValue('G'.$row,$data1->DESCRIPTION)
						->setCellValue('H'.$row,$data1->RESPONSIBLE_MANAGER)
						->setCellValue('I'.$row,$data1->HOD)
						->setCellValue('J'.$row,$data1->CONTRACTOR)
						->setCellValue('K'.$row,$data1->ACT_OR_CONDITION)
						->setCellValue('L'.$row,$data1->CATEGORY_OF_VIOLATION)
						->setCellValue('M'.$row,$data1->NOTICE)
						->setCellValue('N'.$row,$data1->STATUS);
						
						
				$row++;
			}

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="myfile.xls"');
			header('Cache-Control: max-age=0');
		
			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');
		}
			
			
			
			
			
			
			

		?>