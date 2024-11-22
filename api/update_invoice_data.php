<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = " select transport_id from worksheet_cargo_transport ";  
$result = sqlsrv_query($conn, $fQuery);
$x = 0;
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
	$x = $x+1;
	$invoice_date = '';
	$doc_no = '';
	$invoice_amount = 0;
	$submit_date = '';
	$rv_no = '';
	$rv_date = '';
	$transport_id = $row['transport_id'];
	$value = " where service_id = '$transport_id' order by reccode, doc_no desc ";
	$aaQuery = ' select * from invoice_data '.$value;
	$resultamount = sqlsrv_query($conn, $aaQuery);
	while($rowupdate = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
		if (($doc_no == '') or ($doc_no == $rowupdate['doc_no']))
			$doc_no = $rowupdate['doc_no'];
		else
			$doc_no = $doc_no .','.$rowupdate['doc_no'];
		//if (($invoice_amount == 0) or ($invoice_amount == $rowupdate['invoice_amount']))
		if ($invoice_amount == 0)
			$invoice_amount = $rowupdate['invoice_amount'];
		else 
			$invoice_amount = $invoice_amount+$rowupdate['invoice_amount'];
			//$rv_no = $rowupdate['rv_no'];
		if (($rv_no == '') or ($rv_no == $rowupdate['rv_no']))
			$rv_no = $rowupdate['rv_no'];
		else
			$rv_no = $rv_no .','.$rowupdate['rv_no'];

		if (is_null($rowupdate['posting_date'])) {
			$invoice_date = '';
		} else {
			$invoice_date = date_format($rowupdate['posting_date'],'d/m/Y');
		}
		if (is_null($rowupdate['submit_date'])) {
			$submit_date = '';
		} else {
			$submit_date = date_format($rowupdate['submit_date'],'d/m/Y');
		}
		if ($submit_date == '01/01/1753')
			$submit_date = '';
		if (is_null($rowupdate['rv_date'])) {
			$rv_date = '';
		} else {
			$rv_date = date_format($rowupdate['rv_date'],'d/m/Y'); 
		}
		if ($rv_date == '01/01/1753')
			$rv_date = '';
	}
		

}

$Data["Status"] = "Success";
$Data["msg"] = "Data has been updated";

echo json_encode($Data);

sqlsrv_close($conn);

?>