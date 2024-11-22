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

	$pdf = new PDF_BARCODE('P','mm',array(210,280));
	$pdf->SetMargins(10, 0, 10, true);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->SetFont('angsa','',20);
	$pdf->SetAutoPageBreak(true,15);
    $pdf->SetXY(10, 15); 

    $pdf->Cell(45, 5, $pdf->Image('img/bg.jpg', $pdf->GetX(), $pdf->GetY(), 35), 0, 0, 'C');
    $pdf->Cell(155, 5, iconv('UTF-8', 'TIS-620', 'Amarit and Associates Logistics Company Limited'), 0, 1, 'C');
    $pdf->SetFont('angsa','',13);
    $pdf->Cell(45, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(18, 4, iconv('UTF-8', 'TIS-620', 'Head Office : '), 0, 0, 'L');
    $pdf->Cell(142, 4, iconv('UTF-8', 'TIS-620', ''), 0, 1, 'L');
    $pdf->Cell(45, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(7, 4, iconv('UTF-8', 'TIS-620', 'Tel : '), 0, 0, 'L');
    $pdf->Cell(68, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'L');
    $pdf->Cell(10, 4, iconv('UTF-8', 'TIS-620', 'Email : '), 0, 0, 'L');
    $pdf->Cell(65, 4, iconv('UTF-8', 'TIS-620', ''), 0, 1, 'L');
    $pdf->Cell(45, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(13, 4, iconv('UTF-8', 'TIS-620', 'Website : '), 0, 0, 'L');
    $pdf->Cell(62, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'L');
    $pdf->Cell(16, 4, iconv('UTF-8', 'TIS-620', 'Tex ID No : '), 0, 0, 'L');
    $pdf->Cell(59, 4, iconv('UTF-8', 'TIS-620', ''), 0, 1, 'L');


	$pdf->SetFont('angsa','',15);
    $headerText = 'TIME SHEET FOR MANPOWER, VEHICLES & EQUIPMENT';

    // คำนวณตำแหน่ง X เพื่อให้ข้อความอยู่กลางหน้า
    $pageWidth = $pdf->GetPageWidth();
    $textWidth = $pdf->GetStringWidth($headerText);
    $x = ($pageWidth - $textWidth) / 2; // ตำแหน่ง X ให้อยู่กลางหน้า
    
    $pdf->SetXY($x, 32); // ตำแหน่ง Y คือ 10 (จากขอบบน)
    $pdf->Cell($textWidth, 15, iconv('UTF-8', 'TIS-620', $headerText), 0, 0, 'C');
    $pdf->SetX(10);
    $pdf->SetY(42);
	$pdf->SetFont('angsa','',12);
    $pdf->Cell(31, 4, iconv('UTF-8', 'TIS-620','TIME SHEET DATE :'), 0, 0, 'L');
    $pdf->Cell(70, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 0, 'L');
    $pdf->Cell(35, 4, iconv('UTF-8', 'TIS-620','WORK SHEET / JOB NO.'), 0, 0, 'L');
    $pdf->Cell(40, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 1, 'L');
    $pdf->Cell(101, 4, iconv('UTF-8', 'TIS-620','วันที่'), 0, 0, 'L');
    $pdf->Cell(100, 4, iconv('UTF-8', 'TIS-620','เลขที่ใบสั่งงาน'), 0, 1, 'L');
    $pdf->Cell(31, 4, iconv('UTF-8', 'TIS-620','TIME SHEET NO :'), 0, 0, 'L');
    $pdf->Cell(70, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 0, 'L');
    $pdf->Cell(35, 4, iconv('UTF-8', 'TIS-620','CLIENT NAME :'), 0, 0, 'L');
    $pdf->Cell(40, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 1, 'L');
    $pdf->Cell(101, 4, iconv('UTF-8', 'TIS-620','เลขที่'), 0, 0, 'L');
    $pdf->Cell(100, 4, iconv('UTF-8', 'TIS-620','ชื่อลูกค้า'), 0, 1, 'L');
    $pdf->Cell(31, 4, iconv('UTF-8', 'TIS-620','NAME :'), 0, 0, 'L');
    $pdf->Cell(70, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 0, 'L');
    $pdf->Cell(45, 4, iconv('UTF-8', 'TIS-620','VEHICLE / EQUIPMENT TYPE :'), 0, 0, 'L');
    $pdf->Cell(34, 4, iconv('UTF-8', 'TIS-620','_________________________'), 0, 1, 'L');
    $pdf->Cell(101, 4, iconv('UTF-8', 'TIS-620','ชื่อพนักงาน'), 0, 0, 'L');
    $pdf->Cell(100, 4, iconv('UTF-8', 'TIS-620','ประเภทรถ'), 0, 1, 'L');
    $pdf->Cell(31, 4, iconv('UTF-8', 'TIS-620','POSITION :'), 0, 0, 'L');
    $pdf->Cell(70, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 0, 'L');
    $pdf->Cell(35, 4, iconv('UTF-8', 'TIS-620','LICENSE PLATE :'), 0, 0, 'L');
    $pdf->Cell(40, 4, iconv('UTF-8', 'TIS-620','_________________________'), 0, 1, 'L');
    $pdf->Cell(101, 4, iconv('UTF-8', 'TIS-620','ตำแหน่ง'), 0, 0, 'L');
    $pdf->Cell(100, 4, iconv('UTF-8', 'TIS-620','เลขทะเบียนรถ'), 0, 1, 'L');
    $pdf->Cell(31, 4, iconv('UTF-8', 'TIS-620','FROM LOCATION :'), 0, 0, 'L');
    $pdf->Cell(70, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 0, 'L');
    $pdf->Cell(35, 4, iconv('UTF-8', 'TIS-620','TO LOCATION :'), 0, 0, 'L');
    $pdf->Cell(40, 4, iconv('UTF-8', 'TIS-620','_________________________'), 0, 1, 'L');
    $pdf->Cell(101, 4, iconv('UTF-8', 'TIS-620','จาก'), 0, 0, 'L');
    $pdf->Cell(100, 4, iconv('UTF-8', 'TIS-620','ถึง'), 0, 1, 'L');
    $pdf->Cell(31, 4, iconv('UTF-8', 'TIS-620','PERIOD COVERED :'), 0, 0, 'L');
    $pdf->Cell(70, 4, iconv('UTF-8', 'TIS-620','________________________________'), 0, 0, 'L');
    $pdf->Cell(35,4, iconv('UTF-8', 'TIS-620','REQUEST BY :'), 0, 0, 'L');
    $pdf->Cell(40, 4, iconv('UTF-8', 'TIS-620','_________________________'), 0, 1, 'L');
    $pdf->Cell(101, 4, iconv('UTF-8', 'TIS-620','ระยะเวลา'), 0, 0, 'L');
    $pdf->Cell(100, 4, iconv('UTF-8', 'TIS-620','ผู้ขอ'), 0, 1, 'L');

    $pdf->SetLineWidth(0.4);
    $pdf->SetX(10);
    $pdf->SetY(92);
    
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"DATE"), 'TLR',0, "C");
    $pdf->Cell(50, 5, iconv('UTF-8','TIS-620',"TIME เวลา"), 1,0, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"TOTAL WORK HOUR"), 'TLR',0, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"EXTRA HOURS"), 'TLR',0, "C");
    $pdf->Cell(50, 5, iconv('UTF-8','TIS-620',"REMARK"),'TLR',1, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"วันที่"), 'LR',0, "C");
    $pdf->Cell(25, 5, iconv('UTF-8','TIS-620',"STARTED"), 'LR',0, "C");
    $pdf->Cell(25, 5, iconv('UTF-8','TIS-620',"FINISHED"), 'LR',0, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"จำนวนชั่วโมง"), 'LR',0, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"จำนวนชั่วโมง"), 'LR',0, "C");
    $pdf->Cell(50, 5, iconv('UTF-8','TIS-620',"หมายเหตุ"), 'LR',1, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',""), 'LR',0, "C");
    $pdf->Cell(25, 5, iconv('UTF-8','TIS-620',"เริ่มต้น"), 'LR',0, "C");
    $pdf->Cell(25, 5, iconv('UTF-8','TIS-620',"สิ้นสุด"), 'LR',0, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"ในเวลาทำงาน"), 'LR',0, "C");
    $pdf->Cell(30, 5, iconv('UTF-8','TIS-620',"นอกเวลาทำงาน"), 'LR',0, "C");
    $pdf->Cell(50, 5, iconv('UTF-8','TIS-620',""), 'LR',1, "C");


    for ($i = 0; $i < 17; $i++) {
        $pdf->Cell(30, 5, iconv('UTF-8', 'TIS-620', ""), 1, 0, "C");
        $pdf->Cell(25, 5, iconv('UTF-8', 'TIS-620', ""), 1, 0, "C");
        $pdf->Cell(25, 5, iconv('UTF-8', 'TIS-620', ""), 1, 0, "C");
        $pdf->Cell(15, 5, iconv('UTF-8', 'TIS-620', ""), 1, 0, "C");
        $pdf->Cell(15, 5, iconv('UTF-8', 'TIS-620', "Hours"), 1, 0, "C");
        $pdf->Cell(15, 5, iconv('UTF-8', 'TIS-620', ""), 1, 0, "C");
        $pdf->Cell(15, 5, iconv('UTF-8', 'TIS-620', "Hours"), 1, 0, "C");
        $pdf->Cell(50, 5, iconv('UTF-8', 'TIS-620', ""), 1, 1, "C");   
    }
	$pdf->SetFont('angsa','',14);
    $pdf->Cell(30, 6, iconv('UTF-8', 'TIS-620', ""), 0, 0, "C");
    $pdf->Cell(25, 6, iconv('UTF-8', 'TIS-620', ""), 0, 0, "C");
    $pdf->Cell(25, 6, iconv('UTF-8', 'TIS-620', "TOTAL"), 0, 0, "C");
    $pdf->Cell(15, 6, iconv('UTF-8', 'TIS-620', ""), 1, 0, "C");
    $pdf->Cell(15, 6, iconv('UTF-8', 'TIS-620', "Hours"), 1, 0, "C");
    $pdf->Cell(15, 6, iconv('UTF-8', 'TIS-620', ""), 1, 0, "C");
    $pdf->Cell(15, 6, iconv('UTF-8', 'TIS-620', "Hours"), 1, 0, "C");
    $pdf->Cell(50, 6, iconv('UTF-8', 'TIS-620', ""), 0, 0, "C");  

    $pdf->SetX(10);
    $pdf->SetY(202);

	$pdf->SetFont('angsa','',12);
    $pdf->Cell(150, 6, iconv('UTF-8','TIS-620',"For Amarit (สำหรับ บ.อมฤต)"), 1,0, "C");
    $pdf->Cell(40, 6, iconv('UTF-8','TIS-620',"For Client (สำหรับลูกค้า)"), 1,1, "C");
    $pdf->Cell(44, 4, iconv('UTF-8','TIS-620',"Employee's Signature"), 'LR',0, "C");
    $pdf->Cell(56, 4, iconv('UTF-8','TIS-620',"Foreman or Logistics Officer Signature"), 'LR',0, "C");
    $pdf->Cell(50, 4, iconv('UTF-8','TIS-620',"Supervisor of Manager Signature"), 'LR',0, "C");
    $pdf->Cell(40, 4, iconv('UTF-8','TIS-620',"Client Signature"), 'LR',1, "C");
	$pdf->SetFont('angsa','',11);
    $pdf->Cell(44, 4, iconv('UTF-8','TIS-620',"(ลายมือชื่อ พนักงาน)"), 'LRB',0, "C");
    $pdf->Cell(56, 4, iconv('UTF-8','TIS-620',"(ลายมือชื่อ โฟร์แมน/พนักงานโลจิสติคส์)"), 'LRB',0, "C");
    $pdf->Cell(50, 4, iconv('UTF-8','TIS-620',"(ลายมือชื่อ หัวหน้างาน/ผู้จัดการ)"), 'LRB',0, "C");
    $pdf->Cell(40, 4, iconv('UTF-8','TIS-620',"(ลายมือชื่อ ลูกค้า)"), 'LRB',1, "C");
    $pdf->Cell(44, 4, iconv('UTF-8','TIS-620',""), 'LR',0, "C");
    $pdf->Cell(56, 4, iconv('UTF-8','TIS-620',""), 'LR',0, "C");
    $pdf->Cell(50, 4, iconv('UTF-8','TIS-620',""), 'LR',0, "C");
    $pdf->Cell(40, 4, iconv('UTF-8','TIS-620',""), 'LR',1, "C");
    $pdf->Cell(44, 4, iconv('UTF-8','TIS-620',""), 'LR',0, "C");
    $pdf->Cell(56, 4, iconv('UTF-8','TIS-620',""), 'LR',0, "C");
    $pdf->Cell(50, 4, iconv('UTF-8','TIS-620',""), 'LR',0, "C");
    $pdf->Cell(40, 4, iconv('UTF-8','TIS-620',""), 'LR',1, "C");
    $pdf->Cell(44, 5, iconv('UTF-8','TIS-620',"Date :"), 'LR',0, "L");
    $pdf->Cell(56, 5, iconv('UTF-8','TIS-620',"Date :"), 'LR',0, "L");
    $pdf->Cell(50, 5, iconv('UTF-8','TIS-620',"Date :"), 'LR',0, "L");
    $pdf->Cell(40, 5, iconv('UTF-8','TIS-620',"Date :"), 'LR',1, "L");
    $pdf->Cell(44, 5, iconv('UTF-8','TIS-620',"วันที่"), 'LRB',0, "L");
    $pdf->Cell(56, 5, iconv('UTF-8','TIS-620',"วันที่"), 'LRB',0, "L");
    $pdf->Cell(50, 5, iconv('UTF-8','TIS-620',"วันที่"), 'LRB',0, "L");
    $pdf->Cell(40, 5, iconv('UTF-8','TIS-620',"วันที่"), 'LRB',1, "L");

    $pdf->SetFont('angsa','',10);

    $pdf->SetXY(10, 235); 
    $pdf->Cell(200, 4, iconv('UTF-8', 'TIS-620', '*กรุณาตรวจสอบสภาพสินค้า ที่ได้รับจากการขนส่ง ถ้าสภาพสินค้าไม่สมบูรณ์ กรุณาแจ้งกลับบริษัทฯ ทันที หลังจากเซ็นเอกสารในใบส่งของแล้ว'), 0, 1, 'C');
    $pdf->Cell(200, 4, iconv('UTF-8', 'TIS-620', 'จะถือว่าท่านได้รับสินค้าครบจำนวนเรียบร้อยดี บริษัทฯจะไม่รับผิดชอบความเสียหายทุกกรณีถ้าเกินเวลาที่กำหนด'), 0, 1, 'C');
    $pdf->SetFont('angsa','',13);
    $pdf->SetXY(10, 250); 
    $pdf->Cell(65, 4, iconv('UTF-8', 'TIS-620', 'ความพึงพอใจในการให้บริการ'), 0, 0, 'C');
    $pdf->Cell(5, 4, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
    $pdf->Cell(15, 4, iconv('UTF-8', 'TIS-620', 'ดี'), 0, 0, 'C');
    $pdf->Cell(5, 4, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
    $pdf->Cell(15, 4, iconv('UTF-8', 'TIS-620', 'พอใช้'), 0, 0, 'C');
    $pdf->Cell(5, 4, iconv('UTF-8', 'TIS-620', ''), 1, 0, 'C');
    $pdf->Cell(35, 4, iconv('UTF-8', 'TIS-620', 'ปรับปรุง (โปรดระบุ)'), 0, 0, 'C');
    $pdf->Cell(40, 4, iconv('UTF-8', 'TIS-620', '__________________________'), 0, 1, 'C');
    $pdf->Cell(65, 4, iconv('UTF-8', 'TIS-620', '(Customer Satisfaction Form)'), 0, 0, 'C');
    $pdf->Cell(5, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(15, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(5, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(15, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(5, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(35, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, 'C');
    $pdf->Cell(40, 4, iconv('UTF-8', 'TIS-620', ''), 0, 1, 'C');
    $pdf->SetFont('angsa','',12);
    $pdf->Cell(100, 5, iconv('UTF-8', 'TIS-620', 'ข้อเสนอเพิ่มเติม : '), 0, 0, 'R');
    $pdf->Cell(85, 5, iconv('UTF-8', 'TIS-620', '_________________________________________________________'), 0, 0, 'C');




$pdf->Output();

?>
