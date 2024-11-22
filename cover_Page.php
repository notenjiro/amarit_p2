<?php
	ini_set('display_errors', 'Off');
    define('FPDF_FONTPATH','font/');
	require('fpdf182/fpdf_barcode.php');

	require_once 'config_db.php';
    require_once 'utils/helper.php';

	class PDF extends FPDF
    {
        //Page header
        function Header()
        {
            // $pdf->AddFont('angsa','','angsa.php');
            // $pdf->SetFont('angsa','',14);	
			
        //     $today = date('d F Y');
			// $pdf->Cell(0,5,iconv( 'UTF-8','TIS-620','rrr'),0,1,"L");
		// 	$this->Cell(0,5,iconv( 'UTF-8','TIS-620',''),0,1,"L");
		// 	$this->Cell(0,5,iconv( 'UTF-8','TIS-620',''),0,1,"L");
		// 	$this->Cell(0,5,iconv( 'UTF-8','TIS-620',''),0,1,"L");
		// 	$this->Cell(0,5,iconv( 'UTF-8','TIS-620','FM-OP-05'),0,1,"R");
        //     $this->Cell(0,5,iconv( 'UTF-8','TIS-620','Page '.$this->PageNo().' of {nb}'),0,1,"R");
		// 	$this->Cell(25,5,"",0,0,"L");
		// 	$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["contract"]),0,0,"L");
        //     $this->Cell(0,5,iconv( 'UTF-8','TIS-620',$GLOBALS["worksheet_id"].'  '.$GLOBALS["branch"]),0,1,"R");
		// 	$this->Cell(35,5,"",0,0,"L");
		// 	$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["customer_name"]),0,0,"L");
        //     $this->Cell(0,5,iconv( 'UTF-8','TIS-620',date_format($GLOBALS["worksheet_date"],"d-M-y")),0,1,"R");
		// 	$this->Cell(25,5,"",0,0,"L");
		// 	$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["address"]),0,1,"L");
		// 	$this->Cell(25,6.5,"",0,0,"L");
		// 	$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["address2"].",".$GLOBALS["province"].",".$GLOBALS["postcode"]),0,1,"L");
		// 	$this->Cell(25,6.5,"",0,0,"L");
		// 	$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["tel"]),0,1,"L");
		// 	$this->Cell(25,6.5,"",0,0,"L");
		// 	$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["description"]),0,1,"L");
		// 	$this->Cell(15,6.5,"",0,0,"L");
		// 	$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["remark"]),0,1,"L");
			

        }            
        //Page footer
        function Footer()
        {
			$this->SetY(-20);
			$this->Cell(25,5,"",0,0,"L");
			$this->Cell(0,5,iconv( 'UTF-8','TIS-620',$GLOBALS["user_id"].' / '.$GLOBALS["manager_name"]),0,1,"C");
        }

	}

    $date = date("d F Y");
	$pdf = new PDF_BARCODE('L','mm','A4');
	$pdf->SetMargins(10, 0, 10, true);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->SetAutoPageBreak(true,15);
    $pdf->SetXY(10, 15); 
	$pdf->SetFont('angsa','',16);
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620','Reference :'), 0, 0, 'L');
    $pdf->Cell(80, 7, iconv('UTF-8', 'TIS-620','_________________________________________'), 0, 1, 'L');
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620','Issue date :'), 0, 0, 'L');
    $pdf->Cell(80, 7, iconv('UTF-8', 'TIS-620', $date), 0, 0, 'L');
    $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620','Receive date :'), 0, 0, 'L');
    $pdf->Cell(100, 7, iconv('UTF-8', 'TIS-620','_________________________________________________'), 0, 1, 'L');
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620','Customer :'), 0, 0, 'L');
    $pdf->Cell(100, 7, iconv('UTF-8', 'TIS-620','__________________________________________________________________________________________________________'), 0, 1, 'L');
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620','Subject :'), 0, 0, 'L');
    $pdf->Cell(100, 7, iconv('UTF-8', 'TIS-620','__________________________________________________________________________________________________________'), 0, 1, 'L');

    $pdf->SetLineWidth(0.4);
    $pdf->SetX(10);
    $pdf->SetY(50);
	$pdf->SetFont('angsa','',14);
    $pdf->Cell(45, 6, iconv('UTF-8','TIS-620',"No."), 1,0, "C");
    $pdf->Cell(45, 6, iconv('UTF-8','TIS-620',"WS/JOB ID"), 1,0, "C");
    $pdf->Cell(45, 6, iconv('UTF-8','TIS-620',"WS/JOB Date"), 1,0, "C");
    $pdf->Cell(70, 6, iconv('UTF-8','TIS-620',"Subject"), 1,0, "C");
    $pdf->Cell(70, 6, iconv('UTF-8','TIS-620',"Remark"), 1,1, "C");



    for ($i = 0; $i < 17; $i++) {
        $pdf->Cell(45, 6, iconv('UTF-8','TIS-620',""), 1,0, "C");
        $pdf->Cell(45, 6, iconv('UTF-8','TIS-620',""), 1,0, "C");
        $pdf->Cell(45, 6, iconv('UTF-8','TIS-620',""), 1,0, "C");
        $pdf->Cell(70, 6, iconv('UTF-8','TIS-620',""), 1,0, "C");
        $pdf->Cell(70, 6, iconv('UTF-8','TIS-620',""), 1,1, "C");
    }

    $pdf->SetX(10);
    $pdf->SetY(170);

    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',"Requested by"), 0,0, "L");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',"Verified by"), 0,0, "L");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',"Approved by"), 0,1, "L");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',""), 0,0, "C");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',""), 0,0, "C");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',""), 0,1, "C");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',""), 0,0, "C");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',""), 0,0, "C");
    $pdf->Cell(90, 4, iconv('UTF-8','TIS-620',""), 0,1, "C");
    $pdf->Cell(90, 5, iconv('UTF-8','TIS-620',"_________________________________"), 0,0, "L");
    $pdf->Cell(90, 5, iconv('UTF-8','TIS-620',"_________________________________"), 0,0, "L");
    $pdf->Cell(90, 5, iconv('UTF-8','TIS-620',"_________________________________"), 0,1, "L");
    $pdf->Cell(90, 5, iconv('UTF-8','TIS-620',"Date :"), 0,0, "L");
    $pdf->Cell(90, 5, iconv('UTF-8','TIS-620',"Date :"), 0,0, "L");
    $pdf->Cell(90, 5, iconv('UTF-8','TIS-620',"Date :"), 0,1, "L");
    

$pdf->Output();

?>
