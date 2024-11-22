<?php 
	require_once 'config_db.php';
	require_once 'utils/helper.php';
	
	if( $conn ) {	
		$from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
		$fQuery = "select transport_id from worksheet_cargo_transport WHERE start_date >= '$from_date' AND start_date <= '$to_date' ";   
		$result = sqlsrv_query($conn, $fQuery);
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
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
			}
			$exquery = "update worksheet_cargo_transport set doc_no = '$doc_no', invoice_amount = $invoice_amount, rv_no = '$rv_no' where transport_id = '$transport_id' ";
			$stmt = sqlsrv_query($conn, $exquery);
		}
		$fQuery = " select cargo_service_id as transport_id from worksheet_cargo_handling WHERE start_date >= '$from_date' AND start_date <= '$to_date'";   
		$result = sqlsrv_query($conn, $fQuery);
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
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
			}
			$exquery = "update worksheet_cargo_handling set doc_no = '$doc_no', invoice_amount = $invoice_amount, rv_no = '$rv_no' where cargo_service_id = '$transport_id' ";
			$stmt = sqlsrv_query($conn, $exquery);
		}
		$fQuery = "select labor_service_id as transport_id from worksheet_manpower WHERE start_date >= '$from_date' AND start_date <= '$to_date'";   
		$result = sqlsrv_query($conn, $fQuery);
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
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
			}
			$exquery = "update worksheet_manpower set doc_no = '$doc_no', invoice_amount = $invoice_amount, rv_no = '$rv_no' where labor_service_id = '$transport_id' ";
			$stmt = sqlsrv_query($conn, $exquery);
		}
		$fQuery = "select taxi_service_id as transport_id from worksheet_taxi WHERE start_date >= '$from_date' AND start_date <= '$to_date'";   
		$result = sqlsrv_query($conn, $fQuery);
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
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
			}
			$exquery = "update worksheet_taxi set doc_no = '$doc_no', invoice_amount = $invoice_amount, rv_no = '$rv_no' where taxi_service_id = '$transport_id' ";
			$stmt = sqlsrv_query($conn, $exquery);
		}
		$fQuery = "select immigration_id as transport_id from worksheet_immigration WHERE start_date >= '$from_date' AND start_date <= '$to_date'";   
		$result = sqlsrv_query($conn, $fQuery);
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
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
			}
			$exquery = "update worksheet_immigration set doc_no = '$doc_no', invoice_amount = $invoice_amount, rv_no = '$rv_no' where immigration_id = '$transport_id' ";
			$stmt = sqlsrv_query($conn, $exquery);
		}
		$fQuery = "select cargo_service_id as transport_id from worksheet_service WHERE start_date >= '$from_date' AND start_date <= '$to_date'";   
		$result = sqlsrv_query($conn, $fQuery);
		while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
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
			}
			$exquery = "update worksheet_service set doc_no = '$doc_no', invoice_amount = $invoice_amount, rv_no = '$rv_no' where cargo_service_id = '$transport_id' ";
			$stmt = sqlsrv_query($conn, $exquery);
		}
	//$exquery = "update worksheet_cargo_transport set worksheet_cargo_transport.posting_date = b.posting_date,worksheet_cargo_transport.submit_date = b.submit_date, worksheet_cargo_transport.rv_date = b.rv_date from worksheet_cargo_transport a right join invoice_data b on a.transport_id = b.service_id WHERE start_date >= '$from_date' AND start_date <= '$to_date' ";
	//$stmt = sqlsrv_query($conn, $exquery);
	//$exquery = "update worksheet_cargo_handling set worksheet_cargo_handling.posting_date = b.posting_date,worksheet_cargo_handling.submit_date = b.submit_date, worksheet_cargo_handling.rv_date = b.rv_date from worksheet_cargo_handling a right join invoice_data b on a.cargo_service_id = b.service_id WHERE start_date >= '$from_date' AND start_date <= '$to_date' ";
	//$stmt = sqlsrv_query($conn, $exquery);
	//$exquery = "update worksheet_manpower set worksheet_manpower.posting_date = b.posting_date, 	worksheet_manpower.submit_date = b.submit_date, worksheet_manpower.rv_date = b.rv_date 	from worksheet_manpower a right join invoice_data b on a.labor_service_id = b.service_id WHERE start_date >= '$from_date' AND start_date <= '$to_date' ";
	//$stmt = sqlsrv_query($conn, $exquery);
	//$exquery = "update worksheet_taxi set worksheet_taxi.posting_date = b.posting_date, 	worksheet_taxi.submit_date = b.submit_date, worksheet_taxi.rv_date = b.rv_date 	from worksheet_taxi a right join invoice_data b on a.taxi_service_id = b.service_id WHERE start_date >= '$from_date' AND start_date <= '$to_date' ";
	//$stmt = sqlsrv_query($conn, $exquery);
	////echo('Update already');
	
}
echo json_encode('Update already');
sqlsrv_close($conn);
?>