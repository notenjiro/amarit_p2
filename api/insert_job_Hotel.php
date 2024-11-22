<?php
// error_reporting(0);
error_reporting(E_ALL);
require_once '../config_db.php';
require_once '../utils/helper.php';

$job_id = $_GET['job_id'];


$customer = $_GET['customer'];

$hotel_booking_id = $_POST['Hotel_id'];
$branch = $_POST['Hotel_branch'];
$location = $_POST['Hotel_location'];
$line_status = $_POST['Hotel_line_status'];

$start_date = null_val($_POST['Hotel_start_date']);
$start_time = null_val($_POST['Hotel_start_time']);
$end_date = null_val($_POST['Hotel_end_date']);
$end_time = null_val($_POST['Hotel_end_time']);
$quantity = null_decimal($_POST['Hotel_quantity']);
$uom = $_POST['Hotel_uom'];

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
$no_charge = isset($_POST['Hotel_no_charge']) ? $_POST['Hotel_no_charge'] : false;
$reimbursment = isset($_POST['Hotel_reimbursment']) ? $_POST['Hotel_reimbursment'] : false;
$lumpsum_charge = isset($_POST['Hotel_Lump_sum_charge']) ? $_POST['Hotel_Lump_sum_charge'] : false;


$outsource_bill_sub_date = null_val($_POST['Hotel_bill_submission_date']);
$cancel_reason = $_POST['Hotel_cancel_reason'];
$reason_outsource = $_POST['Hotel_outsource_reason'];

$iou_date = null_val($_POST['Hotel_IOU_date']);
$iou_num = $_POST['Hotel_IOU_number'];
$iou_amount = $_POST['Hotel_IOU_Amount'];



$cheque_remark = $_POST['Hotel_Cheque_Remark'];
$cheque_amount = null_val($_POST['Hotel_Cheque_Amount']);


$date_in_vendor_invoice = null_val($_POST['Hotel_vendor_invoice_date']);
$date_vendor_submit_date = null_val($_POST['Hotel_vendor_Submit_date']);
$vendor_invoice_no = $_POST['Hotel_VInvoice_No'];
$vendor_invoice_value = $_POST['Hotel_VInvoice_Value'];
$vendor_due_date = null_val($_POST['Hotel_vendor_Due_date']);


// diff zone
$hotel_name = $_POST['Hotel_name'];
$P_O = $_POST['Hotel_P_O'];
$des2 = $_POST['Hotel_Des2'];
$type = $_POST['Hotel_typeC'];
$meal = isset($_POST['Hotel_Meal_included']) ? $_POST['Hotel_Meal_included'] : false;
$laundry = isset($_POST['Hotel_Laundry_included']) ? $_POST['Hotel_Laundry_included'] : false;




// $immigration_number = $_POST['immigration_number'];

// $expat_name = $_POST['immigration_expat_name'];
// $amount = 0;//null_decimal($_POST['immigration_amount']);
// $agreement_number = $_POST['immigration_agreement_number'];

$ref1 = $_POST['Hotel_ref1'];
$ref2 = $_POST['Hotel_ref2'];
$ref3 = $_POST['Hotel_ref3'];
$ref4 = $_POST['Hotel_ref4'];
$ref5 = $_POST['Hotel_ref5'];
$ref6 = $_POST['Hotel_ref6'];

if ($customer == 'CL0423' or $uom == 'EM/TP')
    $no_charge = 1;

    
// $_date = $_POST['WarehousingSpace_start_date'];//date('Y-m-d');
// $y = date('Y', strtotime($_date)) - 2000;
// $num = "IM".$y;

// //$date_start = '2023-01-01';//date('Y-m-01', strtotime($_date));
// //$date_end = '2023-12-31';//date('Y-m-t', strtotime($_date));
// $date_start = date('Y-01-01', strtotime($_date));
// $date_end = date('Y-12-31', strtotime($_date));

// $fQuery = "SELECT count(1) as num FROM worksheet_immigration where start_date between '$date_start' and '$date_end'";

// $result = sqlsrv_query($conn, $fQuery);
// $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
// $count_num = $row['num'] +1;

// if($count_num  < 10)
//     $count = "0000".$count_num;
// else if($count_num  < 100)
//     $count = "000".$count_num;
// else if($count_num  < 1000)
//     $count = "00".$count_num ;
// else if($count_num  < 10000)
//     $count = "0".$count_num ;
// else
//     $count = $count_num ;
// $immigration_id = $num.$count;

//start
$maxIdQuery = "SELECT MAX(hotel_booking_id) AS max_id FROM job_hotel_booking";
$maxIdStmt = sqlsrv_query($conn, $maxIdQuery);
if ($maxIdStmt === false) {
    die("Error in fetching maximum job_id: " . print_r(sqlsrv_errors(), true));
}
$maxIdRow = sqlsrv_fetch_array($maxIdStmt, SQLSRV_FETCH_ASSOC);
$maxId = $maxIdRow['max_id'];

$filePath = "axQuery.txt";

    // Write the query to the file
    file_put_contents($filePath, "x");
//$num = "SO".$y;
$currentYearSuffix = date('y');
$nextNumber = intval(substr($maxId, 4)) + 1;
$hotel_booking_id = 'HT' . $currentYearSuffix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
//endhere

$iquery = "INSERT INTO job_hotel_booking (job_id, customer, hotel_booking_id, branch, location, line_status, start_date, start_time, end_date, end_time, quantity, uom, description, charge_as, outsource_charge_as, contract, remark, promotion_code, contract_line, department, cost_center, outsource, expense_sub_date, no_charge, reimbursment, lumpsum_charge, outsource_billing_sub_date, cancel_reason, outsource_reason, iou_date, iou_number, iou_amount, cheque_remark, cheque_amount, date_in_vendor_invoice_doc, date_vendor_submit_invoice_to_amarit, vendor_invoice_number, vendor_invoice_value, vendor_invoice_due_date, ref1, ref2, ref3, ref4, ref5, ref6, hotel_name, passenger_occupation, description2, room_type, meal_include, laundry_include) 
VALUES ('$job_id', '$customer', '$hotel_booking_id', '$branch', '$location', '$line_status', $start_date, $start_time, $end_date, $end_time, $quantity, '$uom', '$description', '$charge_as', '$outsource_charge_as', '$contract', '$remark', '$promotion', '$contract_line', '$department', '$cost_center', '$outsource_vendor', $expende_date, '$no_charge', '$reimbursment', '$lumpsum_charge', $outsource_bill_sub_date, '$cancel_reason', '$reason_outsource', $iou_date, '$iou_num', '$iou_amount', '$cheque_remark', $cheque_amount, $date_in_vendor_invoice, $date_vendor_submit_date, '$vendor_invoice_no', '$vendor_invoice_value', $vendor_due_date, '$ref1', '$ref2', '$ref3', '$ref4', '$ref5', '$ref6','$hotel_name' , '$P_O' , '$des2' , '$type' , '$meal' , '$laundry')
";
$stmt = sqlsrv_query($conn, $iquery);

    // write message to the log file
    $filePath = "aQuery.txt";

    // Write the query to the file
    file_put_contents($filePath, $iquery);

if ($stmt === false) {
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
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
} else {
    $Data["Status"] = "Success";
    $Data["msg"] = "Data job has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>