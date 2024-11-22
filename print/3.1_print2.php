<?php
    ini_set('display_errors', 'On');
    define('FPDF_FONTPATH','font/');
    require('fpdf182/fpdf.php');

    require_once '../config_db.php';
    require_once '../utils/helper.php';
	require_once '../vendor/autoload.php';

	// use Intervention\Image\ImageManager;

	// $manager = new ImageManager();
session_start();

if(substr($_GET['worksheet_id'],0,2) =="WS"){
	$isWs = true;
}
else{
	$isWs = false;
}

    $GLOBALS["user_type"] = $_SESSION["user_type"];
    $GLOBALS["worksheet_id"] = $_GET['worksheet_id'];
    $worksheet_id = $_GET['worksheet_id'];

	

	if(isset($_GET["optionPrint"])){
		$GLOBALS["optionPrint"] = $_GET["optionPrint"];
	}
	else{
		$GLOBALS["optionPrint"] = 1;
	}
	


	function print_count(){
		require './../config_db.php';

		$worksheet_id = $_GET['worksheet_id'];

		if(!isset($_GET["preview"])){
			$iquery = "MERGE INTO print_count AS target USING (SELECT '".$worksheet_id."' AS worksheet_id) AS source ON target.worksheet_id = source.worksheet_id WHEN MATCHED THEN UPDATE SET target.print_count = target.print_count + 1 WHEN NOT MATCHED THEN INSERT (worksheet_id, print_count) VALUES (source.worksheet_id, 1) OUTPUT inserted.print_count;";
			$stmt = sqlsrv_query($conn, $iquery);
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			$print_count = $row["print_count"];
		}
		else{
			$iquery = "SELECT print_count.print_count FROM print_count WHERE print_count.worksheet_id = '".$worksheet_id."';";
			$stmt = sqlsrv_query($conn, $iquery);
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			$print_count = $row["print_count"];
		}

		if($print_count==""){
			$print_count="-";
		}
		return $print_count;
	}
	$GLOBALS["print_count"] = print_count();

	if($isWs){
	$iquery = "SELECT *, a.remark as remark, b.name as customer_name,b.erp_id, u.name as user_name from worksheet a join customer b on a.customer = b.customer_id join subject c on a.subject = c.code left join users u on u.user_name = a.user_id  WHERE worksheet_id = '$worksheet_id' ";
	}
	else{
		$iquery = "SELECT *, a.remark as remark, b.name as customer_name,b.erp_id, u.name as user_name from job a join customer b on a.customer = b.customer_id join subject c on a.subject = c.code left join users u on u.user_name = a.user_id  WHERE job_id = '$worksheet_id' ";
	}

	$stmt = sqlsrv_query($conn, $iquery);

	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

	$GLOBALS["worksheet_date"] = ($isWs?$row["worksheet_date"]:$row["job_date"]);
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
	$GLOBALS["user_name"] = $row["user_name"];
	$GLOBALS["manager_name"] = $row["manager_name"];
	$GLOBALS["customer_id"] = $row["erp_id"];
	$GLOBALS["customer_ref"] = $row["customer_ref"];

	$path_barcode = "/var/www/amarit/images/picbarcode/";

	$file_barcode = $_GET['worksheet_id'].".png";
 
$generator = new Picqer\Barcode\BarcodeGeneratorPNG(); 
$barcode = $generator->getBarcode(urldecode(trim($_GET['worksheet_id'])), $generator::TYPE_CODE_128);


if(!file_put_contents($path_barcode.$file_barcode,$barcode)){
	echo 'Can not generate barcode.';
}




    class PDF extends FPDF
    {


		protected $extgstates = array();

		// alpha: real value from 0 (transparent) to 1 (opaque)
		// bm:    blend mode, one of the following:
		//          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
		//          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
		function SetAlpha($alpha, $bm='Normal')
		{
			// set alpha for stroking (CA) and non-stroking (ca) operations
			$gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
			$this->SetExtGState($gs);
		}
	
		function AddExtGState($parms)
		{
			$n = count($this->extgstates)+1;
			$this->extgstates[$n]['parms'] = $parms;
			return $n;
		}
	
		function SetExtGState($gs)
		{
			$this->_out(sprintf('/GS%d gs', $gs));
		}
	
		function _enddoc()
		{
			if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
				$this->PDFVersion='1.4';
			parent::_enddoc();
		}
	
		function _putextgstates()
		{
			for ($i = 1; $i <= count($this->extgstates); $i++)
			{
				$this->_newobj();
				$this->extgstates[$i]['n'] = $this->n;
				$this->_put('<</Type /ExtGState');
				$parms = $this->extgstates[$i]['parms'];
				$this->_put(sprintf('/ca %.3F', $parms['ca']));
				$this->_put(sprintf('/CA %.3F', $parms['CA']));
				$this->_put('/BM '.$parms['BM']);
				$this->_put('>>');
				$this->_put('endobj');
			}
		}
	
		function _putresourcedict()
		{
			parent::_putresourcedict();
			$this->_put('/ExtGState <<');
			foreach($this->extgstates as $k=>$extgstate)
				$this->_put('/GS'.$k.' '.$extgstate['n'].' 0 R');
			$this->_put('>>');
		}
	
		function _putresources()
		{
			$this->_putextgstates();
			parent::_putresources();
		}






		function WordWrap(&$text, $maxwidth)
		{
			$text = trim($text);
			if ($text==='')
				return 0;
			$space = $this->GetStringWidth(' ');
			$lines = explode("\n", $text);
			$text = '';
			$count = 0;
		
			foreach ($lines as $line)
			{
				$words = preg_split('/ +/', $line);
				$width = 0;
		
				foreach ($words as $word)
				{
					$wordwidth = $this->GetStringWidth($word);
					if ($wordwidth > $maxwidth)
					{
						// Word is too long, we cut it
						for($i=0; $i<strlen($word); $i++)
						{
							$wordwidth = $this->GetStringWidth(substr($word, $i, 1));
							if($width + $wordwidth <= $maxwidth)
							{
								$width += $wordwidth;
								$text .= substr($word, $i, 1);
							}
							else
							{
								$width = $wordwidth;
								$text = rtrim($text)."\n".substr($word, $i, 1);
								$count++;
							}
						}
					}
					elseif($width + $wordwidth <= $maxwidth)
					{
						$width += $wordwidth + $space;
						$text .= $word.' ';
					}
					else
					{
						$width = $wordwidth + $space;
						$text = rtrim($text)."\n".$word.' ';
						$count++;
					}
				}
				$text = rtrim($text)."\n";
				$count++;
			}
			$text = rtrim($text);
			return $count;
		}




		var $angle=0;

function Rotate($angle,$x=-1,$y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}


        //Page header
        function Header()
        {
			$this->AddFont('angsa','','angsa.php');
			

			$this->Image('../img/amarit_print_body.png',-3.1,37,216.5);
			
          
            $this->SetFont('angsa','',14);

            // $today = date('d F Y');
			// $this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			// $this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			// $this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			// $this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"R");
			// $this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			// $this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");

			$this->SetY(48);
			$this->SetX(175);
            $this->Cell(0,6,iconv( 'UTF-8','TIS-620','Page '.$this->PageNo().' of {nb}'),0,1,"R");
			// $this->Cell(25,8,"A",0,0,"L");
			$this->SetY(55);
			$this->SetX(35);
			$this->Cell(90,12,iconv( 'UTF-8','TIS-620',($GLOBALS["contract"]==""?"":$GLOBALS["contract"])),0,0,"L");
            $this->Cell(0,12,iconv( 'UTF-8','TIS-620',$GLOBALS["worksheet_id"].'  '.$GLOBALS["branch"].'      '),0,1,"R");

			if($GLOBALS["user_type"]=="AAL"){
			$this->SetFont('angsa','',14);
			$this->SetFillColor(255,255,255);
			$this->Rect(130,55.6,22,4.3,"F");
			$this->SetY(57.5);
			$this->SetX(129);
			$this->Cell(0,0,iconv( 'UTF-8','TIS-620','Worksheet Number'),0,0,"L");
			$this->Cell(30,12,"",0,0,"L");
			$this->SetFont('angsa','',14);
			}

			$this->SetY(70);
			$this->SetX(35);
			$this->Cell(90,6,iconv( 'UTF-8','TIS-620',($GLOBALS["customer_name"]==""?"":$GLOBALS["customer_name"])),0,0,"L");
			$this->SetY(75);
			$this->SetX(35);
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',($GLOBALS["address"]==""?"":$GLOBALS["address"])),0,0,"L");
			$this->SetY(80);
			$this->SetX(35);
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address2"].",".$GLOBALS["province"].",".$GLOBALS["postcode"]),0,0,"L");

			$this->SetY(92);
			$this->SetX(35);
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',($GLOBALS["description"]==""?"":$GLOBALS["description"])),0,1,"L");



            //$this->Cell(0,8,iconv( 'UTF-8','TIS-620',date_format($GLOBALS["worksheet_date"],"d-M-y").'   '),0,1,"R");
			//$this->Cell(25,6,"",0,0,"L");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address"]),0,1,"L");
			// $this->Cell(25,5,"",0,0,"L");
			
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address2"].",".$GLOBALS["province"].",".$GLOBALS["postcode"]),0,0,"L");
			$this->SetY(69);
			$this->SetX(35);
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',($GLOBALS["worksheet_date"]==""?"":date_format($GLOBALS["worksheet_date"],"d-M-y").'      ')),0,1,"R");
			// $this->Cell(25,6,"",0,0,"L");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["tel"]),0,1,"L");
			// $this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address2"].",".$GLOBALS["province"].",".$GLOBALS["postcode"]),0,1,"L");
			$this->SetY(82);
			$this->SetX(-45);
			$this->Cell(30,6,iconv( 'UTF-8','TIS-620',($GLOBALS["customer_id"]==""?"":$GLOBALS["customer_id"])),0,1,"R");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			// $this->Cell(25,6,"",0,0,"L");
			
			// $this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["customer_ref"].'      '),0,1,"R");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			// $this->Cell(15,6,"",0,0,"L");


			$this->SetY(92);
			$this->SetX(158);
			// $this->SetY(145);
			if(strlen(($GLOBALS["remark"]==""?"":$GLOBALS["remark"])) <= 40){
				$this->SetFont('angsa','',14);
			}
			else{
				$this->SetFont('angsa','',10);
			}
			$this->MultiCell(42,3,iconv( 'UTF-8','TIS-620',($GLOBALS["remark"]==""?"":$GLOBALS["remark"])),0,"L");
			






			
		
	


	// if($GLOBALS["user_type"]=="AAL"){
		
	// }
	// else{
		
	// }

	




	// $this->SetY(19);
	// $this->SetX(175);
	// $this->SetFont('angsa','',16);
	// $this->MultiCell(22, 6.5, iconv( 'UTF-8','TIS-620',"Original\n "), 1, "C", false);
	// $this->SetY(23.5);
	// $this->SetX(175);
	// $this->SetFont('angsa','',12);
	// $this->Cell(22, 8,iconv( 'UTF-8','TIS-620','ต้นฉบับ'),0,1,"C");

	$this->optionPrint($GLOBALS["printType"],$GLOBALS["user_type"]);
	// $this->SetY(6);
	// $this->SetX(175);
	// $this->SetFont('angsa','',16);
	// $this->MultiCell(22, 6.5, iconv( 'UTF-8','TIS-620',"Original\n "), 1, "C", false);
	// $this->SetY(10.5);
	// $this->SetX(175);
	// $this->SetFont('angsa','',12);
	// $this->Cell(22, 8,iconv( 'UTF-8','TIS-620','ต้นฉบับ'),0,1,"C");

	// $this->SetY(6);
	// $this->SetX(175);
	// $this->SetFont('angsa','',16);
	// $this->MultiCell(22, 6.5, iconv( 'UTF-8','TIS-620',"Copy\n "), 1, "C", false);
	// $this->SetY(10.5);
	// $this->SetX(175);
	// $this->SetFont('angsa','',12);
	// $this->Cell(22, 8,iconv( 'UTF-8','TIS-620','สำเนา'),0,1,"C");
	
	// $this->SetY(-16);
	// $this->SetX(165);
	// $this->SetFont('angsa','',18);
	// $this->Cell(30, 8,iconv( 'UTF-8','TIS-620',$GLOBALS["print_count"]),0,1,"R");



			

			$this->SetY(105);

}

		function optionPrint($type,$user){
			if($user == "AAL"){
				$this->Image('../img/amarit_print_header_1.1.png',0,0,210);
				
				$this->SetY(19);
				$this->SetX(175);
				$this->SetFont('angsa','',16);
				$this->MultiCell(22, 6.5, iconv( 'UTF-8','TIS-620',($type==1?"Original":"Copy")."\n "), 1, "C", false);
				$this->SetY(23.5);
				$this->SetX(175);
				$this->SetFont('angsa','',12);
				$this->Cell(22, 8,iconv( 'UTF-8','TIS-620',($type==1?"ต้นฉบับ":"สำเนา")),0,1,"C");

			}
			else{
				$this->Image('../img/amarit_print_header_2.1.png',0,0,210);

				$this->SetY(6);
				$this->SetX(175);
				$this->SetFont('angsa','',16);
				$this->MultiCell(22, 6.5, iconv( 'UTF-8','TIS-620',($type==1?"Original":"Copy")."\n "), 1, "C", false);
				$this->SetY(10.5);
				$this->SetX(175);
				$this->SetFont('angsa','',12);
				$this->Cell(22, 8,iconv( 'UTF-8','TIS-620',($type==1?"ต้นฉบับ":"สำเนา")),0,1,"C");
			}

			$this->Image('../images/picbarcode/'.$_GET['worksheet_id'].'.png',13,35,35,13);
		}
		

		function RotatedText($x, $y, $txt, $angle)
		{
			//Text rotated around its origin
			$this->Rotate($angle,$x,$y);
			$this->SetFont('angsa','',140);
			$this->SetTextColor(230,230,230);
			$this->Text($x,$y,$txt);
			$this->Rotate(0);
			$this->SetTextColor(0,0,0);
		}

		
        //Page footer
        function Footer()
        {
			$this->Image('../img/amarit_print_footer.png',0,235,210);
			$this->SetY(-42);
			$this->SetX(40);
			// $this->Cell(25,8,"",0,0,"L");
			
			$this->Cell(25,8,iconv( 'UTF-8','TIS-620',$GLOBALS["user_name"].' / '.$GLOBALS["manager_name"]),0,1,"L");
			// $this->Cell(35,11,"X",0,0,"L");
			$this->SetY(-29);
			$this->SetX(40);
			$this->Cell(0,0,date_create('now', timezone_open('Asia/Bangkok'))->format('Y-m-d H:i:s'),0,0,"L");
		
			$this->SetY(-20);
			$this->SetX(-50);
			



			//$this->multicell(30, 8, iconv( 'UTF-8','TIS-620','Printed : พิมพ์ครั้งที่ : '.$GLOBALS["print_count"]), 1, 1, 'L');
			$this->SetFont('angsa','',16);
			$this->MultiCell(37, 8, iconv( 'UTF-8','TIS-620','Printed :                          '), 1, "L", false);
			$this->SetY(-14);
			$this->SetX(148);
			$this->SetFont('angsa','',14);
			$this->Cell(30, 8,iconv( 'UTF-8','TIS-620','พิมพ์ครั้งที่  '),0,1,"R");
			
			$this->SetY(-16);
			$this->SetX(165);
			$this->SetFont('angsa','',18);
			$this->Cell(30, 8,iconv( 'UTF-8','TIS-620',$GLOBALS["print_count"]),0,1,"R");
			
			if(isset($_GET["preview"])){
				$this->SetAlpha(0.7);
				$this->RotatedText(35,190,'U n o f f c i a l',45);
				$this->SetAlpha(1);
			}

			
        }

	}


	$GLOBALS["printType"] = 1;
	$pdf=new PDF('P','mm',array(210,279));
    $pdf->SetMargins(10, 0, 10, true);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');
    $pdf->SetFont('angsa','',14);
	//$pdf->SetAutoPageBreak(true,30);

	
	

	///SEM
	$LinePage=3;
	$LineCount=0;
	$FirstGroup=true;
	//SEM

for($ii=1;$ii<=$GLOBALS["optionPrint"];$ii++){

$GLOBALS["printType"] = $ii;

 

	
///////////////////////////////// worksheet_ticket_booking_job ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //-- worksheet_ticket_booking_job
	$iquery = "SELECT TOP 1 worksheet_ticket_booking_job.* 
	FROM
	dbo.worksheet_ticket_booking_job 
	WHERE
	dbo.worksheet_ticket_booking_job.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' ";


    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Booking - Ticket'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Guest'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Airline'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Flight Number'),"T",0,"C");
		$pdf->Cell(35,6,iconv( 'UTF-8','TIS-620','Departure'),"T",0,"C");
		$pdf->Cell(35,6,iconv( 'UTF-8','TIS-620','Destination'),"RT",1,"C");
		// 190
	}

	//     $iquery = "
	// SELECT worksheet_ticket_booking_job.ticketbooking_id AS \"service_id\",
	// 	worksheet_ticket_booking_job.passenger,
	// 	worksheet_ticket_booking_job.airline_name,
	// 	barcode_service.type_service_name AS \"type\",
	// 	worksheet_ticket_booking_job.departure_date AS \"start_date\",
	// 	'' AS \"end_date\",
	// 	worksheet_ticket_booking_job.contract_number,
	// 	worksheet_ticket_booking_job.qty,
	// 	worksheet_ticket_booking_job.uom,
	// 	worksheet_ticket_booking_job.ref1,
	// 	worksheet_ticket_booking_job.ref2,
	// 	worksheet_ticket_booking_job.ref3,
	// 	worksheet_ticket_booking_job.ref4,
	// 	worksheet_ticket_booking_job.ref5,
	// 	worksheet_ticket_booking_job.ref6 
	// FROM
	// 	dbo.worksheet_ticket_booking_job
	// 	LEFT JOIN barcode_service ON barcode_service.no_service = worksheet_ticket_booking_job.type
	// WHERE
	// 	dbo.worksheet_ticket_booking_job.worksheet_id = '$worksheet_id'
	// 	AND \"status\" <> 'Cancelled'";

	$iquery = "
	SELECT worksheet_ticket_booking_job.ticketbooking_id AS \"service_id\",
	worksheet_ticket_booking_job.passenger,
	worksheet_ticket_booking_job.airline_name,
	worksheet_ticket_booking_job.description,
	worksheet_ticket_booking_job.flight_number,
	location.description AS \"departure_location\",
	barcode_product_type.product_type_name AS \"type\",
	worksheet_ticket_booking_job.departure_date AS \"start_date\",
	worksheet_ticket_booking_job.destination_date AS \"end_date\",
	location2.description AS \"destination_location\",
	worksheet_ticket_booking_job.contract_number,
	worksheet_ticket_booking_job.qty,
	worksheet_ticket_booking_job.uom,
	worksheet_ticket_booking_job.ref1,
	worksheet_ticket_booking_job.ref2,
	worksheet_ticket_booking_job.ref3,
	worksheet_ticket_booking_job.ref4,
	worksheet_ticket_booking_job.ref5,
	worksheet_ticket_booking_job.ref6 
	FROM
	dbo.worksheet_ticket_booking_job
	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type = worksheet_ticket_booking_job.type
	LEFT JOIN location ON location.code = worksheet_ticket_booking_job.departure_location
	LEFT JOIN location location2 ON LTRIM(STR(CAST(location2.code AS INT))) = worksheet_ticket_booking_job.destination_location
	WHERE
	dbo.worksheet_ticket_booking_job.worksheet_id = '".$worksheet_id."'
	AND 'status' <> 'Cancelled'
	
	";


    $stmt = sqlsrv_query($conn, $iquery);



    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        // $from_desc = newline($row["from_desc"],10);
        // $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        // $to_desc = newline($row["to_desc"],10);
        // $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
		// file_put_contents($path_barcode.$file_barcode,$barcode);

		// if ($x == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		// } else if ($x == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		// } else if ($x == 3) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		// } else if ($x%3 == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		// } else if ($x%3 == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		// } else if ($x%3 == 0) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		// }
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["service_id"]),'TR',0,"C");

		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["passenger"]),'TR',0,"C");
		//TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT
		// $pdf->MultiCell(25,6,iconv( 'UTF-8','TIS-620',"T"),'1',"L",false);
		// $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["description"]),'TR',0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"SS"),'TR',0,"C");
		// else
		// 	$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["airline_name"]),"TR",0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["flight_number"]),"TR","C");
		$pdf->SetXY($line_x+20,$line_y);

		
		$pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',($row["departure_location"]==""?"-":$row["departure_location"])),'TR',0,"C");
		$pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',($row["destination_location"]==""?"-":$row["destination_location"])),'TR',1,"C");
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C"); 
		
        


		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        // $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"BR",0,"C");
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["end_date"]))),"BR",1,"C");
		//SEM

		// if (is_null($row["actual_start_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"L"),"BR",0,"C");
		// if (is_null($row["actual_finish_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"D"),"BR",1,"C");

		
		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ticket Type: ".$row["type"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["contract_number"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',""),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["qty"].' '.$row["uom"]),"R",1,"L");
		
		//New Line
		//Line 4
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 6: ".$row["ref6"]),"BR",1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }




	///////////////////////////////// END /////////////////////////////////




	



	











///////////////////////////////// worksheet_hotel_booking ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //-- worksheet_hotel_booking
	$iquery = "SELECT worksheet_hotel_booking.* 
	FROM
	dbo.worksheet_hotel_booking 
	WHERE
	dbo.worksheet_hotel_booking.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Booking - Hotel'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Hotel Name'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Guest'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Room Type'),"T",0,"C");
		$pdf->Cell(15,6,iconv( 'UTF-8','TIS-620','Meat Incl'),"T",0,"C");
		$pdf->Cell(15,6,iconv( 'UTF-8','TIS-620','Laundry Incl'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Check-in'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Check-out'),"TR",1,"C");
		// 190
	}

    $iquery = "
	SELECT
	worksheet_hotel_booking.hotelbooking_id as \"service_id\",
	hotel.hotel_name,
	worksheet_hotel_booking.occupant,
	barcode_service.type_service_name as \"type\",
	worksheet_hotel_booking.meal_included ,
	worksheet_hotel_booking.laundry_included ,
	worksheet_hotel_booking.checkin_date as \"start_date\",
	worksheet_hotel_booking.checkout_date as \"end_date\",
	location.description AS \"location\",
	worksheet_hotel_booking.contract_number,
	worksheet_hotel_booking.qty,
	worksheet_hotel_booking.uom,
	worksheet_hotel_booking.ref1,
	worksheet_hotel_booking.ref2,
	worksheet_hotel_booking.ref3,
	worksheet_hotel_booking.ref4,
	worksheet_hotel_booking.ref5,
	worksheet_hotel_booking.ref6
	FROM
	dbo.worksheet_hotel_booking
	LEFT JOIN hotel ON
	hotel.hotel_id  = worksheet_hotel_booking.hotel_name 
	LEFT JOIN barcode_service on barcode_service.no_service = worksheet_hotel_booking.type
	LEFT JOIN location on location.code  = worksheet_hotel_booking.location 

	WHERE
	dbo.worksheet_hotel_booking.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled'  and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	//echo $iquery;
	//die;

    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        // $from_desc = newline($row["from_desc"],10);
        // $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        // $to_desc = newline($row["to_desc"],10);
        // $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
	// file_put_contents($path_barcode.$file_barcode,$barcode);

		// if ($x == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		// } else if ($x == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		// } else if ($x == 3) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		// } else if ($x%3 == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		// } else if ($x%3 == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		// } else if ($x%3 == 0) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		// }
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["service_id"]),'TR',0,"C");

		// $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["type"]),'TR',0,"C");
		// if ($row["vowner_desc"] == 'AAL')
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["hotel_name"]),'TR',0,"C");
		// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT"),'TR',0,"C");
		// else
		// 	$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["occupant"]),"TR",0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',($row["type"]==""?"":$row["type"])),"TR","C");
		$pdf->SetXY($line_x+20,$line_y);

		$pdf->Cell(15,6,iconv( 'UTF-8','TIS-620',($row["meal_included"]==1?'Yes':'No')),'TR',0,"C");
		$pdf->Cell(15,6,iconv( 'UTF-8','TIS-620',($row["laundry_included"]==1?'Yes':'No')),'TR',0,"C");
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$line_x=$pdf->GetX();
		$pdf->MultiCell(25,6,iconv( 'UTF-8','TIS-620',($row["description"]==""?"":$row["description"])),"TR","C");
		$pdf->SetXY($line_x+25,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
		// if (is_null($row["actual_start_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"RT",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"RT",0,"C");
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"RT",0,"C");
		// if (is_null($row["actual_finish_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"RT",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["end_date"]))),"TR",1,"C");
        


		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        // $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		
        $pdf->Cell(15,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(15,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		//SEM

		// if (is_null($row["actual_start_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"L"),"BR",0,"C");
		// if (is_null($row["actual_finish_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"D"),"BR",1,"C");

			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',($row["start_time"]==null?"-":date_format($row["start_time"],"H:i"))),"BR",0,"C");
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',($row["end_time"]==null?"-":date_format($row["end_time"],"H:i"))),"BR",1,"C");

		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Fixed Space: ".$row["fix_space"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["contract_number"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',""),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["qty"].' '.$row["uom"]),"R",1,"L");
		
		//New Line
		//Line 4
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 6: ".$row["ref6"]),"BR",1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }




	///////////////////////////////// END /////////////////////////////////




	
///////////////////////////////// worksheet_warehousing_space_rental ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //-- worksheet_warehousing_space_rental
	$iquery = "SELECT TOP
	1  worksheet_warehousing_space_rental.* 
FROM
	dbo.worksheet_warehousing_space_rental 
WHERE
	dbo.worksheet_warehousing_space_rental.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Warehousing / Space rental'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Type'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Location'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Sub-Location'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
		// 190
	}

    $iquery = "
	SELECT  worksheet_warehousing_space_rental.warehousing_space_rental_id AS \"service_id\",
	barcode_service.type_service_name AS \"ืname\",
    barcode_product_type.product_type_name  AS \"type\",
	barcode_location.location_name AS \"location\",
	barcode_sub_type4.sub_type4 ,
	worksheet_warehousing_space_rental.description,
	worksheet_warehousing_space_rental.start_date,
	worksheet_warehousing_space_rental.end_date,
	worksheet_warehousing_space_rental.contract_number,
	worksheet_warehousing_space_rental.qty,
	worksheet_warehousing_space_rental.uom,
	worksheet_warehousing_space_rental.ref1,
	worksheet_warehousing_space_rental.ref2,
	worksheet_warehousing_space_rental.ref3,
	worksheet_warehousing_space_rental.ref4,
	worksheet_warehousing_space_rental.ref5,
	worksheet_warehousing_space_rental.ref6 
	FROM
	dbo.worksheet_warehousing_space_rental
	LEFT JOIN barcode_service ON barcode_service.no_service = worksheet_warehousing_space_rental.type
	LEFT JOIN barcode_location ON barcode_location.no_location = worksheet_warehousing_space_rental.location
	LEFT JOIN barcode_sub_type4 ON barcode_sub_type4.no_sub_type4 = worksheet_warehousing_space_rental.sub4 
	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type = worksheet_warehousing_space_rental.[type]
	WHERE
	dbo.worksheet_warehousing_space_rental.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled' and no_charge <> 1";


    $stmt = sqlsrv_query($conn, $iquery);

	 //echo $iquery;
	 //die;

    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        // $from_desc = newline($row["from_desc"],10);
        // $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        // $to_desc = newline($row["to_desc"],10);
        // $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
	// file_put_contents($path_barcode.$file_barcode,$barcode);

		// if ($x == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		// } else if ($x == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		// } else if ($x == 3) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		// } else if ($x%3 == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		// } else if ($x%3 == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		// } else if ($x%3 == 0) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		// }
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["service_id"]),'TR',0,"C");

		// $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["type"]),'TR',0,"C");
		// if ($row["vowner_desc"] == 'AAL')
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',($row["type"]==""?"Non":$row["type"])),'TR',0,"C");
		// else
		// 	$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["location"]),"TR",0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(25,6,iconv( 'UTF-8','TIS-620',$row["sub_type4"]),"TR","C");
		$pdf->SetXY($line_x+25,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
		// if (is_null($row["actual_start_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"RT",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"RT",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"RT",0,"C");
		// if (is_null($row["actual_finish_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"RT",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"TR",1,"C");
        


		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        // $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		//SEM

		// if (is_null($row["actual_start_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"L"),"BR",0,"C");
		// if (is_null($row["actual_finish_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"D"),"BR",1,"C");

			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",1,"C");

		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Fixdc Space: ".$row["fix_space"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["contract_number"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',""),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["qty"].' '.$row["uom"]),"R",1,"L");
		
		//New Line
		//Line 4
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 6: ".$row["ref6"]),"BR",1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }




///////////////////////////////// END /////////////////////////////////





///////////////////////////////// worksheet_utilities ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //-- worksheet_utilities
	$iquery = "SELECT TOP
	1  worksheet_utilities.* 
	FROM
	dbo.worksheet_utilities 
	WHERE
	dbo.worksheet_utilities.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Utilities'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Type'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Location'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Sub-Location'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
		// 190
	}

    $iquery = "SELECT TOP
	1 worksheet_utilities.utilities_id as \"service_id\",
	barcode_service.type_service_name as \"name\",
	barcode_location.location_name as \"location\",
	barcode_sub_type4.sub_type4 as \"sub_type4\",
	barcode_product_type.product_type_name  AS \"type\",
	worksheet_utilities.description,
	worksheet_utilities.start_date,
	worksheet_utilities.end_date,
	worksheet_utilities.meter_record,
	worksheet_utilities.contract_number,
	worksheet_utilities.qty,
	worksheet_utilities.uom,
	worksheet_utilities.ref1,
	worksheet_utilities.ref2,
	worksheet_utilities.ref3,
	worksheet_utilities.ref4,
	worksheet_utilities.ref5,
	worksheet_utilities.ref6
	FROM
	dbo.worksheet_utilities 
	LEFT JOIN barcode_service on barcode_service.no_service = worksheet_utilities.type
	LEFT JOIN barcode_location on barcode_location.no_location = worksheet_utilities.location
	LEFT JOIN barcode_sub_type4 on barcode_sub_type4.no_sub_type4 = worksheet_utilities.sub4
	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type =  worksheet_utilities.[type]
	WHERE
	dbo.worksheet_utilities.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	// echo $iquery;
	// die;

    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        // $from_desc = newline($row["from_desc"],10);
        // $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        // $to_desc = newline($row["to_desc"],10);
        // $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
		// file_put_contents($path_barcode.$file_barcode,$barcode);

		// if ($x == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		// } else if ($x == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		// } else if ($x == 3) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		// } else if ($x%3 == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		// } else if ($x%3 == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		// } else if ($x%3 == 0) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		// }
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["service_id"]),'TR',0,"C");

		// $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["type"]),'TR',0,"C");
		// if ($row["vowner_desc"] == 'AAL')
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',($row["type"]==""?"Non":$row["type"])),'TR',0,"C");
		// else
		// 	$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["location"]),"TR",0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(25,6,iconv( 'UTF-8','TIS-620',$row["sub_type4"]),"TR","C");
		$pdf->SetXY($line_x+25,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
		// if (is_null($row["actual_start_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"RT",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"RT",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"RT",0,"C");
		// if (is_null($row["actual_finish_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"RT",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"TR",1,"C");
        


		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        // $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		//SEM

		// if (is_null($row["actual_start_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"L"),"BR",0,"C");
		// if (is_null($row["actual_finish_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"D"),"BR",1,"C");

			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",1,"C");

		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Fixdc Space: ".$row["fix_space"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["contract_number"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',""),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["qty"].' '.$row["uom"]),"R",1,"L");
		
		//New Line
		//Line 4
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 6: ".$row["ref6"]),"BR",1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }




	///////////////////////////////// END /////////////////////////////////






///////////////////////////////// worksheet_rental ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //-- worksheet_rental
	$iquery = "SELECT TOP
	1  worksheet_rental.* 
	FROM
	dbo.worksheet_rental 
	WHERE
	dbo.worksheet_rental.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Rental - Vehicle & heavy equipment'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Vehicle/Equipment'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Type 1'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Type 2'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
		// 190
	}

    $iquery = "SELECT
	worksheet_rental.rental_id as \"service_id\",
	worksheet_rental.vehicle_equipment_id as \"type\",
	barcode_sub_type3.sub_type3 as \"sub_type3\",
	barcode_sub_type4.sub_type4 as \"sub_type4\",
	worksheet_rental.description,
	worksheet_rental.start_date,
	worksheet_rental.end_date,
	worksheet_rental.charge_as ,
	worksheet_rental.contract_number,
	worksheet_rental.qty,
	worksheet_rental.uom,
	worksheet_rental.ref1,
	worksheet_rental.ref2,
	worksheet_rental.ref3,
	worksheet_rental.ref4,
	worksheet_rental.ref5,
	worksheet_rental.ref6
	FROM
	dbo.worksheet_rental
	LEFT JOIN barcode_location on
	barcode_location.no_location = worksheet_rental.location
	LEFT JOIN barcode_sub_type3 on
	barcode_sub_type3.no_sub_type3 = worksheet_rental.sub3 
	LEFT JOIN barcode_sub_type4 on
	barcode_sub_type4.no_sub_type4 = worksheet_rental.sub4 
	WHERE
	dbo.worksheet_rental.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	// echo $iquery;
	// die;

    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        // $from_desc = newline($row["from_desc"],10);
        // $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        // $to_desc = newline($row["to_desc"],10);
        // $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
		// file_put_contents($path_barcode.$file_barcode,$barcode);

		// if ($x == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		// } else if ($x == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		// } else if ($x == 3) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		// } else if ($x%3 == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		// } else if ($x%3 == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		// } else if ($x%3 == 0) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		// }
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["service_id"]),'TR',0,"C");

		// $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["type"]),'TR',0,"C");
		// if ($row["vowner_desc"] == 'AAL')
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',($row["type"]==""?"":$row["type"])),'TR',0,"C");
		// else
		// 	$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["sub_type3"]),"TR",0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(25,6,iconv( 'UTF-8','TIS-620',$row["sub_type4"]),"TR","C");
		$pdf->SetXY($line_x+25,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
		// if (is_null($row["actual_start_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"RT",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"RT",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"RT",0,"C");
		// if (is_null($row["actual_finish_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"RT",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"TR",1,"C");
        


		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        // $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		//SEM

		// if (is_null($row["actual_start_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"L"),"BR",0,"C");
		// if (is_null($row["actual_finish_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"D"),"BR",1,"C");

			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",1,"C");

		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["contract_number"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',""),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["qty"].' '.$row["uom"]),"R",1,"L");
		
		//New Line
		//Line 4
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 6: ".$row["ref6"]),"BR",1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }




	///////////////////////////////// END /////////////////////////////////













	
//-- Transportation
	$iquery = "SELECT top 1 a.* from worksheet_cargo_transport a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Transportation'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Vehicle Type'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','License No.'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Company'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Operated By'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','From'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','To'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");

	}

    $iquery = "SELECT a.*,b.registration_no,c.description as vtype_desc,d.description as vowner_desc,e.name as operate_by,f.description as from_desc,g.description as to_desc, u.description as uom_desc, cc.erp_contract_no
    from worksheet_cargo_transport a
    left join vehicle b on a.vehicle = b.vehicle_id
    left join vehicle_type c on b.vehicle_type = c.code
    left join vehicle_owner d on b.vehicle_owner = d.code
    left join operator e on a.operator = e.operator_id
    left join location f on a.transport_from = f.code
    left join location g on a.transport_to = g.code
	left join uom u on a.uom = u.code
	left join customer_contract cc on a.contract_no = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' AND no_charge = 0 and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        $from_desc = newline($row["from_desc"],10);
        $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        $to_desc = newline($row["to_desc"],10);
        $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
		// file_put_contents($path_barcode.$file_barcode,$barcode);

		if ($x == 1) {
			// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		} else if ($x == 2) {
			// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		} else if ($x == 3) {
			// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		} else if ($x%3 == 1) {
			// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		} else if ($x%3 == 2) {
			// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		} else if ($x%3 == 0) {
			// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		}
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["transport_id"]),'TR',0,"C");
		//$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["vtype_desc"]),0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["registration_no"]||""),'TR',0,"C");
		if ($row["vowner_desc"] == 'AAL')
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vowner_desc"]),'TR',0,"C");
		else
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',($row["operate_by"]==""?"":$row["operate_by"])),'TR',0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
		if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"RT",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"RT",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"RT",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
        
		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		//SEM

		if (is_null($row["actual_start_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");

		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R",1,"L");
		
		//New Line
		//Line 4
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");


        //$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Contract No. : ".$row["erp_contract_no"]),0,0,"L");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"| Vehicle type: ".$row["vtype_desc"]),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cargo Qty : ".$row["cargo_qty"]),0,0,"L");
        //$pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',"| Weight : ".$row["cargo_weight"]." KGS"),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',"KGS"),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }
	// $iquery = "SELECT top 1 a.* from worksheet_cargo_transport a
    // WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    // $stmt = sqlsrv_query($conn, $iquery);


//-- Manpower
	$iquery = "SELECT top 1 a.* from worksheet_manpower a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		
		
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Manpower'),0,1,"L");
		

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620','Position'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Operator'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Company'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Operated at'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
	}




    $iquery = "SELECT a.*,b.name,b.lastname,b.company,c.description as location_desc, u.description as uom_desc, p.description as charge_as_deas, cc.erp_contract_no
    from worksheet_manpower a
    left join operator b on a.labor = b.operator_id
    left join location c on a.location = c.code
	left join uom u on a.uom = u.code
	left join position p on p.code = a.charge_as
	left join customer_contract cc on a.contract_no = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

    $x = 1;
	$m = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
		//Nwe Line
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),'LTR',0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["labor_service_id"]),"TR",0,"C");
        $pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',$row["position"]),"TR",0,"C");
        $line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["name"]." ".$row["lastname"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);

		if ($row["company"] == 'AAL')
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["company"]),"TR",0,"C");
		else
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),"TR",0,"C");
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["company"]),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["location"]),"TR",0,"C");
		//$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["location"]),"R","C");
        if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
		//Nwe Line
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),'LRB',0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),'RB',0,"C");
        $pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        if (is_null($row["actual_start_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"RB",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"RB",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"RB",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"RB",1,"C");

		//Nwe Line
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),'LR',0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R",1,"L");
		//New Line
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),'LR',0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
        //Nwe Line
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//Nwe Line
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LRB",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");

		//SEM
		$LineCount+=1;		
		//SEM
         $x++;
    }
	// $iquery = "SELECT top 1 a.* from worksheet_manpower a
    // WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and (no_charge = 0 or no_charge is null) ";
    // $stmt = sqlsrv_query($conn, $iquery);
















	
//-- Cargo Handling
	$iquery = "SELECT top 1 a.* from worksheet_cargo_handling a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){

		//SEM
		if($FirstGroup)
		{
			
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Cargo Handling'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Vehicle Type'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','License No.'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Company'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Operated By'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Operated at'),"T",0,"C");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','To'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
	}

    $iquery = "SELECT a.*,b.registration_no,c.description as vtype_desc,d.description as vowner_desc,e.name as operate_by,f.description as from_desc,g.description as to_desc, u.description as uom_desc, cc.erp_contract_no
    from worksheet_cargo_handling a
    left join vehicle b on a.vehicle = b.vehicle_id
    left join vehicle_type c on b.vehicle_type = c.code
    left join vehicle_owner d on b.vehicle_owner = d.code
    left join operator e on a.operator = e.operator_id
    left join location f on a.transport_from = f.code
    left join location g on a.transport_to = g.code
	left join uom u on a.uom = u.code
	left join customer_contract cc on a.contract_no = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

    $x = 1;
	$ch = 0;
	//SEM
	$LineCount=0;
	//Sem
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
        // $y = $pdf->GetY();
        // $pdf->SetLineWidth(0.4);
        // $pdf->Line(10, $y, 200, $y);
        // $pdf->SetLineWidth(0.2);
        // $f_line = $y;
		//SEM
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
		
        $from_desc = newline($row["from_desc"],10);
        $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        $to_desc = newline($row["to_desc"],10);
        $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

        //$pdf->SetTextColor(0,0,0);
		//New LIne
		//Line 1
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["cargo_service_id"]),"TR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["vtype_desc"]||""),"TR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["registration_no"]||""),"TR",0,"C");
		if ($row["vowner_desc"] == 'AAL')
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vowner_desc"]),"TR",0,"C");
		else
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),"TR",0,"C");
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vowner_desc"]),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["operate_by"]||""),"TR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["transport_from"]),"TR",0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$to_desc[0]),0,0,"C");
        if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
		
		//New Line
		//Line 2
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LRB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',''),"RB",0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$to_desc_1),0,0,"C");
        if (is_null($row["actual_start_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"RB",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"RB",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"RB",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"RB",1,"C");

        // $y = $pdf->GetY();
        // $pdf->Line(35, $f_line, 35, $y);
        // $pdf->Line(55, $f_line, 55, $y);
        // $pdf->Line(75, $f_line, 75, $y);
        // $pdf->Line(100, $f_line, 100, $y);
        // $pdf->Line(120, $f_line, 120, $y);
        // //$pdf->Line(140, $f_line, 140, $y);
        // $pdf->Line(160, $f_line, 160, $y);
        // $pdf->Line(180, $f_line, 180, $y);

        // $pdf->Line(15, $y, 200, $y);

        $date1 = new DateTime(date_format($row["start_date"],'Y-m-d')." ".date_format($row["start_time"],"H:i"));
        $date2 = new DateTime(date_format($row["end_date"],'Y-m-d')." ".date_format($row["end_time"],"H:i"));
        $diff = $date2->diff($date1);
        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);

        //$y = $pdf->GetY() + 1;
		//New Line
		//Line 3
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R",1,"L");
		//New Line
		//Line 4
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
		//New Line
		//Line 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LRB",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(69,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		//if ($row["quantity"] >= $row["minimum_charge_hour"])
			//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		//else
		//	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["minimum_charge_hour"].' '.$row["uom_desc"]),0,1,"L");
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		//$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		//$pdf->Cell(95,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".' Diesel rate : '.$row["diesel_rate"]),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

		//End Bydo
		$LineCount+=1;
		//SEM

        // $y = $pdf->GetY();
        // $pdf->Line(10, $f_line, 10, $y);
        // $pdf->Line(15, $f_line, 15, $y);
        // $pdf->Line(200, $f_line, 200, $y);
        $x++;
		// $c++;
		// $ch++;
		// $last = 0;


		// if ($ch == 3 and $ct == 0 and $m == 0) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ch%3 == 0 and $ch > 3 and $ct == 0) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 1 and $ch%3 == 2 and $m == 0) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 2 and $ch == 1 and $m == 0) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 2 and $ch%3 == 1 and $ch > 3 and $m == 0) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }

		// if ($ct%3 == 0 and $ch%3 == 0 and $ct > 0) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		//if ($m%3 == 2 and $ch == 1 and $ct == 0) {
		//	$y = $pdf->GetY();
		//	$pdf->SetLineWidth(0.4);
		//	$pdf->Line(10, $y, 200, $y);
		//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		//	$last = 1;
		//}

		// if ($m%3 == 1 and $ch == 2 and $ct%3 == 1) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }

		// if ($m%3 == 1 and $ch > 2 and $ch%3 == 2) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }

		// if ($ct == 1 and $ch == 2 ) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 2 and $m%3 == 1 and $ch == 3) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 0 and $m%3 == 2 and $ch%3 == 1) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 1 and $m%3 == 1 and $ch == 1) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 2 and $m%3 == 2 and $ch%3 == 2) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct == 0 and $m%3 == 2 and $ch == 1) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 0 and $m%3 == 2 and $ch == 1) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct%3 == 0 and $m%3 == 1 and $ch == 2) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }
		// if ($ct == 1 and $m == 3 and $ch == 2) {
		// 	$y = $pdf->GetY();
		// 	$pdf->SetLineWidth(0.4);
		// 	$pdf->Line(10, $y, 200, $y);
		// 	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		// 	$last = 1;
		// }

    }
	// $iquery = "SELECT top 1 a.* from worksheet_cargo_handling a
    // WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    // $stmt = sqlsrv_query($conn, $iquery);

	// while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	// 	if ($last == 0){
	// 		$y = $pdf->GetY();
	// 		$pdf->SetLineWidth(0.4);
	// 		$pdf->Line(10, $y, 200, $y);
	// 	}
	// }










//-- Service Other
	// and a.no_charge = 0
	$iquery = "SELECT top 1 a.* from worksheet_service a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);


	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}		

		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Service Other'),0,1,"L");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620','Description 2'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','Qty'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','UOM'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
	}

    $iquery = "SELECT a.*,b.name,b.lastname,b.company, u.description as uom_desc, a.agreement_number as erp_contract_no
	from worksheet_service a
    left join operator b on a.operator = b.operator_id
	left join uom u on a.uom = u.code
	left join customer_contract cc on a.agreement_number = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
	
    $stmt = sqlsrv_query($conn, $iquery);

	$so = 0;
    $x = 1;
		//SEM
		$LineCount=0;
		//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		
		//SEM
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
		//Line 1
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["cargo_service_id"]),"TR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR",0,"C");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),"TR",0,"C");
        //$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,0,"C");
        //$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["quantity"]),"TR",0,"C");
        $line_x=$pdf->GetX();
		$line_y=$pdf->GetY();
		$pdf->MultiCell(10,6,iconv( 'UTF-8','TIS-620',$row["uom"]),"TR","C");
        $pdf->SetXY($line_x+10,$line_y);
		if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");

		//Line 2
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LRB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        if (is_null($row["actual_start_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"RB",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"RB",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"RB",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"RB",1,"C");
       

		//Line 3

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$line_y=$pdf->GetY();
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R","L");
		$pdf->SetY($line_y+6);
		//Line 4
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
		//Line 4
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//Line 5
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LRB",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");

        //$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		//$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		//$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;

    }















//-- Immigration
	$LineCount=0;
	$iquery = "SELECT top 1 a.* from worksheet_immigration a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Immigration'),0,1,"L");
		//Head line
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620','Expat name'),"T",0,"C");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','Qty'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','UOM'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");

	}

    $iquery = "SELECT a.*, u.description as uom_desc, cc.erp_contract_no
	from worksheet_immigration a
	left join uom u on a.uom = u.code
	left join customer_contract cc on a.agreement_number = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

    $x = 1;
	$im = 0;
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		$LineCount+=1;
		//SEM
		//Line 1
		$line_xy=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["immigration_id"]),"TR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',$row["expat_name"]),"T",0,"C");
        $line_x=$pdf->GetX();
		$pdf->MultiCell(45,6,iconv( 'UTF-8','TIS-620',$row["service"]),"LTR","C");
		//$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,0,"C");
        //$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,0,"C");
		$pdf->SetXY($line_x+45, $line_xy); 		
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["quantity"]),"TR",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["uom_desc"]||""),"TR",0,"C");
        if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");

		//Line 1
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        if (is_null($row["actual_start_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");

       
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R",1,"L");
		//Line 3
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
		//Line 4
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//Line 5
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");

        //$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom"]),0,1,"L");
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		//$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["agreement_number"]),0,0,"L");
		//$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
		//SEM
		
		//SEM
        $x++;		
    }
















//-- Taxi Service
	$iquery = "SELECT top 1 a.* from worksheet_taxi a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup )
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620','Taxi Service'),0,1,"L");

		
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LTR",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"TR",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Vehicle'),"TR",0,"C");
		$pdf->Cell(35,6,iconv( 'UTF-8','TIS-620','Driver'),"TR",0,"C");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Operated By'),0,0,"C");
		$pdf->Cell(32,6,iconv( 'UTF-8','TIS-620','From'),"TR",0,"C");
		$pdf->Cell(33,6,iconv( 'UTF-8','TIS-620','To'),"TR",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"TR",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
	}
	$iquery = "SELECT a.*,b.name,b.lastname,b.company,b.tel, u.description as uom_desc, v.registration_no, cc.erp_contract_no
	from worksheet_taxi a
    left join operator b on a.operator = b.operator_id
	left join uom u on a.uom = u.code
	left join vehicle v on a.vehicle = v.vehicle_id
	left join customer_contract cc on a.contract_no = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

    $x = 1;
	$t = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
		//Line 1
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["taxi_service_id"]),"TR",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["registration_no"]||""),"TR",0,"C",0);
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',$row["name"].' '.$row["lastname"]),"TR",0,"C");
		$pdf->Cell(32,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$pdf->Cell(33,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
        if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',($row["end_date"]?date_format($row["end_date"],"d-M-y"):"")),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");

		//Line 2
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LRB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',$row["tel"]||""),"RB",0,"C");
        $pdf->Cell(32,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$from_desc_1),0,0,"C");
        $pdf->Cell(33,6,iconv( 'UTF-8','TIS-620',($to_desc_1?$to_desc_1:"")),"RB",0,"C");
        if (is_null($row["actual_start_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"RB",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"RB",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',($row["end_time"]?date_format($row["end_time"],"H:i"):"")),"RB",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"RB",1,"C");

		//Line 3
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R",1,"L");
		//Line 4
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(115,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
		//Line 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//Line 5
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LRB",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"RB",1,"L");

		//SEM
		$LineCount+=1;		
		//SEM
         $x++;
    }
	



















//-- Agency Service
	// and a.no_charge = 0
	$iquery = "SELECT top 1 a.* from worksheet_agency_service a
    WHERE worksheet_id = '$worksheet_id' and status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);


	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}		

		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Agency Service'),0,1,"L");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620','Description 2'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','Qty'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','UOM'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
	}

    // $iquery = "SELECT a.*,b.name,b.lastname,b.company, u.description as uom_desc, a.agreement_number as erp_contract_no
	// from worksheet_agency_service a
    // left join operator b on a.operator = b.operator_id
	// left join uom u on a.uom = u.code
	// left join customer_contract cc on a.agreement_number = cc.contract_no
    // WHERE worksheet_id = '$worksheet_id' and status <> 'Cancelled' and a.no_charge = 0 ";

	$iquery = "
	SELECT
	a.*,
	b.name,
	b.lastname,
	b.company,
	u.description AS uom_desc,
	cc.contract_no AS erp_contract_no  
	FROM
	worksheet_agency_service a
	LEFT JOIN operator b ON a.operator_id = b.operator_id
	LEFT JOIN uom u ON a.uom = u.code
	LEFT JOIN customer_contract cc ON a.contract_number_auto = cc.contract_no 
	WHERE
	a.worksheet_id = '$worksheet_id' 
	AND a.status <> 'Cancelled' 
	and no_charge <> 1
	";
	
	// echo $iquery;
	// die;
    $stmt = sqlsrv_query($conn, $iquery);

	$so = 0;
    $x = 1;
		//SEM
		$LineCount=0;
		//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		
		//SEM
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
		//Line 1
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["agencyservice_id"]),"TR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR",0,"C");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description_contract"]||""),"TR",0,"C");
        //$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,0,"C");
        //$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["qty"]),"TR",0,"C");
        $line_x=$pdf->GetX();
		$line_y=$pdf->GetY();
		$pdf->MultiCell(10,6,iconv( 'UTF-8','TIS-620',$row["uom"]),"TR","C");
        $pdf->SetXY($line_x+10,$line_y);
		if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["actual_start_date"]))),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["end_date"]))),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["actual_finish_date"]))),"TR",1,"C");
			
		//Line 2
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LRB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        if (is_null($row["actual_start_time"]) ) 
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["start_time"]))),"RB",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["actual_start_time"]))),"RB",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["end_time"]))),"RB",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["actual_finish_time"]))),"RB",1,"C");
       

		//Line 3

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$line_y=$pdf->GetY();
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R","L");
		$pdf->SetY($line_y+6);
		//Line 4
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
		//Line 4
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//Line 5
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LRB",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");

        //$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		//$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		//$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;

    }


















//-- Management Fee
	// and a.no_charge = 0
	$iquery = "SELECT top 1 a.* from worksheet_management_free a
    WHERE worksheet_id = '$worksheet_id' and status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);


	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}		

		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Management Fee'),0,1,"L");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620','Description 2'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','Qty'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','UOM'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
	}

    // $iquery = "SELECT a.*,b.name,b.lastname,b.company, u.description as uom_desc, a.agreement_number as erp_contract_no
	// from worksheet_management_free a
    // left join operator b on a.operator = b.operator_id
	// left join uom u on a.uom = u.code
	// left join customer_contract cc on a.agreement_number = cc.contract_no
    // WHERE worksheet_id = '$worksheet_id' and status <> 'Cancelled' and a.no_charge = 0 ";

	$iquery = "
	SELECT
	a.*,
	b.name,
	b.lastname,
	b.company,
	u.description AS uom_desc,
	cc.contract_no AS erp_contract_no  
	FROM
	worksheet_management_free a
	LEFT JOIN operator b ON a.operator_id = b.operator_id
	LEFT JOIN uom u ON a.uom = u.code
	LEFT JOIN customer_contract cc ON a.contract_number_auto = cc.contract_no 
	WHERE
	a.worksheet_id = '$worksheet_id' 
	AND a.status <> 'Cancelled' 
	and no_charge <> 1
	";
	
	// echo $iquery;
	// die;
    $stmt = sqlsrv_query($conn, $iquery);

	$so = 0;
    $x = 1;
		//SEM
		$LineCount=0;
		//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		
		//SEM
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
		//Line 1
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["managementfree_id"]),"TR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR",0,"C");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description_contract"]||""),"TR",0,"C");
        //$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,0,"C");
        //$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["qty"]),"TR",0,"C");
        $line_x=$pdf->GetX();
		$line_y=$pdf->GetY();
		$pdf->MultiCell(10,6,iconv( 'UTF-8','TIS-620',$row["uom"]),"TR","C");
        $pdf->SetXY($line_x+10,$line_y);
		if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["actual_start_date"]))),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["end_date"]))),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["actual_finish_date"]))),"TR",1,"C");
			
		//Line 2
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LRB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        if (is_null($row["actual_start_time"]) ) 
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["start_time"]))),"RB",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["actual_start_time"]))),"RB",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["end_time"]))),"RB",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["actual_finish_time"]))),"RB",1,"C");
       

		//Line 3

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$line_y=$pdf->GetY();
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R","L");
		$pdf->SetY($line_y+6);
		//Line 4
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
		//Line 4
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//Line 5
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LRB",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");

        //$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		//$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		//$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;

    }



	






















//-- Provision Income
	// and a.no_charge = 0
	$iquery = "SELECT top 1 a.* from worksheet_provision_income a
    WHERE worksheet_id = '$worksheet_id' and status <> 'Cancelled' and no_charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);


	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}		

		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Provision Income'),0,1,"L");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620','Description 2'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','Qty'),"T",0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','UOM'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),"TR",1,"C");
	}

    // $iquery = "SELECT a.*,b.name,b.lastname,b.company, u.description as uom_desc, a.agreement_number as erp_contract_no
	// from worksheet_provision_income a
    // left join operator b on a.operator = b.operator_id
	// left join uom u on a.uom = u.code
	// left join customer_contract cc on a.agreement_number = cc.contract_no
    // WHERE worksheet_id = '$worksheet_id' and status <> 'Cancelled' and a.no_charge = 0 ";

	$iquery = "
	SELECT
	a.*,
	b.name,
	b.lastname,
	b.company,
	u.description AS uom_desc,
	cc.contract_no AS erp_contract_no  
	FROM
	worksheet_provision_income a
	LEFT JOIN operator b ON a.operator_id = b.operator_id
	LEFT JOIN uom u ON a.uom = u.code
	LEFT JOIN customer_contract cc ON a.contract_number_auto = cc.contract_no 
	WHERE
	a.worksheet_id = '$worksheet_id' 
	AND a.status <> 'Cancelled' 
	and no_charge <> 1
	";
	
	// echo $iquery;
	// die;
    $stmt = sqlsrv_query($conn, $iquery);

	$so = 0;
    $x = 1;
		//SEM
		$LineCount=0;
		//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		
		//SEM
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
		//Line 1
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["provisionincome_id"]),"TR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR",0,"C");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description_contract"]),"TR",0,"C");
        //$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,0,"C");
        //$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["qty"]),"TR",0,"C");
        $line_x=$pdf->GetX();
		$line_y=$pdf->GetY();
		$pdf->MultiCell(10,6,iconv( 'UTF-8','TIS-620',$row["uom"]),"TR","C");
        $pdf->SetXY($line_x+10,$line_y);
		if (is_null($row["actual_start_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"TR",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["actual_start_date"]))),"TR",0,"C");
		if (is_null($row["actual_finish_date"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["end_date"]))),"TR",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["actual_finish_date"]))),"TR",1,"C");
			
		//Line 2
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LRB",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',""),"RB",0,"C");
        if (is_null($row["actual_start_time"]) ) 
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["start_time"]))),"RB",0,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["actual_start_time"]))),"RB",0,"C");
		if (is_null($row["actual_finish_time"]) )
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["end_time"]))),"RB",1,"C");
		else
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date("H:i", strtotime($row["actual_finish_time"]))),"RB",1,"C");
       

		//Line 3

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Charge as: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',"Contract Line No: "),0,0,"L");
		$line_y=$pdf->GetY();
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),"R","L");
		$pdf->SetY($line_y+6);
		//Line 4
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");
		//Line 4
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#3: ".$row["ref3"]),"R",1,"L");
		//Line 5
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LRB",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Ref#4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Ref#5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Ref#6: ".$row["ref6"]),"BR",1,"L");

        //$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		//$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		//$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;

    }




















///////////////////////////////// worksheet_customer_clearance_cargo ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //-- worksheet_customer_clearance_cargo
	$iquery = "SELECT TOP
	1  worksheet_customer_clearance_cargo.* 
	FROM
	dbo.worksheet_customer_clearance_cargo 
	WHERE
	dbo.worksheet_customer_clearance_cargo.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Clearance Cargo'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Type 1'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Type 2'),"T",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Type 3'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Custom Entry From'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Start'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Finish'),"TR",1,"C");
		// 190
	}


	$iquery = '

	SELECT TOP
	1 worksheet_customer_clearance_cargo.customerclearancecargo_id as "service_id",
	barcode_service.type_service_name as "name",
	barcode_location.location_name as "location",
	barcode_product_type.product_type_name  AS "type",
	worksheet_customer_clearance_cargo.description,
	\'\' AS "start_date",
	\'\' AS "end_date",
	worksheet_customer_clearance_cargo.contract_number,
	worksheet_customer_clearance_cargo.qty,
	worksheet_customer_clearance_cargo.uom,
	worksheet_customer_clearance_cargo.ref1,
	worksheet_customer_clearance_cargo.ref2,
	worksheet_customer_clearance_cargo.ref3,
	worksheet_customer_clearance_cargo.ref4,
	worksheet_customer_clearance_cargo.ref5,
	worksheet_customer_clearance_cargo.ref6
	FROM
	dbo.worksheet_customer_clearance_cargo 
	LEFT JOIN barcode_service on barcode_service.no_service = worksheet_customer_clearance_cargo.type
	LEFT JOIN barcode_location on barcode_location.no_location = worksheet_customer_clearance_cargo.location

	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type =  worksheet_customer_clearance_cargo.[type]
	WHERE
	dbo.worksheet_customer_clearance_cargo.worksheet_id = \''.$worksheet_id.'\'
	AND "status" <> \'Cancelled\' and charge <> 1

	';
	
	// echo $iquery ;
	// die;
    $stmt = sqlsrv_query($conn, $iquery);



    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        // $from_desc = newline($row["from_desc"],10);
        // $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        // $to_desc = newline($row["to_desc"],10);
        // $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
		// file_put_contents($path_barcode.$file_barcode,$barcode);

		// if ($x == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		// } else if ($x == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		// } else if ($x == 3) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		// } else if ($x%3 == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		// } else if ($x%3 == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		// } else if ($x%3 == 0) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		// }
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["service_id"]),'TR',0,"C");

		// $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["type"]),'TR',0,"C");
		// if ($row["vowner_desc"] == 'AAL')
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',($row["type"]==""?"Non":$row["type"])),'TR',0,"C");
		// else
		// 	$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["location"]),"TR",0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',""),"TR","C");
		$pdf->SetXY($line_x+20,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
		// if (is_null($row["actual_start_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"RT",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"RT",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"RT",0,"C");
		// if (is_null($row["actual_finish_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"RT",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',date("d-M-y", strtotime($row["start_date"]))),"TR",1,"C");
        


		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        // $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		//SEM

		// if (is_null($row["actual_start_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"L"),"BR",0,"C");
		// if (is_null($row["actual_finish_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"D"),"BR",1,"C");

			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",1,"C");

		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Fixdc Space: ".$row["fix_space"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["contract_number"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',""),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["qty"].' '.$row["uom"]),"R",1,"L");
		
		//New Line
		//Line 4
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 6: ".$row["ref6"]),"BR",1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }




	///////////////////////////////// END /////////////////////////////////

































	
///////////////////////////////// worksheet_customer_clearance_vessel ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    //-- worksheet_customer_clearance_vessel
	$iquery = "SELECT TOP
	1  worksheet_customer_clearance_vessel.* 
	FROM
	dbo.worksheet_customer_clearance_vessel 
	WHERE
	dbo.worksheet_customer_clearance_vessel.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and charge <> 1";
    $stmt = sqlsrv_query($conn, $iquery);

	
	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM
		if($FirstGroup)
		{
			$FirstGroup=false;
		}else{
			$pdf->AddPage();
		}
		//SEM
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Clearance Vessel'),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),"LT",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Service ID'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Type 1'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Type 2'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Type 3'),"T",0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Custom Entry From'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Description'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Start'),"T",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Finish'),"TR",1,"C");
		// 190
	}


	$iquery = '

	SELECT TOP
	1 worksheet_customer_clearance_vessel.customerclearancevessel_id as "service_id",
	barcode_service.type_service_name as "name",
	worksheet_customer_clearance_vessel.vessel_name,
	worksheet_customer_clearance_vessel.vessel_weight,
	worksheet_customer_clearance_vessel.vessel_length,
	worksheet_customer_clearance_vessel.vessel_draft,
	
	worksheet_customer_clearance_vessel.clearance_port,
	worksheet_customer_clearance_vessel.description,
	
	worksheet_customer_clearance_vessel.startdate,
	worksheet_customer_clearance_vessel.finishdate,
	
	barcode_product_type.product_type_name  AS "type",

	worksheet_customer_clearance_vessel.contract_number,
	worksheet_customer_clearance_vessel.qty,
	worksheet_customer_clearance_vessel.uom,
	worksheet_customer_clearance_vessel.ref1,
	worksheet_customer_clearance_vessel.ref2,
	worksheet_customer_clearance_vessel.ref3,
	worksheet_customer_clearance_vessel.ref4,
	worksheet_customer_clearance_vessel.ref5,
	worksheet_customer_clearance_vessel.ref6
	FROM
	dbo.worksheet_customer_clearance_vessel 
	LEFT JOIN barcode_service on barcode_service.no_service = worksheet_customer_clearance_vessel.type
	LEFT JOIN barcode_location on barcode_location.no_location = worksheet_customer_clearance_vessel.location

	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type =  worksheet_customer_clearance_vessel.[type]
	WHERE
	dbo.worksheet_customer_clearance_vessel.worksheet_id = \''.$worksheet_id.'\'
	AND "status" <> \'Cancelled\' and charge <> 1

	';
	


    $stmt = sqlsrv_query($conn, $iquery);



    $x = 1;
	$ct = 0;
	//SEM
	$LineCount=0;
	//SEM
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		//SEM	
		if($LineCount>=$LinePage)
		{
			$LineCount=0;
			$pdf->AddPage();
		}
		//SEM
        // $from_desc = newline($row["from_desc"],10);
        // $from_desc_1 = isset($from_desc[1])?$from_desc[1]:"";

        // $to_desc = newline($row["to_desc"],10);
        // $to_desc_1 = isset($to_desc[1])?$to_desc[1]:"";

		// $img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');
		// $file_barcode = $row["transport_id"].".png";
		// $barcode = $generator->getBarcode(urldecode(trim($row["transport_id"])), $generator::TYPE_CODE_128);
		// file_put_contents($path_barcode.$file_barcode,$barcode);

		// if ($x == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		// } else if ($x == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,171,25,10);
		// } else if ($x == 3) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,207,25,10);
		// } else if ($x%3 == 1) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		// } else if ($x%3 == 2) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		// } else if ($x%3 == 0) {
		// 	// $pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,201,25,10);
		// }
		//New Line
		//Line 1
		$line_y=$pdf->GetY();
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LTR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["service_id"]),'TR',0,"C");

		// $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["type"]),'TR',0,"C");
		// if ($row["vowner_desc"] == 'AAL')
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',($row["type"]==""?"Non":$row["type"])),'TR',0,"C");
		// else
		// 	$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),'TR',0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vessel_name"]),"TR",0,"C");	
		$line_x=$pdf->GetX();
		$pdf->MultiCell(25,6,iconv( 'UTF-8','TIS-620',""),"TR","C");
		$pdf->SetXY($line_x+25,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),"TR",0,"C");
		$line_x=$pdf->GetX();
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["description"]),"TR","C");
		$pdf->SetXY($line_x+30,$line_y);
		//$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),"TR",0,"C");
		// if (is_null($row["actual_start_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),"RT",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_date"],"d-M-y")),"RT",0,"C");

			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',($row["startdate"]!=""?date("d-M-y", strtotime($row["startdate"])):"")),"RT",0,"C");
		// if (is_null($row["actual_finish_date"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),"RT",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_date"],"d-M-y")),"TR",1,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',($row["finishdate"]!=""?date("d-M-y", strtotime($row["finishdate"])):"")),"TR",1,"C");
        


		//New Line
		//Line 2
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),"LBR",0,"C");
        // $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"R",0,"C");

		//SEM
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$from_desc_1),"BR",0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$to_desc_1),"BR",0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
		//SEM

		// if (is_null($row["actual_start_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),"BR",0,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_start_time"],"H:i")),"BR",0,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"L"),"BR",0,"C");
		// if (is_null($row["actual_finish_time"]) )
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),"BR",1,"C");
		// else
		// 	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["actual_finish_time"],"H:i")),"BR",1,"C");
			// $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"D"),"BR",1,"C");

			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",0,"C");
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),"BR",1,"C");

		//New Line
		//Line 3
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Fixdc Space: ".$row["fix_space"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Contract Number: ".$row["contract_number"]),0,0,"L");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',""),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["qty"].' '.$row["uom"]),"R",1,"L");
		
		//New Line
		//Line 4
		//$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		//$pdf->Cell(125,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),"R",1,"L");

		//New Line
		//LIne 5
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 1: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 2: ".$row["ref2"]),0,0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 3: ".$row["ref3"]),"R",1,"L");
		//New Line
		//Line 6
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),"LBR",0,"C");
		$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"Remark 4: ".$row["ref4"]),"B",0,"L");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620',"Remark 5: ".$row["ref5"]),"B",0,"L");
		$pdf->Cell(70,6,iconv( 'UTF-8','TIS-620',"Remark 6: ".$row["ref6"]),"BR",1,"L");


		//SEM
		$LineCount+=1;
		//SEM
        $x++;
    }




	///////////////////////////////// END /////////////////////////////////





}





    $pdf->Output();

?>