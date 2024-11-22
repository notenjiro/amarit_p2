<?php
ini_set('display_errors', 'On');
require_once '../config_db.php';
require_once '../utils/helper.php';

$job = $_GET['job'];
$id = $_GET['id'];
$type = $_GET['type'];



if($type == "job"){
    $Table = array(
        'warehousing' => 'job_warehousing_space_rental',
        'utilities' => 'job_utilities',
        'rental' => 'job_rental',
        'hotelbooking' => 'job_hotel_booking',
        'ticketbooking' => 'job_ticket_booking',
        'serviceother' => 'job_service_other',
        'agencyservice' => 'job_agency_service',
        'managementfree' => 'job_management_fee',
        'provisionincome' => 'job_provision_income',
        'customerclearancecargo' => 'job_clearance_cargo',
        'customerclearancevessel' => 'job_clearance_vessel'
    ); 
}else{
    $Table = array(
        'warehousing' => 'worksheet_warehousing_space_rental',
        'utilities' => 'worksheet_utilities',
        'rental' => 'worksheet_rental',
        'hotelbooking' => 'worksheet_hotel_booking',
        'ticketbooking' => 'worksheet_ticket_booking_job',
        'serviceother' => 'worksheet_service_other_job',
        'agencyservice' => 'worksheet_agency_service',
        'managementfree' => 'worksheet_management_free',
        'provisionincome' => 'worksheet_provision_income',
        'customerclearancecargo' => 'worksheet_customer_clearance_cargo',
        'customerclearancevessel' => 'worksheet_customer_clearance_vessel'
    );  
}

if($type == "job"){
    $arrCheckBy = array(
        'warehousing' => 'warehousing_space_rental_id',
        'utilities' => 'utilities_id',
        'rental' => 'rental_id',
        'hotelbooking' => 'hotelbooking_id',
        'ticketbooking' => 'ticketbooking_id',
        'serviceother' => 'serviceother_id',
        'agencyservice' => 'agencyservice_id',
        'managementfree' => 'managementfree_id',
        'provisionincome' => 'provisionincome_id',
        'customerclearancecargo' => 'clearance_cargo_id',
        'customerclearancevessel' => 'clearance_vessel_id'
    );
}else{
   $arrCheckBy = array(
    'warehousing' => 'warehousing_space_rental_id',
    'utilities' => 'utilities_id',
    'rental' => 'rental_id',
	'hotelbooking' => 'hotelbooking_id',
	'ticketbooking' => 'ticketbooking_id',
    'serviceother' => 'serviceother_id',
    'agencyservice' => 'agencyservice_id',
    'managementfree' => 'managementfree_id',
    'provisionincome' => 'provisionincome_id',
     'customerclearancecargo' => 'customerclearancecargo_id',
    'customerclearancevessel' => 'customerclearancevessel_id'
); 
}



$fQuery = "";
$raw['data'] = array();
if($Table[$job]){
    if($job == 'warehousing'){
		$fQuery = "SELECT  wh.status,wh.warehousing_space_rental_id,wh.description,wh.remark,bcs.type_service_name as name ,bcl.location_name as location,bct.product_type_name as type,
                    bcst1.sub_type1 as sub1, bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6, wh.start_date, wh.start_time, wh.end_date, wh.end_time, wh.qty,  u.description as uom,
                    wh.contract_number , wh.department, wh.cost_center, wh.amount, wh.charge, wh.fix_space, wh.no_charge, wh.reimbursment, wh.lump_sum_charge,
                    wh.ref1,wh.ref2,wh.ref3,wh.ref4,wh.ref5,wh.ref6
                    FROM ".$Table[$job]." wh 
                    LEFT JOIN uom u on wh.uom = u.code
                    Left join barcode_location bcl on wh.location = bcl.no_location 
                    Left join barcode_service bcs on wh.name = bcs.no_service 
                    Left join barcode_product_type bct on wh.type = bct.no_product_type
                    Left join barcode_sub_type1 bcst1 on  wh.sub1 = bcst1.no_sub_type1
                    Left join barcode_sub_type2 bcst2 on  wh.sub2 = bcst2.no_sub_type2
                    Left join barcode_sub_type3 bcst3 on wh.sub3 = bcst3.no_sub_type3
                    Left join barcode_sub_type4 bcst4 on wh.sub4 = bcst4.no_sub_type4
                    Left join barcode_sub_type5 bcst5 on wh.sub5 = bcst5.no_sub_type5
                    Left join barcode_sub_type6 bcst6 on wh.sub6 = bcst6.no_sub_type6
                    WHERE wh.worksheet_id = '".$id."' and bcs.[group] = 'WH' 
                    ORDER BY wh.reccode ASC";
    }
    else if($job == 'utilities'){
        $fQuery = "SELECT wh.status,wh.utilities_id,wh.description,wh.remark ,bcl.location_name as location,bct.product_type_name as type,
                    bcst1.sub_type1 as sub1, bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6, wh.start_date, wh.end_date, wh.qty, u.description as uom,
                    wh.contract_number , wh.department, wh.cost_center, wh.amount, wh.charge, wh.no_charge, wh.reimbursement,wh.lump_sum_charge,
                    wh.ref1,wh.ref2,wh.ref3,wh.ref4,wh.ref5,wh.ref6
                    FROM ".$Table[$job]." wh 
                    LEFT JOIN uom u on wh.uom = u.code
                    Left join barcode_location bcl on wh.location = bcl.no_location 
                    Left join barcode_product_type bct on wh.type = bct.no_product_type
                    Left join barcode_sub_type1 bcst1 on wh.sub1 = bcst1.no_sub_type1
                    Left join barcode_sub_type2 bcst2 on wh.sub2 = bcst2.no_sub_type2
                    Left join barcode_sub_type3 bcst3 on wh.sub3 = bcst3.no_sub_type3
                    Left join barcode_sub_type4 bcst4 on wh.sub4 = bcst4.no_sub_type4
                    Left join barcode_sub_type5 bcst5 on wh.sub5 = bcst5.no_sub_type5
                    Left join barcode_sub_type6 bcst6 on wh.sub6 = bcst6.no_sub_type6
                    WHERE wh.worksheet_id = '".$id."'
                    ORDER BY wh.reccode ASC";
    }
	else if($job == 'rental'){
		$fQuery = "SELECT rt.status,rt.rental_id,rt.description,rt.remark,rt.vehicle_equipment_id,rt.charge_as ,bcl.location_name as location,
                     bcst1.sub_type1 as sub1, bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
                    rt.start_date,rt.start_time, rt.end_date, rt.end_time, rt.qty,  u.description as uom,
                    rt.contract_number , rt.amount, rt.charge, rt.department, rt.cost_center, rt.no_charge,rt.reimbursement,rt.lump_sum_charge,rt.replacement,
                    rt.vendor_invoice_date,rt.vendor_invoice_number,rt.vendor_invoice_submission_date,rt.vendor_invoice_value,rt.vendor_invoice_due_date,
                    rt.ref1,rt.ref2,rt.ref3,rt.ref4,rt.ref5,rt.ref6
                    FROM ".$Table[$job]." rt
                    LEFT JOIN uom u on rt.uom = u.code
                    Left join barcode_location bcl on rt.location = bcl.no_location 
                    Left join barcode_sub_type1 bcst1 on rt.sub1 = bcst1.no_sub_type1
                    Left join barcode_sub_type2 bcst2 on rt.sub2 = bcst2.no_sub_type2
                    Left join barcode_sub_type3 bcst3 on rt.sub3 = bcst3.no_sub_type3
                    Left join barcode_sub_type4 bcst4 on rt.sub4 = bcst4.no_sub_type4
                    Left join barcode_sub_type5 bcst5 on rt.sub5 = bcst5.no_sub_type5
                    Left join barcode_sub_type6 bcst6 on rt.sub6 = bcst6.no_sub_type6
                    WHERE rt.worksheet_id = '".$id."' and bcst3.RN = 1 and bcst4.RN = 1 and bcst5.RN = 1 
                    ORDER BY rt.reccode ASC ";
    }
	else if($job == 'hotelbooking'){
		$fQuery = "SELECT ht.status,ht.hotelbooking_id,ht.description,bcl.location_name as location,
                    bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
                    h.hotel_name,ht.occupant,
                    CASE WHEN ht.meal_included = 1 THEN 'Y' ELSE 'N' END AS meal_included,
                    CASE WHEN ht.laundry_included = 1 THEN 'Y' ELSE 'N' END AS laundry_included,
                    ht.remark,ht.checkin_date,ht.checkout_date,ht.qty,  u.description as uom,ht.amount,ht.charge,ht.contract_number,
                    ht.department, ht.cost_center,ht.amount_system_price,ht.no_charge,ht.reimbursement,ht.lump_sum_charge,
                    ht.payment_method,ht.iou_cheque_date,ht.iou_number,ht.iou_cheque_amount,ht.cheque_remark,
                    ht.vendor_invoice_date,ht.vendor_invoice_number,ht.vendor_invoice_submission_date,ht.vendor_invoice_value,ht.vendor_invoice_due_date,
                    ht.expense_submission_date,
                    ht.ref1,ht.ref2,ht.ref3,ht.ref4,ht.ref5,ht.ref6
                    FROM ".$Table[$job]." ht 
                    LEFT JOIN uom u on ht.uom = u.code
                    Left join hotel h on ht.hotel_name = h.hotel_id
                    Left join barcode_location bcl on ht.location = bcl.no_location 
                    Left join barcode_product_type bct on ht.type = bct.no_product_type
                    Left join barcode_sub_type1 bcst1 on ht.sub1 = bcst1.no_sub_type1
                    Left join barcode_sub_type2 bcst2 on ht.sub2 = bcst2.no_sub_type2
                    Left join barcode_sub_type3 bcst3 on ht.sub3 = bcst3.no_sub_type3
                    Left join barcode_sub_type4 bcst4 on ht.sub4 = bcst4.no_sub_type4
                    Left join barcode_sub_type5 bcst5 on ht.sub5 = bcst5.no_sub_type5
                    Left join barcode_sub_type6 bcst6 on ht.sub6 = bcst6.no_sub_type6
                    WHERE ht.worksheet_id = '".$id."' and bct.BS = 1 and  bcst4.BS = 1 and bcst5.BS = 1 
                    ORDER BY ht.reccode ASC";
    }
	else if($job == 'ticketbooking'){
		$fQuery = "SELECT tk.status,tk.ticketbooking_id,tk.description,tk.flight_number,
                    bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
                    tk.remark,tk.passenger,tk.airline_name,tk.departure_date,tk.departure_location,tk.destination_date,tk.destination_location,tk.with_luggage,
                    tk.qty,  u.description as uom,tk.amount,tk.charge,tk.contract_number,tk.amount_system_price,
                    tk.department, tk.cost_center,tk.no_charge,tk.reimbursement,tk.lump_sum_charge,
                    tk.payment_method,tk.iou_cheque_date,tk.iou_number,tk.iou_cheque_amount,tk.cheque_remark,
                    tk.vendor_invoice_date,tk.vendor_invoice_number,tk.vendor_invoice_submission_date,tk.vendor_invoice_value,tk.vendor_invoice_due_date,
                    tk.expense_submission_date,
                    tk.ref1,tk.ref2,tk.ref3,tk.ref4,tk.ref5,tk.ref6
                    FROM ".$Table[$job]." tk 
                    LEFT JOIN uom u on tk.uom = u.code
                    Left join barcode_product_type bct on tk.type = bct.no_product_type
                    Left join barcode_sub_type1 bcst1 on tk.sub1 = bcst1.no_sub_type1
                    Left join barcode_sub_type2 bcst2 on tk.sub2 = bcst2.no_sub_type2
                    Left join barcode_sub_type3 bcst3 on tk.sub3 = bcst3.no_sub_type3
                    Left join barcode_sub_type4 bcst4 on tk.sub4 = bcst4.no_sub_type4
                    Left join barcode_sub_type5 bcst5 on tk.sub5 = bcst5.no_sub_type5
                    Left join barcode_sub_type6 bcst6 on tk.sub6 = bcst6.no_sub_type6
                    WHERE tk.worksheet_id = '".$id."' and bct.BS = 1 and  bcst4.BS = 1 and bcst5.BS = 1 
                    ORDER BY tk.reccode ASC";
    }else if($job == 'serviceother' || $job == 'agencyservice' || $job == 'managementfree'|| $job == 'provisionincome'){

        $fQuery = "SELECT wh.status,wh.".$arrCheckBy[$job].",wh.description,wh.contract_description,wh.remark ,bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,
                    bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,vh.registration_no,wh.operator_id,wh.operator_name,wh.charge_as,wh.position,wh.diesel_rate,wh.from_contract,wh.to_contract
                    ,wh.start_date,wh.start_time, wh.end_date,wh.end_time, wh.qty, u.description as uom, wh.contract_number_manual,
                    wh.contract_number_auto, wh.department, wh.cost_center, wh.amont_system, wh.charge, wh.no_charge, wh.reimbursment,wh.lump_sum_charge,
                    wh.vendor_invoice_date,wh.vendor_invoice_number,wh.vendor_invoice_value,wh.vendor_invoice_submission_date,
                    wh.ref1,wh.ref2,wh.ref3,wh.ref4,wh.ref5,wh.ref6
                    FROM ".$Table[$job]." wh 
                    LEFT JOIN uom u on wh.uom = u.code
                    Left join vehicle vh on wh.vehicle_id = vh.vehicle_id
                    Left join barcode_product_type bct on wh.type = bct.no_product_type
                    Left join barcode_sub_type1 bcst1 on  wh.sub1 = bcst1.no_sub_type1
                    Left join barcode_sub_type2 bcst2 on  wh.sub2 = bcst2.no_sub_type2
                    Left join barcode_sub_type3 bcst3 on wh.sub3 = bcst3.no_sub_type3
                    Left join barcode_sub_type4 bcst4 on wh.sub4 = bcst4.no_sub_type4
                    Left join barcode_sub_type5 bcst5 on wh.sub5 = bcst5.no_sub_type5
                    Left join barcode_sub_type6 bcst6 on wh.sub6 = bcst6.no_sub_type6

                    WHERE wh.worksheet_id = '".$id."'
                    ORDER BY wh.reccode ASC";
    }else if($job == 'customerclearancecargo'){
        $fQuery = "SELECT 
                    ccc.status,
                    ccc.customerclearancecargo_id, 
                    ccc.description, 
                    ccc.service_description, 
                    bcl.location_name as location,bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
                    ccc.clearance_start_date, 
                    ccc.clearance_finish_date, 
                    ccc.customs_entry_number, 
                    ccc.cargo_total_weight, 
                    ccc.origin_country, 
                    ccc.import_poe, 
                    ccc.export_pod, 
                    ccc.import_eta_date, 
                    ccc.import_ata_date, 
                    ccc.export_etd_date, 
                    ccc.export_atd_date, 
                    ccc.do_release_date, 
                    ccc.container_open_date, 
                    ccc.cheque_received_date, 
                    ccc.duty_tax_amount, 
                    ccc.awb_bl_number, 
                    ccc.cipl_number, 
                    ccc.cipl_value, 
                    ccc.qty, 
                    u.description as uom, 
                    ccc.contract_number, 
                    ccc.department, 
                    ccc.cost_center, 
                    ccc.amount_system, 
                    ccc.charge, 
                    ccc.no_charge, 
                    ccc.reimbursement, 
                    ccc.lump_sum_charge, 
                    ccc.iou_cheque_date, 
                    ccc.iou_number, 
                    ccc.iou_amount, 
                    ccc.cheque_remark, 
                    ccc.cheque_amount, 
                    ccc.vendor_invoice_date, 
                    ccc.vendor_invoice_number, 
                    ccc.vendor_invoice_submission_date, 
                    ccc.vendor_invoice_value, 
                    ccc.vendor_invoice_due_date, 
                    ccc.expense_submission_date,
                    ccc.ref1, 
                    ccc.ref2, 
                    ccc.ref3, 
                    ccc.ref4, 
                    ccc.ref5, 
                    ccc.ref6
                    FROM ".$Table[$job]." ccc
                    LEFT JOIN uom u on ccc.uom = u.code
                    Left join barcode_location bcl on ccc.location = bcl.no_location 
                    LEFT JOIN barcode_product_type bct ON ccc.[type] = bct.no_product_type
                    LEFT JOIN barcode_sub_type1 bcst1 ON ccc.sub1 = bcst1.no_sub_type1
                    LEFT JOIN barcode_sub_type2 bcst2 ON ccc.sub2 = bcst2.no_sub_type2
                    LEFT JOIN barcode_sub_type3 bcst3 ON ccc.sub3 = bcst3.no_sub_type3
                    LEFT JOIN barcode_sub_type4 bcst4 ON ccc.sub4 = bcst4.no_sub_type4
                    LEFT JOIN barcode_sub_type5 bcst5 ON ccc.sub5 = bcst5.no_sub_type5
                    LEFT JOIN barcode_sub_type6 bcst6 ON ccc.sub6 = bcst6.no_sub_type6
                    WHERE ccc.worksheet_id = '".$id."'
                    ORDER BY ccc.reccode ASC";
    }else if($job == 'customerclearancevessel'){
        $fQuery  = "SELECT 
                    ccv.status,
                    ccv.customerclearancevessel_id, 
                    ccv.description, 
                    ccv.service_description, 
                    bcl.location_name as location,bct.product_type_name as type,
                    bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
                    ccv.clearance_port, 
                    ccv.startdate,
                    ccv.finishdate,
                    ccv.vessel_name, 
                    ccv.vessel_type, 
                    ccv.vessel_owner, 
                    ccv.vessel_weight, 
                    ccv.vessel_length, 
                    ccv.vessel_draft,
                    ccv.last_port_of_department, 
                    ccv.next_port, 
                    ccv.qty, 
                    u.description as uom, 
                    ccv.contract_number, 
                    ccv.department, 
                    ccv.cost_center, 
                    ccv.amount_system, 
                    ccv.no_charge, 
                    ccv.reimbursement, 
                    ccv.lump_sum_charge, 
                    ccv.iou_cheque_date, 
                    ccv.iou_number, 
                    ccv.iou_amount, 
                    ccv.cheque_remark, 
                    ccv.cheque_amount, 
                    ccv.vendor_invoice_date, 
                    ccv.vendor_invoice_number, 
                    ccv.vendor_invoice_submission_date, 
                    ccv.vendor_invoice_value, 
                    ccv.vendor_invoice_due_date, 
                    ccv.expense_submission_date, 
                    ccv.ref1, 
                    ccv.ref2, 
                    ccv.ref3, 
                    ccv.ref4, 
                    ccv.ref5, 
                    ccv.ref6, 
                    ccv.charge
                FROM ".$Table[$job]." ccv
                LEFT JOIN uom u on ccv.uom = u.code
                LEFT JOIN barcode_location bcl ON ccv.location = bcl.no_location 
                LEFT JOIN barcode_product_type bct ON ccv.[type] = bct.no_product_type
                LEFT JOIN barcode_sub_type1 bcst1 ON ccv.sub1 = bcst1.no_sub_type1
                LEFT JOIN barcode_sub_type2 bcst2 ON ccv.sub2 = bcst2.no_sub_type2
                LEFT JOIN barcode_sub_type3 bcst3 ON ccv.sub3 = bcst3.no_sub_type3
                LEFT JOIN barcode_sub_type4 bcst4 ON ccv.sub4 = bcst4.no_sub_type4
                LEFT JOIN barcode_sub_type5 bcst5 ON ccv.sub5 = bcst5.no_sub_type5
                LEFT JOIN barcode_sub_type6 bcst6 ON ccv.sub6 = bcst6.no_sub_type6
                WHERE ccv.worksheet_id = '".$id."'
                ORDER BY ccv.reccode ASC";

    }


 $result = sqlsrv_query($conn, $fQuery);
   
   
    if($result == false){
        $raw['status'] = 0;
        $raw['msg'] = 'error';
    }else{
    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
       $data = array();
        array_push($data,'');
        array_push($data,'');
        foreach ($row as $key =>$value) {
            if($key == 'no_charge' || $key== 'fix_space' || $key== 'reimbursement' || $key=='reimbursment' || $key == 'lump_sum_charge' || $key == 'with_luggage' || $key ==  'meal_included' || 
            $key == 'laundry_included'){
                if($value == 0 || $value == '-'|| is_null($value) || $value == ''){
                    $value = "N";
                }else if($value == 1){
                    $value = "Y";
                }
            }
            array_push($data, $value);
        }
        array_push($raw['data'],$data);
     } 
    $raw['status'] = 1;
        
    }
}



echo json_encode($raw);
sqlsrv_close($conn);
?>



    