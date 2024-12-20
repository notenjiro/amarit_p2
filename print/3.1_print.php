<?php 
    ini_set('display_errors', 'Off');
    define('FPDF_FONTPATH','font/');
    require('fpdf182/fpdf.php');	

    require_once '../config_db.php';
    require_once '../utils/helper.php';
	require_once '../vendor/autoload.php';

	use Intervention\Image\ImageManager;  
  
	$manager = new ImageManager();   

    $GLOBALS["worksheet_id"] = $_GET['worksheet_id'];
    $worksheet_id = $_GET['worksheet_id'];
	$iquery = "SELECT *, a.remark as remark, b.name as customer_name,b.erp_id, u.name as user_name from worksheet a join customer b on a.customer = b.customer_id join subject c on a.subject = c.code left join users u on u.user_name = a.user_id  WHERE worksheet_id = '$worksheet_id' ";
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
	$GLOBALS["user_name"] = $row["user_name"];
	$GLOBALS["manager_name"] = $row["manager_name"];
	$GLOBALS["customer_id"] = $row["erp_id"];
	$GLOBALS["customer_ref"] = $row["customer_ref"];

	$path_barcode = "../images/picbarcode/";		
	$file_barcode = $_GET['worksheet_id'].".png";
    $full_savePath = $path_barcode.$file_barcode;

	$img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$_GET['worksheet_id'])->save('../images/picbarcode/'.$_GET['worksheet_id'].'.png');
 
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
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620','FM-OP-05'),0,1,"R");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',''),0,1,"L");
            $this->Cell(0,6,iconv( 'UTF-8','TIS-620','Page '.$this->PageNo().' of {nb}'),0,1,"R");
			$this->Cell(25,8,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["contract"]),0,0,"L");
            $this->Cell(0,8,iconv( 'UTF-8','TIS-620',$GLOBALS["worksheet_id"].'  '.$GLOBALS["branch"].'      '),0,1,"R");
			$this->Cell(35,8,"",0,0,"L");
			$this->Cell(0,6.5,iconv( 'UTF-8','TIS-620',$GLOBALS["customer_name"]),0,1,"L");
            //$this->Cell(0,8,iconv( 'UTF-8','TIS-620',date_format($GLOBALS["worksheet_date"],"d-M-y").'   '),0,1,"R");
			//$this->Cell(25,6,"",0,0,"L");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address"]),0,1,"L");			
			$this->Cell(25,5,"",0,0,"L");
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address"]),0,0,"L");	
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address2"].",".$GLOBALS["province"].",".$GLOBALS["postcode"]),0,0,"L");
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',date_format($GLOBALS["worksheet_date"],"d-M-y").'      '),0,1,"R");
			$this->Cell(25,6,"",0,0,"L");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["tel"]),0,1,"L");
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["address2"].",".$GLOBALS["province"].",".$GLOBALS["postcode"]),0,1,"L");
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["customer_id"].'      '),0,1,"R");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			$this->Cell(25,6,"",0,0,"L");			
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["description"]),0,1,"L");
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["customer_ref"].'      '),0,1,"R");
			//$this->Cell(0,6,iconv( 'UTF-8','TIS-620',''),0,1,"L");
			$this->Cell(15,6,"",0,0,"L");
			$this->Cell(0,6,iconv( 'UTF-8','TIS-620',$GLOBALS["remark"]),0,1,"L");
			

        }            
        //Page footer
        function Footer()
        {
			$this->SetY(-26);
			$this->Cell(25,8,"",0,0,"L");
			$this->Cell(0,8,iconv( 'UTF-8','TIS-620',$GLOBALS["user_name"].' / '.$GLOBALS["manager_name"]),0,1,"L");
        }

	}

    $pdf=new PDF('P','mm',array(210,279));
    $pdf->SetMargins(10, 0, 10, true);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->AddFont('angsa','','angsa.php');
    $pdf->SetFont('angsa','',14);
	$pdf->SetAutoPageBreak(true,30);

    //-- Transportation
	//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',''),0,1,"L");
	
	$pdf->Image('../images/picbarcode/'.$_GET['worksheet_id'].'.png',10,35,35,13);

	$iquery = "SELECT top 1 a.* from worksheet_cargo_transport a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Transportation'),0,1,"L");

		$y = $pdf->GetY();
		$f_line = $y;

		$pdf->SetLineWidth(0.4);
		$pdf->Line(10, $y, 210-10, $y);

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),0,0,"C");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Vehicle Type'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','License No.'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Company'),0,0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Operated By'),0,0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','From'),0,0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','To'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),0,1,"C");

		$y = $pdf->GetY();
		$pdf->Line(10, $f_line, 10, $y);
		$pdf->Line(200, $f_line, 200, $y);
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
    WHERE worksheet_id = '$worksheet_id' AND no_charge = 0 and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery); 

    $x = 1;
	$ct = 0;
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

		$img = $manager->make('http://localhost:8181/gen_barcode.php?code='.$row["transport_id"])->save('../images/picbarcode/'.$row["transport_id"].'.png');

		if ($x == 1) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,135,25,10);
		} else if ($x == 2) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,165,25,10);
		} else if ($x == 3) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,195,25,10);
		} else if ($x == 4) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,225,25,10);
		} else if (($x == 5) or ($x == 9) or ($x == 13) or ($x == 17) or ($x == 21) or ($x == 25) or ($x == 29) or ($x == 33) or ($x == 37) or ($x == 41) or ($x == 45) or ($x == 49) or ($x == 53) or ($x == 57) or ($x == 61) or ($x == 65) or ($x == 69) or ($x == 73) or ($x == 77) or ($x == 81) or ($x == 85) or ($x == 89) or ($x == 93) or ($x == 97) or ($x == 101) or ($x == 105) or ($x == 109) or ($x == 113) or ($x == 117) or ($x == 121) or ($x == 125) or ($x == 129) or ($x == 133) or ($x == 137) or ($x == 141) or ($x == 145) or ($x == 149) or ($x == 153) or ($x == 157) or ($x == 161) or ($x == 165) or ($x == 169) or ($x == 173) or ($x == 177) or ($x == 181) or ($x == 185) or ($x == 189) or ($x == 193) or ($x == 197) or ($x == 201) or ($x == 205) or ($x == 209) or ($x == 213) or ($x == 217) or ($x == 221) or ($x == 225) or ($x == 229) or ($x == 233) or ($x == 237) or ($x == 241) or ($x == 245) or ($x == 249) or ($x == 253) or ($x == 257) or ($x == 261) or ($x == 265) or ($x == 269) or ($x == 273) or ($x == 277) or ($x == 281) or ($x == 285) or ($x == 289) or ($x == 293) or ($x == 297) or ($x == 301) or ($x == 305) or ($x == 309) or ($x == 313) or ($x == 317) or ($x == 321) or ($x == 325) or ($x == 329) or ($x == 333) or ($x == 337) or ($x == 341) or ($x == 345) or ($x == 349) or ($x == 353) or ($x == 357) or ($x == 361) or ($x == 365) or ($x == 369) or ($x == 373) or ($x == 377) or ($x == 381) or ($x == 385) or ($x == 389) or ($x == 393) or ($x == 397) or ($x == 401) or ($x == 405) or ($x == 409) or ($x == 413) or ($x == 417) or ($x == 421) or ($x == 425) or ($x == 429) or ($x == 433) or ($x == 437) or ($x == 441) or ($x == 445) or ($x == 449) or ($x == 453) or ($x == 457) or ($x == 461) or ($x == 465) or ($x == 469) or ($x == 473) or ($x == 477) or ($x == 481) or ($x == 485) or ($x == 489) or ($x == 493) or ($x == 497) or ($x == 501)) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,129,25,10);
		} else if (($x == 6) or ($x == 10) or ($x == 14) or ($x == 18) or ($x == 22) or ($x == 26) or ($x == 30) or ($x == 34) or ($x == 38) or ($x == 42) or ($x == 46) or ($x == 50) or ($x == 54) or ($x == 58) or ($x == 62) or ($x == 66) or ($x == 70) or ($x == 74) or ($x == 78) or ($x == 82) or ($x == 86) or ($x == 90) or ($x == 94) or ($x == 98) or ($x == 102) or ($x == 106) or ($x == 110) or ($x == 114) or ($x == 118) or ($x == 122) or ($x == 126) or ($x == 130) or ($x == 134) or ($x == 138) or ($x == 142) or ($x == 146) or ($x == 150) or ($x == 154) or ($x == 158) or ($x == 162) or ($x == 166) or ($x == 170) or ($x == 174) or ($x == 178) or ($x == 182) or ($x == 186) or ($x == 190) or ($x == 194) or ($x == 198) or ($x == 202) or ($x == 206) or ($x == 210) or ($x == 214) or ($x == 218) or ($x == 222) or ($x == 226) or ($x == 230) or ($x == 234) or ($x == 238) or ($x == 242) or ($x == 246) or ($x == 250) or ($x == 254) or ($x == 258) or ($x == 262) or ($x == 266) or ($x == 270) or ($x == 274) or ($x == 278) or ($x == 282) or ($x == 286) or ($x == 290) or ($x == 294) or ($x == 298) or ($x == 302) or ($x == 306) or ($x == 310) or ($x == 314) or ($x == 318) or ($x == 322) or ($x == 326) or ($x == 330) or ($x == 334) or ($x == 338) or ($x == 342) or ($x == 346) or ($x == 350) or ($x == 354) or ($x == 358) or ($x == 362) or ($x == 366) or ($x == 370) or ($x == 374) or ($x == 378) or ($x == 382) or ($x == 386) or ($x == 390) or ($x == 394) or ($x == 398) or ($x == 402) or ($x == 406) or ($x == 410) or ($x == 414) or ($x == 418) or ($x == 422) or ($x == 426) or ($x == 430) or ($x == 434) or ($x == 438) or ($x == 442) or ($x == 446) or ($x == 450) or ($x == 454) or ($x == 458) or ($x == 462) or ($x == 466) or ($x == 470) or ($x == 474) or ($x == 478) or ($x == 482) or ($x == 486) or ($x == 490) or ($x == 494) or ($x == 498)) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,159,25,10);
		} else if (($x == 7) or ($x == 11) or ($x == 15) or ($x == 19) or ($x == 23) or ($x == 27) or ($x == 31) or ($x == 35) or ($x == 39) or ($x == 43) or ($x == 47) or ($x == 51) or ($x == 55) or ($x == 59) or ($x == 63) or ($x == 67) or ($x == 71) or ($x == 75) or ($x == 79) or ($x == 83) or ($x == 87) or ($x == 91) or ($x == 95) or ($x == 99) or ($x == 103) or ($x == 107) or ($x == 111) or ($x == 115) or ($x == 119) or ($x == 123) or ($x == 127) or ($x == 131) or ($x == 135) or ($x == 139) or ($x == 143) or ($x == 147) or ($x == 151) or ($x == 155) or ($x == 159) or ($x == 163) or ($x == 167) or ($x == 171) or ($x == 175) or ($x == 179) or ($x == 183) or ($x == 187) or ($x == 191) or ($x == 195) or ($x == 199) or ($x == 203) or ($x == 207) or ($x == 211) or ($x == 215) or ($x == 219) or ($x == 223) or ($x == 227) or ($x == 231) or ($x == 235) or ($x == 239) or ($x == 243) or ($x == 247) or ($x == 251) or ($x == 255) or ($x == 259) or ($x == 263) or ($x == 267) or ($x == 271) or ($x == 275) or ($x == 279) or ($x == 283) or ($x == 287) or ($x == 291) or ($x == 295) or ($x == 299) or ($x == 303) or ($x == 307) or ($x == 311) or ($x == 315) or ($x == 319) or ($x == 323) or ($x == 327) or ($x == 331) or ($x == 335) or ($x == 339) or ($x == 343) or ($x == 347) or ($x == 351) or ($x == 355) or ($x == 359) or ($x == 363) or ($x == 367) or ($x == 371) or ($x == 375) or ($x == 379) or ($x == 383) or ($x == 387) or ($x == 391) or ($x == 395) or ($x == 399) or ($x == 403) or ($x == 407) or ($x == 411) or ($x == 415) or ($x == 419) or ($x == 423) or ($x == 427) or ($x == 431) or ($x == 435) or ($x == 439) or ($x == 443) or ($x == 447) or ($x == 451) or ($x == 455) or ($x == 459) or ($x == 463) or ($x == 467) or ($x == 471) or ($x == 475) or ($x == 479) or ($x == 483) or ($x == 487) or ($x == 491) or ($x == 495) or ($x == 499)) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,189,25,10);
		} else if (($x == 8) or ($x == 12) or ($x == 16) or ($x == 20) or ($x == 24) or ($x == 28) or ($x == 32) or ($x == 36) or ($x == 40) or ($x == 44) or ($x == 48) or ($x == 52) or ($x == 56) or ($x == 60) or ($x == 64) or ($x == 68) or ($x == 72) or ($x == 76) or ($x == 80) or ($x == 84) or ($x == 88) or ($x == 92) or ($x == 96) or ($x == 100) or ($x == 104) or ($x == 108) or ($x == 112) or ($x == 116) or ($x == 120) or ($x == 124) or ($x == 128) or ($x == 132) or ($x == 136) or ($x == 140) or ($x == 144) or ($x == 148) or ($x == 152) or ($x == 156) or ($x == 160) or ($x == 164) or ($x == 168) or ($x == 172) or ($x == 176) or ($x == 180) or ($x == 184) or ($x == 188) or ($x == 192) or ($x == 196) or ($x == 200) or ($x == 204) or ($x == 208) or ($x == 212) or ($x == 216) or ($x == 220) or ($x == 224) or ($x == 228) or ($x == 232) or ($x == 236) or ($x == 240) or ($x == 244) or ($x == 248) or ($x == 252) or ($x == 256) or ($x == 260) or ($x == 264) or ($x == 268) or ($x == 272) or ($x == 276) or ($x == 280) or ($x == 284) or ($x == 288) or ($x == 292) or ($x == 296) or ($x == 300) or ($x == 304) or ($x == 308) or ($x == 312) or ($x == 316) or ($x == 320) or ($x == 324) or ($x == 328) or ($x == 332) or ($x == 336) or ($x == 340) or ($x == 344) or ($x == 348) or ($x == 352) or ($x == 356) or ($x == 360) or ($x == 364) or ($x == 368) or ($x == 372) or ($x == 376) or ($x == 380) or ($x == 384) or ($x == 388) or ($x == 392) or ($x == 396) or ($x == 400) or ($x == 404) or ($x == 408) or ($x == 412) or ($x == 416) or ($x == 420) or ($x == 424) or ($x == 428) or ($x == 432) or ($x == 436) or ($x == 440) or ($x == 444) or ($x == 448) or ($x == 452) or ($x == 456) or ($x == 460) or ($x == 464) or ($x == 468) or ($x == 472) or ($x == 476) or ($x == 480) or ($x == 484) or ($x == 488) or ($x == 492) or ($x == 496) or ($x == 500)) {
			$pdf->Image('../images/picbarcode/'.$row['transport_id'].'.png',173,219,25,10);
		}

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["transport_id"]),0,0,"C");
		//$pdf->SetXY(35, $y); 
		//$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["vtype_desc"]),0,"C");
		$pdf->SetXY(35, $y); 
		$pdf->MultiCell(20,6,iconv( 'UTF-8','TIS-620',$row["registration_no"]),0,"C",0);
		$pdf->SetXY(52, $y);
		if ($row["vowner_desc"] == 'AAL')
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vowner_desc"]),0,0,"C");
		else
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),0,0,"C");
        $pdf->Cell(22,6,iconv( 'UTF-8','TIS-620',$row["operate_by"]),0,0,"C");
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),0,"C");
		$pdf->SetXY(130, $y);
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),0,"C");
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
        //$pdf->Line(120, $f_line, 120, $y);
        $pdf->Line(130, $f_line, 130, $y);
        $pdf->Line(160, $f_line, 160, $y);
        $pdf->Line(180, $f_line, 180, $y);

        $pdf->Line(15, $y, 200, $y);

        $y = $pdf->GetY() + 1;
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		$pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
        //$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Vehicle type: ".$row["vtype_desc"]),0,0,"L");
		$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620'," "),0,0,"L");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Contract No. : ".$row["erp_contract_no"]),0,0,"L");
		//$pdf->Cell(60,6,iconv( 'UTF-8','TIS-620',"| Vehicle type: ".$row["vtype_desc"]),0,0,"L");
		//$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"Diesel : ".$row["diesel_rate"]),0,0,"L");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cargo Qty : ".$row["cargo_qty"]),0,0,"L");
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',"| Weight : ".$row["cargo_weight"]." KGS"),0,0,"L");
		$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',"KGS"),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        
        $y = $pdf->GetY();
        $pdf->Line(10, $f_line, 10, $y);
        $pdf->Line(15, $f_line, 15, $y);
        $pdf->Line(200, $f_line, 200, $y);
        $x++;
		$ct++;
		$last = 0;

		if ($ct == 4 ) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		if ($ct == 8 or $ct == 12 or $ct == 16 or $ct == 24 or $ct == 28 or $ct == 32 or $ct == 36 or $ct == 40 or $ct == 44 or $ct == 48 or $ct == 52 or $ct == 56 or $ct == 60 or $ct == 64 or $ct == 68 or $ct == 72 or $ct == 76 or $ct == 80 or $ct == 84 or $ct == 20 or $ct == 88 or $ct == 92 or $ct == 96 or $ct == 100 or $ct == 104 or $ct == 108 or $ct == 112 or $ct == 116 or $ct == 120 or $ct == 124 or $ct == 128 or $ct == 132 or $ct == 136 or $ct == 140 or $ct == 144 or $ct == 148 or $ct == 152 or $ct == 156 or $ct == 160 or $ct == 164 or $ct == 168 or $ct == 172 or $ct == 176 or $ct == 180 or $ct == 184 or $ct == 188 or $ct == 192 or $ct == 196 or $ct == 200 or $ct == 204 or $ct == 208 or $ct == 212 or $ct == 216 or $ct == 220 or $ct == 224 or $ct == 228 or $ct == 232 or $ct == 236 or $ct == 240 or $ct == 244 or $ct == 248 or $ct == 252 or $ct == 256 or $ct == 260 or $ct == 264 or $ct == 268 or $ct == 272 or $ct == 276 or $ct == 280 or $ct == 284 or $ct == 288 or $ct == 292 or $ct == 296 or $ct == 300 or $ct == 304 or $ct == 308 or $ct == 312 or $ct == 316 or $ct == 320 or $ct == 324 or $ct == 328 or $ct == 332 or $ct == 336 or $ct == 340 or $ct == 344 or $ct == 348 or $ct == 352 or $ct == 356 or $ct == 360 or $ct == 364 or $ct == 368 or $ct == 372 or $ct == 376 or $ct == 380 or $ct == 384 or $ct == 388 or $ct == 392 or $ct == 396 or $ct == 400 or $ct == 404 or $ct == 408 or $ct == 412 or $ct == 416 or $ct == 420 or $ct == 424 or $ct == 428 or $ct == 432 or $ct == 436 or $ct == 440 or $ct == 444 or $ct == 448 or $ct == 452 or $ct == 456 or $ct == 460 or $ct == 464 or $ct == 468 or $ct == 472 or $ct == 476 or $ct == 480 or $ct == 484 or $ct == 488 or $ct == 492 or $ct == 496 or $ct == 500) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		//if ($ct == 2){
		//	$y = $pdf->GetY(); 
		//	$pdf->SetLineWidth(0.4);
		//	$pdf->Line(10, $y, 200, $y);
		//}
		
    }     
	$iquery = "SELECT top 1 a.* from worksheet_cargo_transport a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($last == 0){
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
		}
	}

    //$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");

    //-- Manpower
    //$pdf->SetTextColor(65,105,225);
	$iquery = "SELECT top 1 a.* from worksheet_manpower a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge = 0 ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Manpower'),0,1,"L");

		$y = $pdf->GetY();
		$f_line = $y;

		$pdf->SetLineWidth(0.4);
		$pdf->Line(10, $y, 210-10, $y);

		//$pdf->SetTextColor(0,0,0);
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),0,0,"C");
		$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620','Position'),0,0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Operator'),0,0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Company'),0,0,"C");
		$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620','Operated at'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),0,1,"C");

		$y = $pdf->GetY();
		$pdf->Line(10, $f_line, 10, $y);
		$pdf->Line(200, $f_line, 200, $y);
	}

    $iquery = "SELECT a.*,b.name,b.lastname,b.company,c.description as location_desc, u.description as uom_desc, p.description as charge_as_deas, cc.erp_contract_no
    from worksheet_manpower a 
    left join operator b on a.labor = b.operator_id 
    left join location c on a.location = c.code
	left join uom u on a.uom = u.code
	left join position p on p.code = a.charge_as
	left join customer_contract cc on a.contract_no = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge = 0 ";
    $stmt = sqlsrv_query($conn, $iquery); 

    $x = 1;
	$m = 0;
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){   
        $y = $pdf->GetY(); 
        $pdf->SetLineWidth(0.4);
        $pdf->Line(10, $y, 200, $y);
        $pdf->SetLineWidth(0.2);
        $f_line = $y;

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["labor_service_id"]),0,0,"C");
        $pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',$row["position"]),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["name"]." ".$row["lastname"]),0,0,"C");
		if ($row["company"] == 'AAL')
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["company"]),0,0,"C");
		else
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),0,0,"C");
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["company"]),0,0,"C");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',$row["location"]),0,0,"C");
		$pdf->MultiCell(30,6,iconv( 'UTF-8','TIS-620',$row["location"]),0,"C");
		$pdf->SetXY(160, $y);
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),0,1,"C");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),0,1,"C");

        $y = $pdf->GetY();

        $pdf->Line(35, $f_line, 35, $y);
        $pdf->Line(72, $f_line, 72, $y);
        $pdf->Line(108, $f_line, 108, $y);
        $pdf->Line(130, $f_line, 130, $y);
        //$pdf->Line(140, $f_line, 140, $y);
        $pdf->Line(160, $f_line, 160, $y);
        $pdf->Line(180, $f_line, 180, $y);

        $pdf->Line(15, $y, 200, $y);

        $y = $pdf->GetY() + 1;

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

        $y = $pdf->GetY();
        $pdf->Line(10, $f_line, 10, $y);
        $pdf->Line(15, $f_line, 15, $y);
        $pdf->Line(200, $f_line, 200, $y);
        
        $x++;
		$c++;
		$m++;
		$last = 0;

		//if ($ct == 0 and ($m == 2 or $m == 4)) {
		//	$y = $pdf->GetY(); 
		//	$pdf->SetLineWidth(0.4);
		//	$pdf->Line(10, $y, 200, $y);
		//}

		if ($ct == 3 and $m == 6) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
			//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}

		if ($ct == 21 and $m == 4) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}
		if ($ct == 21 and ($m == 9 or $m == 14 or $m == 19)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}

		if ($ct == 3 and $m == 1) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}

		if ($ct == 1 and $m == 3) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}

		if ($ct == 6 and $m == 2) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}

		if ($ct == 7 and $m == 1) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}

		if ($ct == 2 and $m == 2) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}

		if ($m == 5 and $ct == 0) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}
		if (($m == 10 or $m == 15 or $m == 20 or $m == 25 or $m == 30 or $m == 35 or $m == 40 or $m == 45 or $m == 50 or $m == 55 or $m == 60) and ($ct == 0)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		if ($ct == 8 and $m == 5) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}
		

    }     
	$iquery = "SELECT top 1 a.* from worksheet_manpower a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge = 0 ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($last == 0){
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
		}
	}

	//if ($c ==3) {
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//}

    //-- Handling
    //$pdf->SetTextColor(65,105,225);
	$iquery = "SELECT top 1 a.* from worksheet_cargo_handling a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){

		if (($ct == 0 or $ct == 4) and $m ==4) {
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		}

		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Cargo Handling'),0,1,"L");

		$y = $pdf->GetY();
		$f_line = $y;

		$pdf->SetLineWidth(0.4);
		$pdf->Line(10, $y, 210-10, $y);

		//$pdf->SetTextColor(0,0,0);
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Vehicle Type'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','License No.'),0,0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Company'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Operated By'),0,0,"C");
		$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620','Operated at'),0,0,"C");
		//$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','To'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),0,1,"C");

		$y = $pdf->GetY();
		$pdf->Line(10, $f_line, 10, $y);
		$pdf->Line(200, $f_line, 200, $y);
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
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and no_charge = 0 ";
    $stmt = sqlsrv_query($conn, $iquery); 

    $x = 1;
	$ch = 0;
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

        //$pdf->SetTextColor(0,0,0);
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["cargo_service_id"]),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["vtype_desc"]),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["registration_no"]),0,0,"C");
		if ($row["vowner_desc"] == 'AAL')
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vowner_desc"]),0,0,"C");
		else
			$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','AAL Other'),0,0,"C");
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',$row["vowner_desc"]),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["operate_by"]),0,0,"C");
        $pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',$row["transport_from"]),0,0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$to_desc[0]),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),0,1,"C");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',''),0,0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$to_desc_1),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),0,1,"C");

        $y = $pdf->GetY();
        $pdf->Line(35, $f_line, 35, $y);
        $pdf->Line(55, $f_line, 55, $y);
        $pdf->Line(75, $f_line, 75, $y);
        $pdf->Line(100, $f_line, 100, $y);
        $pdf->Line(120, $f_line, 120, $y);
        //$pdf->Line(140, $f_line, 140, $y);
        $pdf->Line(160, $f_line, 160, $y);
        $pdf->Line(180, $f_line, 180, $y);

        $pdf->Line(15, $y, 200, $y);

        $date1 = new DateTime(date_format($row["start_date"],'Y-m-d')." ".date_format($row["start_time"],"H:i"));
        $date2 = new DateTime(date_format($row["end_date"],'Y-m-d')." ".date_format($row["end_time"],"H:i"));
        $diff = $date2->diff($date1);
        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);

        $y = $pdf->GetY() + 1;
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(69,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		//if ($row["quantity"] >= $row["minimum_charge_hour"]) 
			$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		//else
		//	$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["minimum_charge_hour"].' '.$row["uom_desc"]),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(95,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".' Diesel rate : '.$row["diesel_rate"]),0,0,"L");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        
        $y = $pdf->GetY();
        $pdf->Line(10, $f_line, 10, $y);
        $pdf->Line(15, $f_line, 15, $y);
        $pdf->Line(200, $f_line, 200, $y);
        $x++;
		$c++;
		$ch++;
		$last = 0;

		if ($ch == 5 and $ct == 0) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}

		if (($ct == 1 and $m == 2 and $ch == 1) or ($ct == 3 and $ch == 1)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		if (($ct == 2 and $m == 0 and $ch == 2) or ($ct == 7 and $ch == 1) or ($ct == 11 and $ch == 1) or ($ct == 20 and $ch == 5) or ($ct == 19 and $ch == 1) or ($ct == 16 and $ch == 5) or ($ct == 23 and $ch == 1) or ($ct == 12 and $ch == 5) or ($ct == 15 and $ch == 1) or ($ct == 27 and $ch == 1) ) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		if (($ct == 6 and $ch == 2) or ($ct == 10 and $ch == 2) or ($ct == 1 and $ch == 3) or ($ct == 14 and $ch == 2) or ($ct == 18 and $ch == 2)or ($ct == 22 and $ch == 2) or ($ct == 26 and $ch == 2) or ($ct == 30 and $ch == 2) or ($ct == 1 and $ch == 8) or ($ct == 1 and $ch == 13) or ($ct == 1 and $ch == 18) or ($ct == 1 and $ch == 23) or ($ct == 1 and $ch == 28) or ($ct == 1 and $ch == 33) or ($ct == 1 and $ch == 38)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		if (($ct == 25 and $ch == 4) or ($ct == 29 and $ch == 4) or ($ct == 9 and $ch == 4)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last == 1;
		}

		if ($m == 18 and $ch == 2) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		if (($m == 28 and $ch == 2) or ($m == 14 and $ch == 1)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		
		if ($ct == 5 and $m == 2 and $ch == 1) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}

		if ($ct == 2 and $m == 4 and $ch == 2) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}

		if ($ct == 35 and $ch == 1) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		

    }     
	$iquery = "SELECT top 1 a.* from worksheet_cargo_handling a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($last == 0){
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
		}
	}

    //$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");

	//if ($cc ==2 and $c ==2) {
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
		//$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//}
	//if ($cc ==1 and $c ==2) {
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//	$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
	//}

	//-- Service Other
    //$pdf->SetTextColor(65,105,225);
	$iquery = "SELECT top 1 a.* from worksheet_service a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){

		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Service Other'),0,1,"L");

		$y = $pdf->GetY();
		$f_line = $y;

		$pdf->SetLineWidth(0.4);
		$pdf->Line(10, $y, 210-10, $y);

		//$pdf->SetTextColor(0,0,0);
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),0,0,"C");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620','Description'),0,0,"C");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620','Description 2'),0,0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','Qty'),0,0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','UOM'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),0,1,"C");

		$y = $pdf->GetY();
		$pdf->Line(10, $f_line, 10, $y);
		$pdf->Line(200, $f_line, 200, $y);
	}

    $iquery = "SELECT a.*,b.name,b.lastname,b.company, u.description as uom_desc, a.agreement_number as erp_contract_no 
	from worksheet_service a 
    left join operator b on a.operator = b.operator_id
	left join uom u on a.uom = u.code
	left join customer_contract cc on a.agreement_number = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery); 

	$so = 0;
    $x = 1;
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){   
        $y = $pdf->GetY(); 
        $pdf->SetLineWidth(0.4);
        $pdf->Line(10, $y, 200, $y);
        $pdf->SetLineWidth(0.2);
        $f_line = $y;

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["cargo_service_id"]),0,0,"C");
		$pdf->SetXY(45, $y); 
		$pdf->MultiCell(40,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,"C");
		$pdf->SetXY(95, $y); 
		$pdf->MultiCell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,"C",0);
        //$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,0,"C");
        //$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,0,"C");
		$pdf->SetXY(140, $y);
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["quantity"]),0,0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["uom"]),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),0,1,"C");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),0,1,"C");

        $y = $pdf->GetY();

        $pdf->Line(35, $f_line, 35, $y);
        $pdf->Line(92, $f_line, 92, $y);
        $pdf->Line(140, $f_line, 140, $y);
        $pdf->Line(150, $f_line, 150, $y);
        $pdf->Line(160, $f_line, 160, $y);
        $pdf->Line(180, $f_line, 180, $y);

        $pdf->Line(15, $y, 200, $y);

        $y = $pdf->GetY() + 1;

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

        $y = $pdf->GetY();
        $pdf->Line(10, $f_line, 10, $y);
        $pdf->Line(15, $f_line, 15, $y);
        $pdf->Line(200, $f_line, 200, $y);
        
        $x++;
		$so++;
		$last = 0;

		if ($ct == 2 and $ch == 1 and $so == 1) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}

		

		if (($ct == 6 and $ch == 2 and $so == 5) or ($ct == 5 and $m == 1 and $so == 2) or ($ct == 2 and  $so == 2)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
    }     
	$iquery = "SELECT top 1 a.* from worksheet_service a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($last == 0){
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
		}
	}   

	//-- Immigration
    //$pdf->SetTextColor(65,105,225);
    //$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Immirgation'),0,1,"L");

	
	$iquery = "SELECT top 1 a.* from worksheet_immigration a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){ 

		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',' Immigration'),0,1,"L");

		$y = $pdf->GetY();
		$f_line = $y;

		$pdf->SetLineWidth(0.4);
		$pdf->Line(10, $y, 210-10, $y);

		//$pdf->SetTextColor(0,0,0);
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),0,0,"C");
		$pdf->Cell(55,6,iconv( 'UTF-8','TIS-620','Expat name'),0,0,"C");
		$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620','Description'),0,0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','Qty'),0,0,"C");
		$pdf->Cell(10,6,iconv( 'UTF-8','TIS-620','UOM'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),0,1,"C");

		$y = $pdf->GetY();
		$pdf->Line(10, $f_line, 10, $y);
		$pdf->Line(200, $f_line, 200, $y);
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
        $y = $pdf->GetY(); 
        $pdf->SetLineWidth(0.4);
        $pdf->Line(10, $y, 200, $y);
        $pdf->SetLineWidth(0.2);
        $f_line = $y;

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["immigration_id"]),0,0,"C");
		$pdf->SetXY(45, $y); 
		$pdf->MultiCell(40,6,iconv( 'UTF-8','TIS-620',$row["expat_name"]),0,"C");
		$pdf->SetXY(95, $y); 
		$pdf->MultiCell(45,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,"C",0);
        //$pdf->Cell(50,6,iconv( 'UTF-8','TIS-620',$row["description"]),0,0,"C");
        //$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',$row["description2"]),0,0,"C");
		$pdf->SetXY(140, $y);
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["quantity"]),0,0,"C");
        $pdf->Cell(10,6,iconv( 'UTF-8','TIS-620',$row["uom_desc"]),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),0,1,"C");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),0,1,"C");

        $y = $pdf->GetY();

        $pdf->Line(35, $f_line, 35, $y);
        $pdf->Line(92, $f_line, 92, $y);
        $pdf->Line(140, $f_line, 140, $y);
        $pdf->Line(150, $f_line, 150, $y);
        $pdf->Line(160, $f_line, 160, $y);
        $pdf->Line(180, $f_line, 180, $y);

        $pdf->Line(15, $y, 200, $y);

        $y = $pdf->GetY() + 1;

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(79,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom"]),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["agreement_number"]),0,0,"L");
		$pdf->Cell(45,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		//$pdf->Cell(40,6,iconv( 'UTF-8','TIS-620',"| Dept : ".$row["department"]),0,0,"L");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"| Cost center : ".$row["cost_center"]),0,0,"L");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");
        //$pdf->SetTextColor(65,105,225);
        //$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',"Amount:"),0,0,"L");
        //$pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

        $y = $pdf->GetY();
        $pdf->Line(10, $f_line, 10, $y);
        $pdf->Line(15, $f_line, 15, $y);
        $pdf->Line(200, $f_line, 200, $y);
        
        $x++;
		$im++;

		if ($im == 5) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last == 1;
		}
    }     
	$iquery = "SELECT top 1 a.* from worksheet_immigration a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		$y = $pdf->GetY(); 
		$pdf->SetLineWidth(0.4);
		$pdf->Line(10, $y, 200, $y);
	}

	//-- Taxi Service
	$iquery = "SELECT top 1 a.* from worksheet_taxi a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620','Taxi Service'),0,1,"L");

		$y = $pdf->GetY();
		$f_line = $y;

		$pdf->SetLineWidth(0.4);
		$pdf->Line(10, $y, 210-10, $y);

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620','No.'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Service ID'),0,0,"C");
		$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Vehicle'),0,0,"C");
		$pdf->Cell(35,6,iconv( 'UTF-8','TIS-620','Driver'),0,0,"C");
		//$pdf->Cell(25,6,iconv( 'UTF-8','TIS-620','Operated By'),0,0,"C");
		$pdf->Cell(32,6,iconv( 'UTF-8','TIS-620','From'),0,0,"C");
		$pdf->Cell(33,6,iconv( 'UTF-8','TIS-620','To'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Started'),0,0,"C");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620','Finished'),0,1,"C");

		$y = $pdf->GetY();
		$pdf->Line(10, $f_line, 10, $y);
		$pdf->Line(200, $f_line, 200, $y);
	}
	$iquery = "SELECT a.*,b.name,b.lastname,b.company,b.tel, u.description as uom_desc, v.registration_no, cc.erp_contract_no
	from worksheet_taxi a 
    left join operator b on a.operator = b.operator_id
	left join uom u on a.uom = u.code
	left join vehicle v on a.vehicle = v.vehicle_id
	left join customer_contract cc on a.contract_no = cc.contract_no
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery); 

    $x = 1;
	$t = 0;
    while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){

		$y = $pdf->GetY(); 
        $pdf->SetLineWidth(0.4);
        $pdf->Line(10, $y, 200, $y);
        $pdf->SetLineWidth(0.2);
        $f_line = $y;

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$row["taxi_service_id"]),0,0,"C");
		$pdf->SetXY(35, $y); 
		$pdf->MultiCell(25,6,iconv( 'UTF-8','TIS-620',$row["registration_no"]),0,"C",0);
		$pdf->SetXY(60, $y);
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',$row["name"].' '.$row["lastname"]),0,0,"C");
		$pdf->MultiCell(32,6,iconv( 'UTF-8','TIS-620',$row["specific_location_from"]),0,"C");
		$pdf->SetXY(127, $y);
		$pdf->MultiCell(32,6,iconv( 'UTF-8','TIS-620',$row["specific_location_to"]),0,"C");
		$pdf->SetXY(159, $y);
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_date"],"d-M-y")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_date"],"d-M-y")),0,1,"C");

        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',$x),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',$row["tel"]),0,0,"C");
        $pdf->Cell(32,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        //$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',$from_desc_1),0,0,"C");
        $pdf->Cell(34,6,iconv( 'UTF-8','TIS-620',$to_desc_1),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["start_time"],"H:i")),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',date_format($row["end_time"],"H:i")),0,1,"C");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(32,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(34,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(25,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(35,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(32,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(34,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");

        $y = $pdf->GetY();

        $pdf->Line(35, $f_line, 35, $y);
		$pdf->Line(60, $f_line, 60, $y);
		$pdf->Line(95, $f_line, 95, $y);
        $pdf->Line(128, $f_line, 128, $y);
        //$pdf->Line(140, $f_line, 140, $y);
        //$pdf->Line(150, $f_line, 150, $y);
        $pdf->Line(160, $f_line, 160, $y);
        $pdf->Line(180, $f_line, 180, $y);

        $pdf->Line(15, $y, 200, $y);

        $y = $pdf->GetY() + 1;

		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Passenger details: ".$row["contact"]),0,1,"L");
        $pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
        $pdf->Cell(85,6,iconv( 'UTF-8','TIS-620',"Remark: ".$row["remark"]),0,0,"L");
		$pdf->Cell(69,6,iconv( 'UTF-8','TIS-620',"| Ref.: ".$row["ref1"]),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".$row["quantity"].' '.$row["uom_desc"]),0,1,"L");
		$pdf->Cell(5,6,iconv( 'UTF-8','TIS-620',""),0,0,"C");
		$pdf->Cell(59,6,iconv( 'UTF-8','TIS-620',"Contract No. :".$row["erp_contract_no"]),0,0,"L");
		$pdf->Cell(95,6,iconv( 'UTF-8','TIS-620',"| Charge As: ".$row["charge_as"]),0,0,"L");
		$pdf->Cell(20,6,iconv( 'UTF-8','TIS-620',"| ".' Diesel rate : '.$row["diesel_rate"]),0,0,"L");
        $pdf->Cell(30,6,iconv( 'UTF-8','TIS-620',""),0,1,"L");

        $y = $pdf->GetY();
        $pdf->Line(10, $f_line, 10, $y);
        $pdf->Line(15, $f_line, 15, $y);
        $pdf->Line(200, $f_line, 200, $y);
        
        $x++;
		$t++;
		$last = 0;

		if ($t == 3) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
		if (($t == 6) or ($t == 9)) {
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$pdf->Cell(0,6,iconv( 'UTF-8','TIS-620',""),0,1,"C");
			$last = 1;
		}
    }   

	$iquery = "SELECT top 1 a.* from worksheet_taxi a
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
    $stmt = sqlsrv_query($conn, $iquery);

	while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
		if ($last == 0){
			$y = $pdf->GetY(); 
			$pdf->SetLineWidth(0.4);
			$pdf->Line(10, $y, 200, $y);
		}
	}

    $pdf->Output();       

?>