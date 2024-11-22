<?php
	ini_set('display_errors', 'Off');
    define('FPDF_FONTPATH','font/');
	require('fpdf182/fpdf_barcode.php');

	require_once 'config_db.php';
    require_once 'utils/helper.php';

	$GLOBALS["worksheet_id"] = 'WS220300001';// $_GET['worksheet_id'];
    $worksheet_id = 'WS220300001';//$_GET['worksheet_id'];
	$iquery = "SELECT *, a.remark as remark, b.name as customer_name from worksheet a join customer b on a.customer = b.customer_id join subject c on a.subject = c.code left join users u on u.user_name = a.user_id  WHERE worksheet_id = '$worksheet_id'";
	$stmt = sqlsrv_query($conn, $iquery); 

	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$GLOBALS["worksheet_date"] = $row["worksheet_date"];
	$GLOBALS["contract"] = $row["contract"];
	$GLOBALS["customer_name"] = $row["customer_name"];
	$GLOBALS["address"] = $row["address"];
	$GLOBALS["address2"] = $row["address2"];
	$GLOBALS["province"] = $row["province"];
	$GLOBALS["postcode"] = $row["postcode"];
	$GLOBALS["tel"] = $row["tel"];
	$GLOBALS["description"] = $row["description"];
	$GLOBALS["remark"] = $row["remark"];
	$GLOBALS["branch"] = $row["branch"];
	$GLOBALS["user_id"] = $row["user_id"];
	$GLOBALS["manager_name"] = $row["manager_name"];

	class PDF extends FPDF
    {
        //Page header
        function Header()
        {
            $this->AddFont('angsa','','angsa.php');
            $this->SetFont('angsa','',14);	
			
            $today = date('d F Y');
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620','FM-OP-05'),0,1,"R");
            $this->Cell(0,8,iconv( 'UTF-8','TIS-620','Page '.$this->PageNo().' of {nb}'),0,1,"R");
			$this->Cell(25,8,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["contract"]),0,0,"L");
            $this->Cell(0,8,iconv( 'UTF-8','TIS-620',$GLOBALS["worksheet_id"].'  '.$GLOBALS["branch"]),0,1,"R");
			$this->Cell(35,8,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["customer_name"]),0,0,"L");
            $this->Cell(0,8,iconv( 'UTF-8','TIS-620',date_format($GLOBALS["worksheet_date"],"d-M-y")),0,1,"R");
			$this->Cell(25,8,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["address"]),0,1,"L");
			$this->Cell(25,6.5,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["address2"].",".$GLOBALS["province"].",".$GLOBALS["postcode"]),0,1,"L");
			$this->Cell(25,6.5,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["tel"]),0,1,"L");
			$this->Cell(25,6.5,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["description"]),0,1,"L");
			$this->Cell(15,6.5,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["remark"]),0,1,"L");
			

        }            
        //Page footer
        function Footer()
        {
			$this->SetY(-20);
			$this->Cell(25,8,"",0,0,"L");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',$GLOBALS["user_id"].' / '.$GLOBALS["manager_name"]),0,1,"L");
        }

	}

	$pdf = new PDF_BARCODE('P','mm',array(210,280));
	$pdf->SetMargins(10, 0, 10, true);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->AddFont('angsa','','angsa.php');
	$pdf->SetFont('angsa','',14);
	$pdf->SetAutoPageBreak(true,30);

	//-- Transportation
	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',''),0,1,"L");
    $pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Transportation'),0,1,"L");

    $y = $pdf->GetY();
    $f_line = $y;

    $pdf->SetLineWidth(0.4);
    $pdf->Line(10, $y, 210-10, $y);

    $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Vehicle Type'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','License No.'),0,0,"C");
    $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Company'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Operated By'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','From'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','To'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),0,0,"C");
    $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),0,1,"C");

    $y = $pdf->GetY();
    $pdf->Line(10, $f_line, 10, $y);
    $pdf->Line(200, $f_line, 200, $y);

    $iquery = "SELECT a.*,b.registration_no,c.description as vtype_desc,d.description as vowner_desc,e.name as operate_by,f.description as from_desc,g.description  as to_desc
    from worksheet_cargo_transport a 
    left join vehicle b on a.vehicle = b.vehicle_id 
    left join vehicle_type c on b.vehicle_type = c.code 
    left join vehicle_owner d on b.vehicle_owner = d.code 
    left join operator e on a.operator = e.operator_id 
    left join location f on a.transport_from = f.code 
    left join location g on a.transport_to = g.code
    WHERE worksheet_id = '$worksheet_id' AND no_charge = 0 ";
    $stmt = sqlsrv_query($conn, $iquery); 

    $x = 1;
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){   
        $y = $pdf->GetY(); 
        $pdf->SetLineWidth(0.4);
        $pdf->Line(10, $y, 200, $y);
        $pdf->SetLineWidth(0.2);
        $f_line = $y;

        $from_desc = newline($row["from_desc"],10);
        $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        $to_desc = newline($row["to_desc"],10);
        $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["transport_id"]),0,0,"C");
		$pdf->SetXY(35, $y); 
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["vtype_desc"]),0,"C");
		$pdf->SetXY(55, $y); 
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["registration_no"]),0,"C",0);
		$pdf->SetXY(75, $y);
		if ($row["vowner_desc"] == 'AAL')
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vowner_desc"]),0,0,"C");
		else
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["operate_by"]),0,0,"C");
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["transport_from"]),0,"C");
		$pdf->SetXY(140, $y);
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["transport_to"]),0,"C");
		$pdf->SetXY(160, $y);
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),0,1,"C");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$from_desc_1),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$to_desc_1),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),0,1,"C");

        $y = $pdf->GetY();
        $pdf->Line(35, $f_line, 35, $y);
        $pdf->Line(55, $f_line, 55, $y);
        $pdf->Line(75, $f_line, 75, $y);
        $pdf->Line(100, $f_line, 100, $y);
        $pdf->Line(120, $f_line, 120, $y);
        $pdf->Line(140, $f_line, 140, $y);
        $pdf->Line(160, $f_line, 160, $y);
        $pdf->Line(180, $f_line, 180, $y);

        $pdf->Line(15, $y, 200, $y);

        $y = $pdf->GetY() + 1;
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
        $pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom"]),0,1,"L");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["contract_no"]),0,0,"L");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),0,0,"L");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cargo Qty : ".$row["cargo_qty"]),0,0,"L");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| Weight : ".$row["cargo_weight"]),0,0,"L");
		$pdf->Cell(7,6,iconv( 'UTF-8','TIS-620',"KGS"),0,0,"L");
		//UPC_A Test
		//$pdf->UPC_A(10,30,$row["transport_id"],5,0.35,9);
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| Weight : ".$row["cargo_weight"]),0,0,"L");
		$pdf->Cell(0,20,"<span class='Font_Barc_39'>*1234567890*</span>",0,1,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        
        $y = $pdf->GetY();
        $pdf->Line(10, $f_line, 10, $y);
        $pdf->Line(15, $f_line, 15, $y);
        $pdf->Line(200, $f_line, 200, $y);
        $x++;
    }     
    $y = $pdf->GetY(); 
    $pdf->SetLineWidth(0.4);
    $pdf->Line(10, $y, 200, $y);


$pdf->Output();

?>
