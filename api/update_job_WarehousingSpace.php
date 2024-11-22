<?php
session_start();
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$reccode = $_GET['reccode'];

$WarehousingSpace_id = $_POST['WarehousingSpace_id'];
$start_date = null_val($_POST['WarehousingSpace_start_date']);
$start_time = null_val($_POST['WarehousingSpace_start_time']);
$end_date = null_val($_POST['WarehousingSpace_end_date']);
$end_time = null_val($_POST['WarehousingSpace_end_time']);
$quantity = null_decimal($_POST['WarehousingSpace_quantity']);
$uom = $_POST['WarehousingSpace_uom'];

$location = $_POST['locationWS'];
$branch = $_POST['branchWS'];


$description = $_POST['WarehousingSpaceDescript'];
$charge_as = $_POST['WarehousingSpaceChargeAs'];
$outsource_charge_as = $_POST['outWarehousingSpaceChargeAs'];
$contract = $_POST['WarehousingSpaceContractNumber'];

$remark = $_POST['WarehousingSpace_remark'];
$promotion = $_POST['WarehousingSpace_promotion'];
$contract_line = $_POST['WarehousingSpaceContractLineNumber'];
$department = $_POST['WarehousingSpace_department'];
$cost_center = $_POST['WarehousingSpace_cost_center'];
$outsource_vendor = $_POST['WarehousingSpace_group_name'];
$expende_date = null_val($_POST['WarehousingSpace_expense_sub_date']);
$line_status = $_POST['WarehousingSpace_line_status'];
$no_charge = isset($_POST['WarehousingSpace_no_charge']) ? $_POST['WarehousingSpace_no_charge'] : false;
$reimbursment = isset($_POST['WarehousingSpace_reimbursment']) ? $_POST['WarehousingSpace_reimbursment'] : false;
$lumpsum_charge = isset($_POST['WarehousingSpace_Lump_sum_charge']) ? $_POST['WarehousingSpace_Lump_sum_charge'] : false;
$outsource_bill_sub_date = null_val($_POST['WarehousingSpace_bill_submission_date']);
$iou_date = null_val($_POST['WarehousingSpace_IOU_date']);
$iou_num = $_POST['WarehousingSpace_IOU_number'];
$iou_amount = $_POST['WarehousingSpace_IOU_Amount'];

$cancel_reason = $_POST['WarehousingSpace_cancel_reason'];
$reason_outsource = $_POST['WarehousingSpace_outsource_reason'];
$cheque_remark = $_POST['WarehousingSpace_Cheque_Remark'];
$cheque_amount = null_val($_POST['WarehousingSpace_Cheque_Amount']);
$date_in_vendor_invoice = null_val($_POST['WarehousingSpace_vendor_invoice_date']);
$date_vendor_submit_date = null_val($_POST['WarehousingSpace_vendor_Submit_date']);
$vendor_invoice_no = $_POST['WarehousingSpace_VInvoice_No'];
$vendor_invoice_value = $_POST['WarehousingSpace_VInvoice_Value'];
$vendor_due_date = null_val($_POST['WarehousingSpace_vendor_Due_date']);
// diff zone
$type = $_POST['WarehousingSpace_type'];
$type1 = $_POST['WarehousingSpace_type1'];
$type2 = $_POST['WarehousingSpace_type2'];
$fixed_space = $_POST['WarehousingSpace_fixed_space'];
$ref1 = $_POST['WarehousingSpace_ref1'];
$ref2 = $_POST['WarehousingSpace_ref2'];
$ref3 = $_POST['WarehousingSpace_ref3'];
$ref4 = $_POST['WarehousingSpace_ref4'];
$ref5 = $_POST['WarehousingSpace_ref5'];
$ref6 = $_POST['WarehousingSpace_ref6'];

$modify_by = $_SESSION["user_name"];

if ($uom == 'EM/TP')
	$no_charge = 1;

// $iquery = "UPDATE job_warehousing_space_rental SET warehousing_space_rental_id='$WarehousingSpace_id', start_date='$start_date', start_time='$start_time', end_date='$end_date', end_time='$end_time', quantity=$quantity, uom='$uom', remark='$remark', cancel_reason='$cancel_reason', line_status='$line_status', type1='$type1', type2='$type2', type='$type', ref1='$ref1', ref2='$ref2', ref3='$ref3', ref4='$ref4', ref5='$ref5', ref6='$ref6',  description='$description', department='$department', cost_center='$cost_center', modify_date = getdate(), no_charge='$no_charge', reimbursment='$reimbursment', lumpsum_charge = '$lumpsum_charge', modify_by='$modify_by' WHERE reccode='$reccode'";

$iquery = "UPDATE job_warehousing_space_rental 
SET 
    warehousing_space_rental_id='$WarehousingSpace_id', 
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
    type1='$type1', 
    type2='$type2', 
    type='$type', 
    fixed_space='$fixed_space', 
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


    

}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>