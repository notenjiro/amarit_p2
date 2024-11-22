<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$hotel_booking_id = $_POST['Hotel_id'];
$start_date = null_val($_POST['Hotel_start_date']);
$start_time = null_val($_POST['Hotel_start_time']);
$end_date = null_val($_POST['Hotel_end_date']);
$end_time = null_val($_POST['Hotel_end_time']);
$quantity = null_decimal($_POST['Hotel_quantity']);
$uom = $_POST['Hotel_uom'];

$location = $_POST['Hotel_location'];
$branch = $_POST['Hotel_branch'];


$description = $_POST['Hotel_Descript'];
$charge_as = $_POST['Hotel_ChargeAs'];
$outsource_charge_as = $_POST['out_Hotel_ChargeAs'];
$contract = $_POST['Hotel_CNumber'];

$remark = $_POST['Hotel_remark'];
$promotion = $_POST['Hotel_promotion'];
$contract_line = $_POST['Hotel_CLNumber'];
$department = $_POST['Hotel_department'];
$cost_center = $_POST['Hotel_cost_center'];
$outsource_vendor = $_POST['Hotel_group_name'];
$expende_date = null_val($_POST['Hotel_expense_sub_date']);
$line_status = $_POST['Hotel_line_status'];
$no_charge = isset($_POST['Hotel_no_charge']) ? $_POST['Hotel_no_charge'] : false;
$reimbursment = isset($_POST['Hotel_reimbursment']) ? $_POST['Hotel_reimbursment'] : false;
$lumpsum_charge = isset($_POST['Hotel_Lump_sum_charge']) ? $_POST['Hotel_Lump_sum_charge'] : false;
$outsource_bill_sub_date = null_val($_POST['Hotel_bill_submission_date']);
$iou_date = null_val($_POST['Hotel_IOU_date']);
$iou_num = $_POST['Hotel_IOU_number'];
$iou_amount = $_POST['Hotel_IOU_Amount'];

$cancel_reason = $_POST['Hotel_cancel_reason'];
$reason_outsource = $_POST['Hotel_outsource_reason'];
$cheque_remark = $_POST['Hotel_Cheque_Remark'];
$cheque_amount = $_POST['Hotel_Cheque_Amount'];
$date_in_vendor_invoice = null_val($_POST['Hotel_vendor_invoice_date']);
$date_vendor_submit_date = null_val($_POST['Hotel_vendor_Submit_date']);
$vendor_invoice_no = $_POST['Hotel_VInvoice_No'];
$vendor_invoice_value = $_POST['Hotel_VInvoice_Value'];
$vendor_due_date = null_val($_POST['Hotel_vendor_Due_date']);
// diff zone
$hotel_name = $_POST['Hotel_name'];
$P_O = $_POST['Hotel_P_O'];
$Des2 = $_POST['Hotel_Des2'];
$type = $_POST['Hotel_typeC'];
$meal = isset($_POST['Hotel_Meal_included']) ? $_POST['Hotel_Meal_included'] : false;
$laundry = isset($_POST['Hotel_Laundry_included']) ? $_POST['Hotel_Laundry_included'] : false;


$ref1 = $_POST['Hotel_ref1'];
$ref2 = $_POST['Hotel_ref2'];
$ref3 = $_POST['Hotel_ref3'];
$ref4 = $_POST['Hotel_ref4'];
$ref5 = $_POST['Hotel_ref5'];
$ref6 = $_POST['Hotel_ref6'];

$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

$iquery = "UPDATE job_hotel_booking 
SET 
hotel_booking_id='$hotel_booking_id', 
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
    hotel_name='$hotel_name',  
    passenger_occupation='$P_O',
    description2='$Des2', 
    room_type='$type',
    meal_include='$meal',
    laundry_include='$laundry',
    ref1='$ref1', 
    ref2='$ref2', 
    ref3='$ref3', 
    ref4='$ref4', 
    ref5='$ref5', 
    ref6='$ref6', 
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