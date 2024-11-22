<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];
$type = $_GET['type'];

if($type){
   if ($type == 'Admin'){
        $worksheetQuery = "SELECT * FROM worksheet WHERE worksheet_id = '$worksheet_id'";
        $worksheetResult = sqlsrv_query($conn, $worksheetQuery);
        if ($row = sqlsrv_fetch_array($worksheetResult, SQLSRV_FETCH_ASSOC)) {

        } else {
            // The ID does not exist in the worksheet table, check the job table
            $jobQuery = "SELECT * FROM job WHERE job_id = '$worksheet_id'";
            $jobResult = sqlsrv_query($conn, $jobQuery);
            $row = sqlsrv_fetch_array( $jobResult, SQLSRV_FETCH_ASSOC);
        }
    }elseif ($type == 'AAL'){

        $fQuery = "SELECT * FROM worksheet WHERE worksheet_id = '$worksheet_id'";
        $result = sqlsrv_query($conn, $fQuery);
        $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

    }elseif ($type == 'AA'){
        $fQuery = "SELECT * FROM job WHERE job_id = '$worksheet_id'";
        $result = sqlsrv_query($conn, $fQuery);
        $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
    }
            
        if ($type == 'Admin'){
            if ($row['worksheet_id'] == null){
                $raw['worksheet_id'] = $row['job_id'];
            }else{
                $raw['worksheet_id'] = $row['worksheet_id'];
            }
        }elseif ($type == 'AAL'){

            $raw['worksheet_id'] = $row['worksheet_id'];
        }elseif ($type == 'AA'){
            $raw['worksheet_id'] = $row['job_id'];
        }
        $raw['branch'] = $row['branch'];


            if ($type == 'Admin'){

                if ($row['worksheet_date'] == null){
                    $raw['worksheet_date'] = date_format($row['job_date'],'Y-m-d');
                }else{
                    $raw['worksheet_date'] = date_format($row['worksheet_date'],'Y-m-d');
                }
            }elseif ($type == 'AAL'){
            
                $raw['worksheet_date'] = date_format($row['worksheet_date'],'Y-m-d');
            }elseif ($type == 'AA'){
                $raw['worksheet_date'] = date_format($row['job_date'],'Y-m-d');
            }


        $raw['subject'] = $row['subject'];
        $raw['customer'] = $row['customer'];
        $raw['customer_ref'] = $row['customer_ref'];
        $raw['contact'] = $row['contract'];
        if ($type == 'Admin'){

            if ($row['worksheet_status'] == null){
                $raw['worksheet_status'] = $row['job_status'];
            }else{
                $raw['worksheet_status'] = $row['worksheet_status'];
            }
        }elseif ($type == 'AAL'){

            $raw['worksheet_status'] = $row['worksheet_status'];
        }elseif ($type == 'AA'){
            $raw['worksheet_status'] = $row['job_status'];
        }

        $raw['send_date'] = is_null($row['send_date'])?"":date_format($row['send_date'],'Y-m-d');
        $raw['send_time'] = is_null($row['send_time'])?"":date_format($row['send_time'],'H:i');
        $raw['rcvd_date'] = is_null($row['rcvd_date'])?"":date_format($row['rcvd_date'],'Y-m-d');
        $raw['rcvd_time'] = is_null($row['rcvd_time'])?"":date_format($row['rcvd_time'],'H:i');
        $raw['close_date'] = is_null($row['close_date'])?"":date_format($row['close_date'],'Y-m-d');
        $raw['close_time'] = is_null($row['close_time'])?"":date_format($row['close_time'],'H:i');
        $raw['cancel_reason'] = $row['cancel_reason'];
        $raw['remark'] = $row['remark'];
        $raw['ref1'] = $row['ref1'];
        $raw['ref2'] = $row['ref2'];
        $raw['ref3'] = $row['ref3'];
        $raw['ref4'] = $row['ref4'];
        $raw['ref5'] = $row['ref5'];
        $raw['ref6'] = $row['ref6'];

        $raw['request_method'] = $row['request_method'];
        $raw['request_to'] = $row['request_to'];
        $raw['client_inform_amarit_date'] = is_null($row['client_inform_amarit_date'])?"":date_format($row['client_inform_amarit_date'],'Y-m-d');
        $raw['client_inform_amarit_time'] = is_null($row['client_inform_amarit_time'])?"":date_format($row['client_inform_amarit_time'],'H:i');
        $raw['cs_inform_opr_date'] = is_null($row['cs_inform_opr_date'])?"":date_format($row['cs_inform_opr_date'],'Y-m-d');
        $raw['cs_inform_opr_time'] = is_null($row['cs_inform_opr_time'])?"":date_format($row['cs_inform_opr_time'],'H:i');
        $raw['opr_inform_cs_date'] = is_null($row['opr_inform_cs_date'])?"":date_format($row['opr_inform_cs_date'],'Y-m-d');
        $raw['opr_inform_cs_time'] = is_null($row['opr_inform_cs_time'])?"":date_format($row['opr_inform_cs_time'],'H:i');
        $raw['cs_inform_client_date'] = is_null($row['cs_inform_client_date'])?"":date_format($row['cs_inform_client_date'],'Y-m-d');
        $raw['cs_inform_client_time'] = is_null($row['cs_inform_client_time'])?"":date_format($row['cs_inform_client_time'],'H:i');

        $raw['reject_reason'] = $row['reject_reason'];
        //new
        $raw['invoice_date'] = is_null($row['date_in_vendor_invoice'])?"":date_format($row['date_in_vendor_invoice'],'Y-m-d');
        $raw['submitinvoice_date'] = is_null($row['date_vendor_submit_to_amarit'])?"":date_format($row['date_vendor_submit_to_amarit'],'Y-m-d');
        $raw['vendor_number'] = $row['vendor_invoice_number'];
        $raw['vendor_value'] = $row['vendor_invoice_value'];
        $raw['invoice_due_date'] = is_null($row['vendor_invoice_due_date'])?"":date_format($row['vendor_invoice_due_date'],'Y-m-d');
        $raw['submission_date'] = is_null($row['expense_sub_date'])?"":date_format($row['expense_sub_date'],'Y-m-d');
        $raw['date_review'] = is_null($row['date_job_ws_sent_to_manage'])?"":date_format($row['date_job_ws_sent_to_manage'],'Y-m-d');
        $raw['date_back'] = is_null($row['date_job_ws_received_back'])?"":date_format($row['date_job_ws_received_back'],'Y-m-d');
        $raw['mailing_list'] = $row['job_ws_mailing_list_ref'];
        $raw['copyfrom'] = $row['copyfrom'];


}






echo json_encode($raw);
sqlsrv_close($conn);
?>