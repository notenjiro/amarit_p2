<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$ticket_booking_id = $_POST['Ticket_id'];
$start_date = null_val($_POST['Ticket_start_date']);
$start_time = null_val($_POST['Ticket_start_time']);
$end_date = null_val($_POST['Ticket_end_date']);
$end_time = null_val($_POST['Ticket_end_time']);
$quantity = null_decimal($_POST['Ticket_quantity']);
$uom = $_POST['Ticket_uom'];

$location = $_POST['Ticket_location'];
$branch = $_POST['Ticket_branch'];


$description = $_POST['Ticket_Descript'];
$charge_as = $_POST['Ticket_ChargeAs'];
$outsource_charge_as = $_POST['out_Ticket_ChargeAs'];
$contract = $_POST['Ticket_CNumber'];

$remark = $_POST['Ticket_remark'];
$promotion = $_POST['Ticket_promotion'];
$contract_line = $_POST['Ticket_CLNumber'];
$department = $_POST['Ticket_department'];
$cost_center = $_POST['Ticket_cost_center'];
$outsource_vendor = $_POST['Ticket_group_name'];
$expende_date = null_val($_POST['Ticket_expense_sub_date']);
$line_status = $_POST['Ticket_line_status'];
$no_charge = isset($_POST['Ticket_no_charge']) ? $_POST['Ticket_no_charge'] : false;
$reimbursment = isset($_POST['Ticket_reimbursment']) ? $_POST['Ticket_reimbursment'] : false;
$lumpsum_charge = isset($_POST['Ticket_Lump_sum_charge']) ? $_POST['Ticket_Lump_sum_charge'] : false;
$outsource_bill_sub_date = null_val($_POST['Ticket_bill_submission_date']);
$iou_date = null_val($_POST['Ticket_IOU_date']);
$iou_num = $_POST['Ticket_IOU_number'];
$iou_amount = $_POST['Ticket_IOU_Amount'];

$cancel_reason = $_POST['Ticket_cancel_reason'];
$reason_outsource = $_POST['Ticket_outsource_reason'];
$cheque_remark = $_POST['Ticket_Cheque_Remark'];
$cheque_amount = $_POST['Ticket_Cheque_Amount'];
$date_in_vendor_invoice = null_val($_POST['Ticket_vendor_invoice_date']);
$date_vendor_submit_date = null_val($_POST['Ticket_vendor_Submit_date']);
$vendor_invoice_no = $_POST['Ticket_VInvoice_No'];
$vendor_invoice_value = $_POST['Ticket_VInvoice_Value'];
$vendor_due_date = null_val($_POST['Ticket_vendor_Due_date']);
// diff zone
$ticket_type = $_POST['Ticket_typeC'];
$type1 = $_POST['Ticket_SType1'];
$type2 = $_POST['Ticket_SType2'];
$P_O = $_POST['Ticket_P_O'];
$airline_name = $_POST['Ticket_Aname'];
$luggage = isset($_POST['Ticket_Luggage']) ? $_POST['Ticket_Luggage'] : false;
$des2 = $_POST['Ticket_Des2'];
$dep = $_POST['Ticket_Dep'];
$FDes = $_POST['Ticket_FDes'];

$ref1 = $_POST['Ticket_ref1'];
$ref2 = $_POST['Ticket_ref2'];
$ref3 = $_POST['Ticket_ref3'];
$ref4 = $_POST['Ticket_ref4'];
$ref5 = $_POST['Ticket_ref5'];
$ref6 = $_POST['Ticket_ref6'];

$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

$iquery = "UPDATE job_ticket_booking 
SET 
ticket_booking_id='$ticket_booking_id', 
    location = '$location',
    branch = '$branch',
    start_date=$start_date, 
    start_time=$start_time, 
    end_date=$end_date, 
    end_time=$end_time, 
    quantity=$quantity, 
    uom='$uom', 
    description='$description', 
    charge_as='$charge_as', 
    outsource_charge_as='$outsource_charge_as', 
    contract='$contract', 
    remark='$remark', 
    promotion_code='$promotion', 
    contract_line='$contract_line', 
    department='$department', 
    cost_center='$cost_center', 
    outsource='$outsource_vendor', 
    expense_sub_date=$expende_date, 
    outsource_billing_sub_date=$outsource_bill_sub_date, 
    iou_date=$iou_date, 
    iou_number='$iou_num', 
    iou_amount='$iou_amount', 
    cheque_remark='$cheque_remark', 
    cheque_amount='$cheque_amount', 
    date_in_vendor_invoice_doc=$date_in_vendor_invoice, 
    date_vendor_submit_invoice_to_amarit=$date_vendor_submit_date, 
    vendor_invoice_number='$vendor_invoice_no', 
    vendor_invoice_value='$vendor_invoice_value', 
    vendor_invoice_due_date=$vendor_due_date, 
    no_charge='$no_charge', 
    reimbursment='$reimbursment', 
    lumpsum_charge = '$lumpsum_charge', 
    cancel_reason='$cancel_reason', 
    outsource_reason='$reason_outsource', 
    line_status='$line_status', 
    
    ref1='$ref1', 
    ref2='$ref2', 
    ref3='$ref3', 
    ref4='$ref4', 
    ref5='$ref5', 
    ref6='$ref6', 
    ticket_type='$ticket_type',
    type1='$type1',
    type2='$type2',
    passenger_occupant='$P_O',
    airline_name='$airline_name',
    with_luggage='$luggage',
    description2='$des2',
    departure_location='$dep',
    final_destinnaton='$FDes',
    modify_date = getdate(), 
    modify_by='$modify_by' 
WHERE reccode='$reccode'";

$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
    $Data['sql'] = $iquery;

    $errors = sqlsrv_errors(SQLSRV_ERR_ERRORS);
    
    // Construct a string to represent the error information
    $errorInfo = "";
    foreach ($errors as $error) {
        $errorInfo .= "SQLSTATE: " . $error['SQLSTATE'] . "\n";
        $errorInfo .= "Code: " . $error['code'] . "\n";
        $errorInfo .= "Message: " . $error['message'] . "\n";
        $errorInfo .= "------------------------\n";
    }

    // Specify the file path where you want to save the error information
    $filePath = "aerror_log.txt";

    // Write the error information to the file
    file_put_contents($filePath, $errorInfo);


    

}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
    $filePath = "aqery_log.txt";

    // Write the error information to the file
    file_put_contents($filePath, $iquery);
}

echo json_encode($Data);

sqlsrv_close($conn);

?>