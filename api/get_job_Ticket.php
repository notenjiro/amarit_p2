<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$fQuery = "SELECT * FROM job_ticket_booking WHERE reccode = '$reccode'";

$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

$raw = array();

// Populate the $raw array with values from the job_warehousing_space_rental table
$raw['job_id'] = $row['job_id'];
$raw['customer'] = $row['customer'];
$raw['reccode'] = $row['reccode'];
$raw['Ticket_id'] = $row['ticket_booking_id'];
$raw['branch'] = $row['branch'];
$raw['location'] = $row['location'];
$raw['line_status'] = $row['line_status'];
$raw['start_date'] = is_null($row['start_date']) ? "" : date_format($row['start_date'],'Y-m-d');
$raw['start_time'] = is_null($row['start_time']) ? "" : date_format($row['start_time'],'H:i');
$raw['end_date'] = is_null($row['end_date']) ? "" : date_format($row['end_date'],'Y-m-d');
$raw['end_time'] = is_null($row['end_time']) ? "" : date_format($row['end_time'],'H:i');
$raw['quantity'] = $row['quantity'];
$raw['uom'] = $row['uom'];
$raw['description'] = $row['description'];
$raw['charge_as'] = $row['charge_as'];
$raw['outsource_charge_as'] = $row['outsource_charge_as'];
$raw['contract'] = $row['contract'];
$raw['remark'] = $row['remark'];
$raw['promotion'] = $row['promotion_code'];
$raw['contract_line'] = $row['contract_line'];
$raw['department'] = $row['department'];
$raw['cost_center'] = $row['cost_center'];
$raw['outsource'] = $row['outsource'];
$raw['expense_sub_date'] = is_null($row['expense_sub_date']) ? "" : date_format($row['expense_sub_date'],'Y-m-d');
$raw['no_charge'] = $row['no_charge'];
$raw['reimbursment'] = $row['reimbursment'];
$raw['lump_sum'] = $row['lumpsum_charge'];
$raw['outsource_billing_sub_date'] = is_null($row['outsource_billing_sub_date']) ? "" : date_format($row['outsource_billing_sub_date'],'Y-m-d');
$raw['cancel_reason'] = $row['cancel_reason'];
$raw['outsource_reason'] = $row['outsource_reason'];
$raw['iou_date'] = is_null($row['iou_date']) ? "" : date_format($row['iou_date'],'Y-m-d');
$raw['iou_number'] = $row['iou_number'];
$raw['iou_amount'] = $row['iou_amount'];
$raw['cheque_remark'] = $row['cheque_remark'];
$raw['cheque_amount'] = $row['cheque_amount'];
$raw['date_in_vendor_invoice_doc'] = is_null($row['date_in_vendor_invoice_doc']) ? "" : date_format($row['date_in_vendor_invoice_doc'],'Y-m-d');
$raw['date_vendor_submit_invoice_to_amarit'] = is_null($row['date_vendor_submit_invoice_to_amarit']) ? "" : date_format($row['date_vendor_submit_invoice_to_amarit'],'Y-m-d');
$raw['vendor_invoice_number'] = $row['vendor_invoice_number'];
$raw['vendor_invoice_value'] = $row['vendor_invoice_value'];
$raw['vendor_invoice_due_date'] = is_null($row['vendor_invoice_due_date']) ? "" : date_format($row['vendor_invoice_due_date'],'Y-m-d');
$raw['ref1'] = $row['ref1'];
$raw['ref2'] = $row['ref2'];
$raw['ref3'] = $row['ref3'];
$raw['ref4'] = $row['ref4'];
$raw['ref5'] = $row['ref5'];
$raw['ref6'] = $row['ref6'];




$raw['Ticket_typeC'] = $row['ticket_type'];
$raw['Ticket_SType1'] = $row['type1'];
$raw['Ticket_SType2'] = $row['type2'];
$raw['Ticket_P_O'] = $row['passenger_occupation'];
$raw['Ticket_Aname'] = $row['airline_name'];
$raw['Ticket_Luggage'] = $row['with_luggage'];
$raw['Ticket_Des2'] = $row['description2'];
$raw['Ticket_Dep'] = $row['departure_location'];
$raw['Ticket_FDes'] = $row['final_destinnaton'];


    // Write the error information to the file

echo json_encode($raw);
sqlsrv_close($conn);
?>