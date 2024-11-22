<?php 
    define('FPDF_FONTPATH','font/');
    require('fpdf182/fpdf.php');
    require_once './utils/helper.php';
    $total_debit = 0;
    $total_credit = 0;

    require_once 'config.php';
    $serverName = serverName;
    $Database = Database;
    $UID = UID;
    $PWD = PWD;
    $connectionInfo = array( "Database"=>$Database, "UID"=>$UID, "PWD"=>$PWD, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');
    $conn = sqlsrv_connect( $serverName, $connectionInfo);

    if( $conn ) {
        $id = $_GET['id'];
        $header = $_GET['header'];
        $iquery = "SELECT * FROM journal_header WHERE document_number =?";
        $params = array($id);
        $stmt = sqlsrv_query($conn, $iquery, $params);
        while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
            $pdf=new FPDF();
			$pdf->SetMargins(30, 10, 10, true);
            $pdf->AddPage();
            $pdf->AddFont('angsa','','angsa.php');
            $pdf->SetFont('angsa','',16);
			if ($row['document_type'] == '01'){
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','ใบปรับปรุงบัญชี'),0,0,"C");
			} else if ($row['document_type'] == '02'){
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','ใบสำคัญรับ'),0,0,"C");
			} else {
				$pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','ใบสำคัญจ่าย'),0,0,"C");
			}
			$description = $row['description'];
            $pdf->Cell(0,8,iconv( 'UTF-8','TIS-620',$header.'                                                      เลขที่  '.$row['ref_no'].'     '),0,1,"R");
            $pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','การฌาปนกิจสงเคราะห์ ปภ.'),0,1,"C");
            $pdf->Cell(0,8,iconv( 'UTF-8','TIS-620','ณ วันที่  '.date_utc_to_thai($row['document_date'])),0,1,"C");

            $pdf->Cell(90,8,iconv( 'UTF-8','TIS-620','รายการ'),'LTR',0,"C");
            $pdf->Cell(80,8,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,1,"C");
            $pdf->Cell(90,8,iconv( 'UTF-8','TIS-620',''),'LBR',0,"C");
            $pdf->Cell(40,8,iconv( 'UTF-8','TIS-620','เดบิต'),1,0,"C");
            $pdf->Cell(40,8,iconv( 'UTF-8','TIS-620','เครดิต'),1,1,"C");

            $iquery = "SELECT account_name,debit,credit FROM journal_line LEFT OUTER JOIN chart_of_account on journal_line.account_code = chart_of_account.account_code WHERE document_number =? order by journal_line.id";
            $stmt = sqlsrv_query($conn, $iquery, $params);
            $x = 1;
            while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
                //$pdf->Cell(90,8,iconv( 'UTF-8','TIS-620',$row['account_name']),1,0,"L");
                if ($row['debit'] == 0){
                    $debit = "";
                } else {
                    $debit = $row['debit'];
					$pdf->Cell(90,8,iconv( 'UTF-8','TIS-620',$row['account_name']),1,0,"L");
                }
                if ($row['credit'] == 0){
                    $credit = "";
                } else {
                    $credit = $row['credit'];
					$pdf->Cell(90,8,iconv( 'UTF-8','TIS-620','          '.$row['account_name']),1,0,"L");
                }
                $pdf->Cell(40,8,number_format($debit, 2 ,'.',','),1,0,"R");
                $pdf->Cell(40,8,number_format($credit, 2 ,'.',','),1,1,"R");
                $x = $x+1;
                $total_debit = $total_debit+$row['debit'];
                $total_credit = $total_credit+$row['credit'];
            }
			$pdf->Cell(90,8,iconv( 'UTF-8','TIS-620',$description),1,0,"L");
            $pdf->Cell(40,8,'',1,0,"R");
            $pdf->Cell(40,8,'',1,1,"R");
            while($x < 11){
                $pdf->Cell(90,8,'',1,0,"L");
                $pdf->Cell(40,8,'',1,0,"R");
                $pdf->Cell(40,8,'',1,1,"R");
                $x = $x+1;
            }
            $pdf->Cell(90,8,iconv( 'UTF-8','TIS-620','รวม'),1,0,"C");
            $pdf->Cell(40,8,iconv( 'UTF-8','TIS-620',number_format($total_debit, 2, '.', ',')),1,0,"R");
            $pdf->Cell(40,8,iconv( 'UTF-8','TIS-620',number_format($total_credit, 2, '.', ',')),1,1,"R");
            $pdf->Cell(85,30,iconv( 'UTF-8','TIS-620','ผู้บันทึกบัญชี...............................................................'),0,0,"L");
            $pdf->Cell(85,30,iconv( 'UTF-8','TIS-620','ผู้ตรวจ.....................................................................'),0,0,"R");
            //$pdf->Cell(65,20,iconv( 'UTF-8','TIS-620','ผู้อนุมัติ...........................................'),0,1,"R");
            ob_end_clean(); 
            $pdf->Output();     
        }        
    }
?>