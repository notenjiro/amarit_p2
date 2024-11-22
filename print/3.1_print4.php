<?php
ini_set('display_errors', 'On');
define('FPDF_FONTPATH', 'font/');
require('fpdf182/fpdf.php');

require_once '../config_db.php';
require_once '../utils/helper.php';
require_once '../vendor/autoload.php';

// use Intervention\Image\ImageManager;

// $manager = new ImageManager();
session_start();

if (substr($_GET['worksheet_id'], 0, 2) == "WS") {
    $isWs = true;
} else {
    $isWs = false;
}

$GLOBALS["user_type"] = $_SESSION["user_type"];
$GLOBALS["worksheet_id"] = $_GET['worksheet_id'];
$worksheet_id = $_GET['worksheet_id'];



if (isset($_GET["optionPrint"])) {
    $GLOBALS["optionPrint"] = $_GET["optionPrint"];
} else {
    $GLOBALS["optionPrint"] = 1;
}



function print_count()
{
    require './../config_db.php';

    $worksheet_id = $_GET['worksheet_id'];

    if (!isset($_GET["preview"])) {
        $iquery = "MERGE INTO print_count AS target USING (SELECT '" . $worksheet_id . "' AS worksheet_id) AS source ON target.worksheet_id = source.worksheet_id WHEN MATCHED THEN UPDATE SET target.print_count = target.print_count + 1 WHEN NOT MATCHED THEN INSERT (worksheet_id, print_count) VALUES (source.worksheet_id, 1) OUTPUT inserted.print_count;";
        $stmt = sqlsrv_query($conn, $iquery);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $print_count = $row["print_count"];
    } else {
        $iquery = "SELECT print_count.print_count FROM print_count WHERE print_count.worksheet_id = '" . $worksheet_id . "';";
        $stmt = sqlsrv_query($conn, $iquery);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $print_count = $row["print_count"];
    }

    if ($print_count == "") {
        $print_count = "-";
    }
    return $print_count;
}
$GLOBALS["print_count"] = print_count();

if ($isWs) {
    $iquery = "SELECT *, a.remark as remark, b.name as customer_name,b.erp_id, u.name as user_name from worksheet a join customer b on a.customer = b.customer_id join subject c on a.subject = c.code left join users u on u.user_name = a.user_id  WHERE worksheet_id = '$worksheet_id' ";
} else {
    $iquery = "SELECT *, a.remark as remark, b.name as customer_name,b.erp_id, u.name as user_name from job a join customer b on a.customer = b.customer_id join subject c on a.subject = c.code left join users u on u.user_name = a.user_id  WHERE job_id = '$worksheet_id' ";
}

$stmt = sqlsrv_query($conn, $iquery);

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

$GLOBALS["worksheet_date"] = ($isWs ? $row["worksheet_date"] : $row["job_date"]);
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

$file_barcode = $_GET['worksheet_id'] . ".png";

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$barcode = $generator->getBarcode(urldecode(trim($_GET['worksheet_id'])), $generator::TYPE_CODE_128);


if (!file_put_contents($path_barcode . $file_barcode, $barcode)) {
    echo 'Can not generate barcode.';
}




class PDF extends FPDF
{


    protected $extgstates = array();

    function SetAlpha($alpha, $bm = 'Normal')
    {
        $gs = $this->AddExtGState(array('ca' => $alpha, 'CA' => $alpha, 'BM' => '/' . $bm));
        $this->SetExtGState($gs);
    }

    function AddExtGState($parms)
    {
        $n = count($this->extgstates) + 1;
        $this->extgstates[$n]['parms'] = $parms;
        return $n;
    }

    function SetExtGState($gs)
    {
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function _enddoc()
    {
        if (!empty($this->extgstates) && $this->PDFVersion < '1.4')
            $this->PDFVersion = '1.4';
        parent::_enddoc();
    }

    function _putextgstates()
    {
        for ($i = 1; $i <= count($this->extgstates); $i++) {
            $this->_newobj();
            $this->extgstates[$i]['n'] = $this->n;
            $this->_put('<</Type /ExtGState');
            $parms = $this->extgstates[$i]['parms'];
            $this->_put(sprintf('/ca %.3F', $parms['ca']));
            $this->_put(sprintf('/CA %.3F', $parms['CA']));
            $this->_put('/BM ' . $parms['BM']);
            $this->_put('>>');
            $this->_put('endobj');
        }
    }

    function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_put('/ExtGState <<');
        foreach ($this->extgstates as $k => $extgstate)
            $this->_put('/GS' . $k . ' ' . $extgstate['n'] . ' 0 R');
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
        if ($text === '')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line) {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word) {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth) {
                    // Word is too long, we cut it
                    for ($i = 0; $i < strlen($word); $i++) {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if ($width + $wordwidth <= $maxwidth) {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        } else {
                            $width = $wordwidth;
                            $text = rtrim($text) . "\n" . substr($word, $i, 1);
                            $count++;
                        }
                    }
                } elseif ($width + $wordwidth <= $maxwidth) {
                    $width += $wordwidth + $space;
                    $text .= $word . ' ';
                } else {
                    $width = $wordwidth + $space;
                    $text = rtrim($text) . "\n" . $word . ' ';
                    $count++;
                }
            }
            $text = rtrim($text) . "\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }




    var $angle = 0;

    function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }


    //Page header
    function Header()
    {
        $this->AddFont('angsa', '', 'angsa.php');


        $this->Image('../img/amarit_print_body.png', -3.1, 37, 216.5);


        $this->SetFont('angsa', '', 14);
        $this->SetY(48);
        $this->SetX(175);
        $this->Cell(0, 6, iconv('UTF-8', 'TIS-620', 'Page ' . $this->PageNo() . ' of {nb}'), 0, 1, "R");

        $this->SetY(55);
        $this->SetX(35);
        $this->Cell(90, 12, iconv('UTF-8', 'TIS-620', ($GLOBALS["contract"] == "" ? "" : $GLOBALS["contract"])), 0, 0, "L");
        $this->Cell(0, 12, iconv('UTF-8', 'TIS-620', $GLOBALS["worksheet_id"] . '  ' . $GLOBALS["branch"] . '      '), 0, 1, "R");

        if ($GLOBALS["user_type"] == "AAL") {
            $this->SetFont('angsa', '', 14);
            $this->SetFillColor(255, 255, 255);
            $this->Rect(130, 55.6, 22, 4.3, "F");
            $this->SetY(57.5);
            $this->SetX(129);
            $this->Cell(0, 0, iconv('UTF-8', 'TIS-620', 'Worksheet Number'), 0, 0, "L");
            $this->Cell(30, 12, "", 0, 0, "L");
            $this->SetFont('angsa', '', 14);
        }

        $this->SetY(70);
        $this->SetX(35);
        $this->Cell(90, 6, iconv('UTF-8', 'TIS-620', ($GLOBALS["customer_name"] == "" ? "" : $GLOBALS["customer_name"])), 0, 0, "L");
        $this->SetY(75);
        $this->SetX(35);
        $this->Cell(0, 6, iconv('UTF-8', 'TIS-620', ($GLOBALS["address"] == "" ? "" : $GLOBALS["address"])), 0, 0, "L");
        $this->SetY(80);
        $this->SetX(35);
        $this->Cell(0, 6, iconv('UTF-8', 'TIS-620', $GLOBALS["address2"] . "," . $GLOBALS["province"] . "," . $GLOBALS["postcode"]), 0, 0, "L");

        $this->SetY(92);
        $this->SetX(35);
        $this->Cell(0, 6, iconv('UTF-8', 'TIS-620', ($GLOBALS["description"] == "" ? "" : $GLOBALS["description"])), 0, 1, "L");

        $this->SetY(69);
        $this->SetX(35);
        $this->Cell(0, 6, iconv('UTF-8', 'TIS-620', ($GLOBALS["worksheet_date"] == "" ? "" : date_format($GLOBALS["worksheet_date"], "d-M-y") . '      ')), 0, 1, "R");
        $this->SetY(82);
        $this->SetX(-45);
        $this->Cell(30, 6, iconv('UTF-8', 'TIS-620', ($GLOBALS["customer_id"] == "" ? "" : $GLOBALS["customer_id"])), 0, 1, "R");

        $this->SetY(92);
        $this->SetX(158);
        if (strlen(($GLOBALS["remark"] == "" ? "" : $GLOBALS["remark"])) <= 40) {
            $this->SetFont('angsa', '', 14);
        } else {
            $this->SetFont('angsa', '', 10);
        }
        $this->MultiCell(42, 3, iconv('UTF-8', 'TIS-620', ($GLOBALS["remark"] == "" ? "" : $GLOBALS["remark"])), 0, "L");




        $this->optionPrint($GLOBALS["printType"], $GLOBALS["user_type"]);




        $this->SetY(105);

    }

    function optionPrint($type, $user)
    {
        if ($user == "AAL") {
            $this->Image('../img/amarit_print_header_1.1.png', 0, 0, 210);

            $this->SetY(19);
            $this->SetX(175);
            $this->SetFont('angsa', '', 16);
            $this->MultiCell(22, 6.5, iconv('UTF-8', 'TIS-620', ($type == 1 ? "Original" : "Copy") . "\n "), 1, "C", false);
            $this->SetY(23.5);
            $this->SetX(175);
            $this->SetFont('angsa', '', 12);
            $this->Cell(22, 8, iconv('UTF-8', 'TIS-620', ($type == 1 ? "ต้นฉบับ" : "สำเนา")), 0, 1, "C");

        } else {
            $this->Image('../img/amarit_print_header_2.1.png', 0, 0, 210);

            $this->SetY(6);
            $this->SetX(175);
            $this->SetFont('angsa', '', 16);
            $this->MultiCell(22, 6.5, iconv('UTF-8', 'TIS-620', ($type == 1 ? "Original" : "Copy") . "\n "), 1, "C", false);
            $this->SetY(10.5);
            $this->SetX(175);
            $this->SetFont('angsa', '', 12);
            $this->Cell(22, 8, iconv('UTF-8', 'TIS-620', ($type == 1 ? "ต้นฉบับ" : "สำเนา")), 0, 1, "C");
        }

        $this->Image('../images/picbarcode/' . $_GET['worksheet_id'] . '.png', 13, 35, 35, 13);
    }


    function RotatedText($x, $y, $txt, $angle)
    {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->SetFont('angsa', '', 140);
        $this->SetTextColor(230, 230, 230);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
        $this->SetTextColor(0, 0, 0);
    }


    //Page footer
    function Footer()
    {
        $this->Image('../img/amarit_print_footer.png', 0, 235, 210);
        $this->SetY(-42);
        $this->SetX(40);
        // $this->Cell(25,8,"",0,0,"L");

        $this->Cell(25, 8, iconv('UTF-8', 'TIS-620', $GLOBALS["user_name"] . ' / ' . $GLOBALS["manager_name"]), 0, 1, "L");
        // $this->Cell(35,11,"X",0,0,"L");
        $this->SetY(-29);
        $this->SetX(40);
        $this->Cell(0, 0, date_create('now', timezone_open('Asia/Bangkok'))->format('Y-m-d H:i:s'), 0, 0, "L");

        $this->SetY(-20);
        $this->SetX(-50);




        //$this->multicell(30, 8, iconv( 'UTF-8','TIS-620','Printed : พิมพ์ครั้งที่ : '.$GLOBALS["print_count"]), 1, 1, 'L');
        $this->SetFont('angsa', '', 16);
        $this->MultiCell(37, 8, iconv('UTF-8', 'TIS-620', 'Printed :                          '), 1, "L", false);
        $this->SetY(-14);
        $this->SetX(148);
        $this->SetFont('angsa', '', 14);
        $this->Cell(30, 8, iconv('UTF-8', 'TIS-620', 'พิมพ์ครั้งที่  '), 0, 1, "R");

        $this->SetY(-16);
        $this->SetX(165);
        $this->SetFont('angsa', '', 18);
        $this->Cell(30, 8, iconv('UTF-8', 'TIS-620', $GLOBALS["print_count"]), 0, 1, "R");

        if (isset($_GET["preview"])) {
            $this->SetAlpha(0.7);
            $this->RotatedText(35, 190, 'U n o f f c i a l', 45);
            $this->SetAlpha(1);
        }


    }


    function TextLength50CanPossibleOrNot($mode, $width, $title, $text)
    {

        $result = $title . " ";
        $align = "";
        $text = ($text==NULL?"":$text);
        if ($mode == 0) {
            for ($i = 0; $i < count($text); $i++) {
                $result .= ($i == 0 ? "" : "\n") . $text[$i];
            }
            $align = "C";
        } else {
            $result .= $text;
            $align = "L";
        }

        if (strlen($result) >= 25) {
            $this->SetFont('angsa', '', 10);
            $this->MultiCell($width, 3, iconv('UTF-8', 'TIS-620', $result), 0, $align, false);
        } else {
            $this->MultiCell($width, 6, iconv('UTF-8', 'TIS-620', $result), 0, $align, false);
        }

        // $pdf->SetFont('angsa','',14);
        // $this->MultiCell($width,6,iconv( 'UTF-8','TIS-620',$col_data["col_".$index]),0,"C",false);

        $this->SetFont('angsa', '', 14);
    }

}


$GLOBALS["printType"] = 1;
$pdf = new PDF('P', 'mm', array(210, 279));
$pdf->SetMargins(10, 0, 10);
$pdf->AliasNbPages();

$pdf->AddFont('angsa', '', 'angsa.php');
$pdf->SetFont('angsa', '', 14);
//$pdf->SetAutoPageBreak(true,30);




///SEM
$LinePage = 3;
$LineCount = 0;
$FirstGroup = true;
//SEM
















for ($ii = 1; $ii <= $GLOBALS["optionPrint"]; $ii++) {

    $GLOBALS["printType"] = $ii;

    $service_type = array(
        '',
        'Booking - Ticket || TEST',
        'Utilities || TEST',
        'Booking - Hotel || TEST'

    );








































    ///////////////////////////////// Booking - Ticket ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
    $service_id = 1;
    $iquery = <<<END
	SELECT worksheet_ticket_booking_job.ticketbooking_id AS "col_1",
	worksheet_ticket_booking_job.passenger as "col_2",
    worksheet_ticket_booking_job.description as "col_3",
	worksheet_ticket_booking_job.airline_name as "col_4",
	worksheet_ticket_booking_job.flight_number as "col_5",
	location.description AS "col_6",
    worksheet_ticket_booking_job.departure_date AS "col_6-1",
    location2.description AS "col_7",
    worksheet_ticket_booking_job.destination_date AS "col_7-1",

	barcode_product_type.product_type_name AS "detail_1",
	worksheet_ticket_booking_job.contract_number AS "detail_2",
	worksheet_ticket_booking_job.qty + ' ' + worksheet_ticket_booking_job.uom AS "detail_3",
    '' AS "detail_4",
    '' AS "detail_5",
    '' AS "detail_6",
	worksheet_ticket_booking_job.ref1 AS "detail_7",
	worksheet_ticket_booking_job.ref2 AS "detail_8",
	worksheet_ticket_booking_job.ref3 AS "detail_9",
	worksheet_ticket_booking_job.ref4 AS "detail_10",
	worksheet_ticket_booking_job.ref5 AS "detail_11",
	worksheet_ticket_booking_job.ref6 AS "detail_12"
	FROM
	dbo.worksheet_ticket_booking_job
	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type = worksheet_ticket_booking_job.type
	LEFT JOIN location ON location.code = worksheet_ticket_booking_job.departure_location
	LEFT JOIN location location2 ON LTRIM(STR(CAST(location2.code AS INT))) = worksheet_ticket_booking_job.destination_location
	WHERE
	dbo.worksheet_ticket_booking_job.worksheet_id = '$worksheet_id'
	AND 'status' <> 'Cancelled AND (no_charge <> 1 or no_charge is null)'
	
END;

    $stmt = sqlsrv_query($conn, $iquery, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $row_count = sqlsrv_num_rows($stmt);

    $service_name = $service_type[$service_id];

    $pdf->AddPage();
    $i = -1;
    $set_x = 10;
    $set_y = 124;
    $x = 10;
    $y = 117;

    $set_cell_1 = array(
        [5, "No."],
        [20, "Service ID"],
        [25, "Guest"],
        [20, "Description"],
        [30, "Airline"],
        [20, "Flight Number"],
        [35, "Departure"],
        [35, "Destination"],
    );

    $set_cell_2 = array(
        [5, ""],
        [20, ""],
        [25, ""],
        [20, ""],
        [30, ""],
        [20, ""],
        [35, ""],
        [35, ""],
    );

    $pdf->Cell(0, 6, iconv('UTF-8', 'TIS-620', ' ' . $service_name), 0, 1, "L");

    $total_cells = count($set_cell_1);

    foreach ($set_cell_1 as $index => $cell) {

        $width = $cell[0];
        $text = $cell[1];

        if ($index === $total_cells - 1) {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "RT", 1, "C");
        } else if ($index === 0) {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "LT", 0, "C");
        } else {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "T", 0, "C");
        }
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

        $i++;

        if ($i % 3 == 0 && $i != 0) {
            //echo '<br>--- BREAK';
            $pdf->AddPage();
            $y = 107;
            $set_y = 114;
        }



        $col_data = [
            "col_1" => [($row["col_1"] == "" ? "-" : $row["col_1"])],
            "col_2" => [($row["col_2"] == "" ? "-" : $row["col_2"])],
            "col_3" => [($row["col_3"] == "" ? "-" : $row["col_3"])],
            "col_4" => [($row["col_4"] == "" ? "-" : $row["col_4"])],
            "col_5" => [($row["col_5"] == "" ? "-" : $row["col_5"])],
            "col_6" => [($row["col_6"] == "" ? "-" : $row["col_6"])],
            [($row["col_6-1"] == "" ? "-" : $row["col_6-1"])],
            "col_7" => [($row["col_7"] == "" ? "-" : $row["col_7"])],
            [($row["col_7-1"] == "" ? "-" : $row["col_7-1"])],
        ];

        $row_detail = [
            0 => ["Ticket Type:", ($row["detail_1"] == "" ? "-" : $row["detail_1"])],
            1 => ["Contract Number:", ($row["detail_2"] == "" ? "-" : $row["detail_2"])],
            2 => ["|", ($row["detail_3"] == "" ? "-" : $row["detail_3"])],
            3 => ["From:", ($row["detail_4"] == "" ? "-" : $row["detail_4"])],
            4 => ["To:", ($row["detail_5"] == "" ? "-" : $row["detail_5"])],
            5 => ["Disel rate:", ($row["detail_6"] == "" ? "-" : $row["detail_6"])],
            6 => ["Remark 1:", ($row["detail_7"] == "" ? "-" : $row["detail_7"])],
            7 => ["Remark 2:", ($row["detail_8"] == "" ? "-" : $row["detail_8"])],
            8 => ["Remark 3:", ($row["detail_9"] == "" ? "-" : $row["detail_9"])],
            9 => ["Remark 4:", ($row["detail_10"] == "" ? "-" : $row["detail_10"])],
            10 => ["Remark 5:", ($row["detail_11"] == "" ? "-" : $row["detail_11"])],
            11 => ["Remark 6:", ($row["detail_12"] == "" ? "-" : $row["detail_12"])],
        ];

        $total_cells = count($set_cell_2);

        foreach ($set_cell_2 as $index => $cell) {

            $width = $cell[0];
            $text = $cell[1];

            $pdf->SetXY($x, $y);
            $pdf->MultiCell($width, 12, iconv('UTF-8', 'TIS-620', ($index == 0 ? $i + 1 : "")), ($index == 0 ? 1 : "TBR"), "C", false);

            if ($index != 0) {
                $pdf->SetXY($x, $y);
                $pdf->TextLength50CanPossibleOrNot(0, $width, "", $col_data["col_" . $index]);
            }

            $x = $x + $width;
        }

        $x = 10;
        $y = $y + 30;

        $pdf->SetXY($set_x, $set_y = $set_y + 5);
        $pdf->Cell(5, 18, iconv('UTF-8', 'TIS-620', ""), (($i + 1) % 3 == 0 || $i == 0 ? "LB" : "L"), 0, "C");
        $pdf->SetXY($set_x + 5, $set_y);
        $pdf->Cell(185, 18, iconv('UTF-8', 'TIS-620', ""), (($i + 1) % 3 == 0 || $i == 0 ? "LBR" : "LR"), 0, "C");

        $pdf->SetXY($set_x = $set_x + 5, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[0][0], $row_detail[0][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[1][0], $row_detail[1][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[2][0], $row_detail[2][1]);

        $pdf->SetXY($set_x = 15, $set_y = $set_y + 6);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[6][0], $row_detail[6][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[7][0], $row_detail[7][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[8][0], $row_detail[8][1]);
        $pdf->SetXY($set_x = 15, $set_y = $set_y + 6);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[9][0], $row_detail[9][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[10][0], $row_detail[10][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[11][0], $row_detail[11][1]);
        $set_x = 10;
        $set_y = $set_y + 13;


        if (($i + 1) == $row_count) {
            $pdf->Cell(190, 18, iconv('UTF-8', 'TIS-620', ""), "T", 0, "C");
        }


    }

*/































    ///////////////////////////////// Utilities ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
        $service_id = 2;
        $iquery = <<<END
        SELECT
        worksheet_utilities.utilities_id as "col_1",
        barcode_service.type_service_name as "col_2",
        barcode_location.location_name as "col_3",
        barcode_sub_type4.sub_type4 as "col_4",
        worksheet_utilities.description AS "col_5",
        worksheet_utilities.start_date AS "col_6",
        worksheet_utilities.end_date AS "col_7",
        worksheet_utilities.meter_record AS "detail_1",
        worksheet_utilities.contract_number AS "detail_2",
        worksheet_utilities.qty + ' ' + worksheet_utilities.uom AS "detail_3",
        worksheet_utilities.ref1 AS "detail_7",
        worksheet_utilities.ref2 AS "detail_8",
        worksheet_utilities.ref3 AS "detail_9",
        worksheet_utilities.ref4 AS "detail_10",
        worksheet_utilities.ref5 AS "detail_11",
        worksheet_utilities.ref6 AS "detail_12"
        FROM
        dbo.worksheet_utilities 
        LEFT JOIN barcode_service on barcode_service.no_service = worksheet_utilities.type
        LEFT JOIN barcode_location on barcode_location.no_location = worksheet_utilities.location
        LEFT JOIN barcode_sub_type4 on barcode_sub_type4.no_sub_type4 = worksheet_utilities.sub4
        LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type =  worksheet_utilities.[type]
        WHERE
        dbo.worksheet_utilities.worksheet_id = '$worksheet_id'
        AND 'status' <> 'Cancelled AND (no_charge <> 1 or no_charge is null)'
        
    END;

     
    $stmt = sqlsrv_query($conn, $iquery, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $row_count = sqlsrv_num_rows($stmt);

    $service_name = $service_type[$service_id];

    $pdf->AddPage();
    $i = -1;
    $set_x = 10;
    $set_y = 124;
    $x = 10;
    $y = 117;

    $set_cell_1 = array(
        [5, "No."],
        [25, "Service ID"],
        [25, "Type"],
        [20, "Location"],
        [30, "Sub-Location"],
        [25, "Description"],
        [30, "Started"],
        [30, "Finished"],
    );

    $set_cell_2 = array(
        [5, ""],
        [25, ""],
        [25, ""],
        [20, ""],
        [30, ""],
        [25, ""],
        [30, ""],
        [30, ""],
    );

    $pdf->Cell(0, 6, iconv('UTF-8', 'TIS-620', ' ' . $service_name), 0, 1, "L");

    $total_cells = count($set_cell_1);

    foreach ($set_cell_1 as $index => $cell) {

        $width = $cell[0];
        $text = $cell[1];

        if ($index === $total_cells - 1) {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "RT", 1, "C");
        } else if ($index === 0) {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "LT", 0, "C");
        } else {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "T", 0, "C");
        }
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

        $i++;

        if ($i % 3 == 0 && $i != 0) {
            //echo '<br>--- BREAK';
            $pdf->AddPage();
            $y = 107;
            $set_y = 114;
        }



        $col_data = [
            "col_1" => [($row["col_1"] == "" ? "-" : $row["col_1"])],
            "col_2" => [($row["col_2"] == "" ? "-" : $row["col_2"])],
            "col_3" => [($row["col_3"] == "" ? "-" : $row["col_3"])],
            "col_4" => [($row["col_4"] == "" ? "-" : $row["col_4"])],
            "col_5" => [($row["col_5"] == "" ? "-" : $row["col_5"])],
            "col_6" => [($row["col_6"] == "" ? "-" : $row["col_6"])],
            [($row["col_6-1"] == "" ? "-" : $row["col_6-1"])],
            "col_7" => [($row["col_7"] == "" ? "-" : $row["col_7"])],
            [($row["col_7-1"] == "" ? "-" : $row["col_7-1"])],
        ];

        $row_detail = [
            0 => ["Fixed Space:", ($row["detail_1"] == "" ? "-" : $row["detail_1"])],
            1 => ["Contract Number:", ($row["detail_2"] == "" ? "-" : $row["detail_2"])],
            2 => ["|", ($row["detail_3"] == "" ? "-" : $row["detail_3"])],
         
            6 => ["Remark 1:", ($row["detail_7"] == "" ? "-" : $row["detail_7"])],
            7 => ["Remark 2:", ($row["detail_8"] == "" ? "-" : $row["detail_8"])],
            8 => ["Remark 3:", ($row["detail_9"] == "" ? "-" : $row["detail_9"])],
            9 => ["Remark 4:", ($row["detail_10"] == "" ? "-" : $row["detail_10"])],
            10 => ["Remark 5:", ($row["detail_11"] == "" ? "-" : $row["detail_11"])],
            11 => ["Remark 6:", ($row["detail_12"] == "" ? "-" : $row["detail_12"])],
        ];

        $total_cells = count($set_cell_2);

        foreach ($set_cell_2 as $index => $cell) {

            $width = $cell[0];
            $text = $cell[1];

            $pdf->SetXY($x, $y);
            $pdf->MultiCell($width, 12, iconv('UTF-8', 'TIS-620', ($index == 0 ? $i + 1 : "")), ($index == 0 ? 1 : "TBR"), "C", false);

            if ($index != 0) {
                $pdf->SetXY($x, $y);
                $pdf->TextLength50CanPossibleOrNot(0, $width, "", $col_data["col_" . $index]);
            }

            $x = $x + $width;
        }

        $x = 10;
        $y = $y + 30;

        $pdf->SetXY($set_x, $set_y = $set_y + 5);
        $pdf->Cell(5, 18, iconv('UTF-8', 'TIS-620', ""), (($i + 1) % 3 == 0 || $i == 0 ? "LB" : "L"), 0, "C");
        $pdf->SetXY($set_x + 5, $set_y);
        $pdf->Cell(185, 18, iconv('UTF-8', 'TIS-620', ""), (($i + 1) % 3 == 0 || $i == 0 ? "LBR" : "LR"), 0, "C");

        $pdf->SetXY($set_x = $set_x + 5, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[0][0], $row_detail[0][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[1][0], $row_detail[1][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[2][0], $row_detail[2][1]);

        $pdf->SetXY($set_x = 15, $set_y = $set_y + 6);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[6][0], $row_detail[6][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[7][0], $row_detail[7][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[8][0], $row_detail[8][1]);
        $pdf->SetXY($set_x = 15, $set_y = $set_y + 6);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[9][0], $row_detail[9][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[10][0], $row_detail[10][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[11][0], $row_detail[11][1]);
        $set_x = 10;
        $set_y = $set_y + 13;


        if (($i + 1) == $row_count) {
            $pdf->Cell(190, 18, iconv('UTF-8', 'TIS-620', ""), "T", 0, "C");
        }


    }

*/




























///////////////////////////////// Booking - Hotel ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $service_id = 3;

$iquery = <<<END
        SELECT worksheet_hotel_booking.hotelbooking_id as "col_1",
	    hotel.hotel_name as "col_2",
	    worksheet_hotel_booking.occupant as "col_3",
	    barcode_service.type_service_name as "col_4",
	    worksheet_hotel_booking.meal_included as "col_5",
	    worksheet_hotel_booking.laundry_included as "col_6",
	    worksheet_hotel_booking.checkin_date as "col_7",
	    worksheet_hotel_booking.checkout_date as "col_8",
	    location.description AS "location",
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
	    AND 'status' <> 'Cancelled AND (no_charge <> 1 or no_charge is null)'
    END;

     
    $stmt = sqlsrv_query($conn, $iquery, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    $row_count = sqlsrv_num_rows($stmt);

    $service_name = $service_type[$service_id];

    $pdf->AddPage();
    $i = -1;
    $set_x = 10;
    $set_y = 124;
    $x = 10;
    $y = 117;

    $set_cell_1 = array(
        [5, "No."],
        [25, "Service ID"],
        [25, "Hotel Name"],
        [20, "Guest"],
        [30, "Room Type"],
        [20, "Meat Incl"],
        [20, "Laundry Incl"],
        [20, "Description"],
        [20, "Check-in"],
        [20, "Check-out"],
    );

    $set_cell_2 = array(
        [5, ""],
        [25, ""],
        [25, ""],
        [20, ""],
        [20, ""],
        [20, ""],
        [20, ""],
        [20, ""],
        [20, ""],
    );

    $pdf->Cell(0, 6, iconv('UTF-8', 'TIS-620', ' ' . $service_name), 0, 1, "L");

    $total_cells = count($set_cell_1);

    foreach ($set_cell_1 as $index => $cell) {

        $width = $cell[0];
        $text = $cell[1];

        if ($index === $total_cells - 1) {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "RT", 1, "C");
        } else if ($index === 0) {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "LT", 0, "C");
        } else {
            $pdf->Cell($width, 6, iconv('UTF-8', 'TIS-620', $text), "T", 0, "C");
        }
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

        $i++;

        if ($i % 3 == 0 && $i != 0) {
            $pdf->AddPage();
            $y = 107;
            $set_y = 114;
        }



        $col_data = [
            "col_1" => [($row["col_1"] == "" ? "-" : $row["col_1"])],
            "col_2" => [($row["col_2"] == "" ? "-" : $row["col_2"])],
            "col_3" => [($row["col_3"] == "" ? "-" : $row["col_3"])],
            "col_4" => [($row["col_4"] == "" ? "-" : $row["col_4"])],
            "col_5" => [($row["col_5"] == "" ? "-" : $row["col_5"])],
            "col_6" => [($row["col_6"] == "" ? "-" : $row["col_6"])],
            [($row["col_6-1"] == "" ? "-" : $row["col_6-1"])],
            "col_7" => [($row["col_7"] == "" ? "-" : $row["col_7"])],
            [($row["col_7-1"] == "" ? "-" : $row["col_7-1"])],
        ];

        $row_detail = [
            0 => ["Fixed Space:", ($row["detail_1"] == "" ? "-" : $row["detail_1"])],
            1 => ["Contract Number:", ($row["detail_2"] == "" ? "-" : $row["detail_2"])],
            2 => ["|", ($row["detail_3"] == "" ? "-" : $row["detail_3"])],
         
            6 => ["Remark 1:", ($row["detail_7"] == "" ? "-" : $row["detail_7"])],
            7 => ["Remark 2:", ($row["detail_8"] == "" ? "-" : $row["detail_8"])],
            8 => ["Remark 3:", ($row["detail_9"] == "" ? "-" : $row["detail_9"])],
            9 => ["Remark 4:", ($row["detail_10"] == "" ? "-" : $row["detail_10"])],
            10 => ["Remark 5:", ($row["detail_11"] == "" ? "-" : $row["detail_11"])],
            11 => ["Remark 6:", ($row["detail_12"] == "" ? "-" : $row["detail_12"])],
        ];

        $total_cells = count($set_cell_2);

        foreach ($set_cell_2 as $index => $cell) {

            $width = $cell[0];
            $text = $cell[1];

            $pdf->SetXY($x, $y);
            $pdf->MultiCell($width, 12, iconv('UTF-8', 'TIS-620', ($index == 0 ? $i + 1 : "")), ($index == 0 ? 1 : "TBR"), "C", false);

            if ($index != 0) {
                $pdf->SetXY($x, $y);
                $pdf->TextLength50CanPossibleOrNot(0, $width, "", $col_data["col_" . $index]);
            }

            $x = $x + $width;
        }

        $x = 10;
        $y = $y + 30;

        $pdf->SetXY($set_x, $set_y = $set_y + 5);
        $pdf->Cell(5, 18, iconv('UTF-8', 'TIS-620', ""), (($i + 1) % 3 == 0 || $i == 0 ? "LB" : "L"), 0, "C");
        $pdf->SetXY($set_x + 5, $set_y);
        $pdf->Cell(185, 18, iconv('UTF-8', 'TIS-620', ""), (($i + 1) % 3 == 0 || $i == 0 ? "LBR" : "LR"), 0, "C");

        $pdf->SetXY($set_x = $set_x + 5, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[0][0], $row_detail[0][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[1][0], $row_detail[1][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[2][0], $row_detail[2][1]);

        $pdf->SetXY($set_x = 15, $set_y = $set_y + 6);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[6][0], $row_detail[6][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[7][0], $row_detail[7][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[8][0], $row_detail[8][1]);
        $pdf->SetXY($set_x = 15, $set_y = $set_y + 6);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[9][0], $row_detail[9][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[10][0], $row_detail[10][1]);
        $pdf->SetXY($set_x = $set_x + 60, $set_y);
        $pdf->TextLength50CanPossibleOrNot(1, 60, $row_detail[11][0], $row_detail[11][1]);
        $set_x = 10;
        $set_y = $set_y + 13;


        if (($i + 1) == $row_count) {
            $pdf->Cell(190, 18, iconv('UTF-8', 'TIS-620', ""), "T", 0, "C");
        }


    }



        




















    }




$pdf->Output();

?>