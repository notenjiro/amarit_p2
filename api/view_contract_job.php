<?php
ini_set('display_errors', 'On');
require_once '../config_db.php';
require_once '../utils/helper.php';
session_start();

if($_SESSION["user_type"] == 'Admin'){
	$userType =	"AAL";
}else{
	$userType =	$_SESSION["user_type"];
}

$job = $_GET['job'];
$id = $_GET['id'];

$Table = array(
    'warehouse' => 'contract_warehousing_space_rental',
    'utilities' => 'contract_utilities',
    'retal' => 'contract_rental',
	'hotelbooking' => 'contract_hotel_booking',
	'ticketbooking' => 'contract_ticket_booking',
	'serviceother' => 'contract_service_other',
    'agencyservice' => 'contract_agency_service',
    'managementfee' => 'contract_management_fee',
    'provisionincome' => 'contract_provision_income',
	'customerclearancecargo' => 'contract_customs_clearance_cargo',
    'customerclearancevessle' => 'contract_customs_clearance_vessel',
);
$fQuery = "";
$raw['data'] = array();
if($Table[$job]){
    if($job == 'warehouse'){
		$fQuery = " SELECT wh.contract_line_number, wh.description,bcs.type_service_name as name , bcl.location_name as location,bcb.branch_name,
			bct.product_type_name as type,
			bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
			wh.fixed_space, wh.uom,wh.charge_per_unit ,wh.minimum_qty,wh.minimum_charge_amount , wh.customer_reference
			FROM ".$Table[$job]."  wh 
			Left join barcode_branch bcb on wh.barcode_branch  = bcb.code_branch
			Left join barcode_location bcl on wh.barcode_location  = bcl.no_location 
			Left join barcode_service bcs on wh.barcode_service = bcs.no_service 
			Left join barcode_product_type bct on wh.barcode_type = bct.no_product_type
			Left join barcode_sub_type1 bcst1 on  wh.sub1 = bcst1.no_sub_type1
			Left join barcode_sub_type2 bcst2 on  wh.sub2 = bcst2.no_sub_type2
			Left join barcode_sub_type3 bcst3 on wh.sub3 = bcst3.no_sub_type3
			Left join barcode_sub_type4 bcst4 on wh.sub4 = bcst4.no_sub_type4
			Left join barcode_sub_type5 bcst5 on wh.sub5 = bcst5.no_sub_type5
			Left join barcode_sub_type6 bcst6 on wh.sub6 = bcst6.no_sub_type6
			WHERE wh.contract_no = '".$id."' and  wh.user_type = '".$userType."' and bcs.[group] = 'WH' and bct.WH = 1 
			and bcst1.WH = 1 and bcst3.WH = 1 and bcst4.WH = 1 and bcst5.WH = 1
			";
    }
    else if($job == 'utilities'){
        $fQuery = " 
        SELECT
		cu.contract_line_number, 
		cu.description, 
		barcode_service.type_service_name as name, 
		barcode_location.location_name as location, 
		barcode_branch.branch_name, 
		barcode_product_type.product_type_name as type, 
		barcode_sub_type1.sub_type1 as sub1,
		barcode_sub_type2.sub_type2 as sub2,
		barcode_sub_type3.sub_type3 as sub3,
		barcode_sub_type4.sub_type4 as sub4, 
		barcode_sub_type5.sub_type5 as sub5, 
		barcode_sub_type6.sub_type6 as sub6,
		uom.description as uom,
		cu.charge_per_unit, 
		cu.minimum_qty, 
		cu.minimum_charge_amount, 
		cu.customer_reference
		FROM
			dbo.".$Table[$job]."  cu
			LEFT JOIN
			dbo.barcode_service
			ON 
				cu.barcode_service = barcode_service.no_service
			LEFT JOIN
			dbo.barcode_location 
			ON 
				cu.barcode_location = barcode_location.no_location 
			LEFT JOIN
			dbo.barcode_branch
			ON 
				cu.barcode_branch = barcode_branch.code_branch
			LEFT JOIN
			dbo.barcode_product_type
			ON 
				cu.barcode_type = barcode_product_type.no_product_type
			LEFT JOIN
			dbo.barcode_sub_type1
			ON 
				cu.sub1 = barcode_sub_type1.no_sub_type1
			LEFT JOIN
			dbo.barcode_sub_type2
			ON 
				cu.sub2 = barcode_sub_type2.no_sub_type2
			LEFT JOIN
			dbo.barcode_sub_type3
			ON 
				cu.sub3 = barcode_sub_type3.no_sub_type3
			LEFT JOIN
			dbo.barcode_sub_type4
			ON 
				cu.sub4 = barcode_sub_type4.no_sub_type4
			LEFT JOIN
			dbo.barcode_sub_type5
			ON 
				cu.sub5 = barcode_sub_type5.no_sub_type5
			LEFT JOIN
			dbo.barcode_sub_type6
			ON 
				cu.sub6 = barcode_sub_type6.no_sub_type6
			LEFT JOIN
			dbo.uom
			ON 
				cu.uom = uom.code
		WHERE
		cu.contract_no = '".$id."' and cu.user_type = '".$userType."'
		and barcode_service.[group] = 'UT' and barcode_product_type.UT = 1
		and barcode_sub_type4.UT = 1 and barcode_sub_type5.UT = 1 ";
    }
	else if($job == 'retal'){
		$fQuery = " SELECT DISTINCT rt.contract_line_number,rt.description,bcs.type_service_name as name , bcl.location_name as location,
			bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
			vt.description as vehicle_type,rt.uom,rt.charge_per_unit ,
			rt.minimum_qty,rt.minimum_charge_amount ,rt.customer_reference
			FROM ".$Table[$job]."  rt
			Left join barcode_location bcl on rt.barcode_location  = bcl.no_location 
			Left join barcode_service bcs on rt.barcode_service = bcs.no_service 
			Left join barcode_sub_type1 bcst1 on rt.sub1 = bcst1.no_sub_type1
			Left join barcode_sub_type2 bcst2 on rt.sub2 = bcst2.no_sub_type2
			Left join barcode_sub_type3 bcst3 on rt.sub3 = bcst3.no_sub_type3
			Left join barcode_sub_type4 bcst4 on rt.sub4 = bcst4.no_sub_type4
			Left join barcode_sub_type5 bcst5 on rt.sub5 = bcst5.no_sub_type5
			Left join barcode_sub_type6 bcst6 on rt.sub6 = bcst6.no_sub_type6
			Left join vehicle_type vt on rt.vehicle_type = vt.code
			WHERE rt.contract_no = '".$id."' and rt.user_type = '".$userType."' and bcs.[group] = 'RN'
			";
    }
	else if($job == 'hotelbooking'){
		$fQuery = " SELECT DISTINCT  ht.contract_line_number,ht.description,htn.hotel_name,
			ht.price_from_date, ht.price_to_date,
			bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
			ht.meal_included,ht.laundry_included,ht.uom,ht.charge_per_unit ,
			ht.minimum_qty,ht.minimum_charge_amount ,ht.customer_reference
			FROM ".$Table[$job]."  ht
			Left join hotel htn on ht.hotel_name = htn.hotel_id
			Left join barcode_product_type bct on ht.barcode_type = bct.no_product_type
			Left join barcode_sub_type1 bcst1 on ht.sub1 = bcst1.no_sub_type1
			Left join barcode_sub_type2 bcst2 on ht.sub2 = bcst2.no_sub_type2
			Left join barcode_sub_type3 bcst3 on ht.sub3 = bcst3.no_sub_type3
			Left join barcode_sub_type4 bcst4 on ht.sub4 = bcst4.no_sub_type4
			Left join barcode_sub_type5 bcst5 on ht.sub5 = bcst5.no_sub_type5
			Left join barcode_sub_type6 bcst6 on ht.sub6 = bcst6.no_sub_type6
			WHERE ht.contract_no = '".$id."' and ht.user_type = '".$userType."'
			and bct.BS = 1 and bcst4.BS = 1 and bcst5.BS = 1
			";
    }
	else if($job == 'ticketbooking'){
		$fQuery = " SELECT DISTINCT  tk.contract_line_number,tk.description,tk.flight_number,
			bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
			tk.airline_name,tk.with_luggage,tk.uom,tk.charge_per_unit ,
			tk.minimum_qty,tk.minimum_charge_amount ,tk.customer_reference
			FROM ".$Table[$job]."  tk
			Left join barcode_product_type bct on tk.barcode_type = bct.no_product_type
			Left join barcode_sub_type1 bcst1 on tk.sub1 = bcst1.no_sub_type1
			Left join barcode_sub_type2 bcst2 on tk.sub2 = bcst2.no_sub_type2
			Left join barcode_sub_type3 bcst3 on tk.sub3 = bcst3.no_sub_type3
			Left join barcode_sub_type4 bcst4 on tk.sub4 = bcst4.no_sub_type4
			Left join barcode_sub_type5 bcst5 on tk.sub5 = bcst5.no_sub_type5
			Left join barcode_sub_type6 bcst6 on tk.sub6 = bcst6.no_sub_type6
			WHERE tk.contract_no = '".$id."' and tk.user_type = '".$userType."'
			and bct.BS = 1 and bcst4.BS = 1 and bcst5.BS = 1
			";
    }
	else if($job == 'serviceother' || $job == 'agencyservice'|| $job == 'managementfee'|| $job == 'provisionincome'){
		$check = '';
		if($job == 'serviceother' || $job == 'managementfee'){
			$check = "SO";
		}else if($job == 'agencyservice'){
			$check = "AG";
		}else if($job == 'provisionincome'){
			$check = "PV";
		}

		$fQuery = " SELECT so.contract_line_number, so.description,
			bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
			so.position,vh.code,bcl_from.location_name as fromlocation,bcl_to.location_name as tolocation,so.diesel_from,so.diesel_to,
			so.uom,so.charge_per_unit ,so.minimum_qty,so.minimum_charge_amount , so.customer_reference
			FROM ".$Table[$job]." so
			Left join vehicle_type vh on so.vehicle_type = vh.code 
			Left join barcode_location bcl_from on so.from_contract_location = bcl_from.no_location 
			Left join barcode_location bcl_to on so.to_contract_location = bcl_to.no_location 
			Left join barcode_product_type bct on so.barcode_type = bct.no_product_type
			Left join barcode_sub_type1 bcst1 on  so.sub1 = bcst1.no_sub_type1
			Left join barcode_sub_type2 bcst2 on  so.sub2 = bcst2.no_sub_type2
			Left join barcode_sub_type3 bcst3 on so.sub3 = bcst3.no_sub_type3
			Left join barcode_sub_type4 bcst4 on so.sub4 = bcst4.no_sub_type4
			Left join barcode_sub_type5 bcst5 on so.sub5 = bcst5.no_sub_type5
			Left join barcode_sub_type6 bcst6 on  so.sub6 = bcst6.no_sub_type6
			WHERE so.contract_no = '".$id."' and  so.user_type = '".$userType."'";
    }else if($job == 'customerclearancevessle'){
		$fQuery = " SELECT DISTINCT ccv.contract_line_number,ccv.description,
		bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
		vst.description as vessel_type,ccv.uom,ccv.charge_per_unit ,
		ccv.minimum_qty,ccv.minimum_charge_amount ,ccv.customer_reference
		FROM ".$Table[$job]." ccv
		Left join vessel_type vst on ccv.vessel_type = vst.code
		Left join barcode_product_type bct on ccv.barcode_type = bct.no_product_type
		Left join barcode_sub_type1 bcst1 on  ccv.sub1 = bcst1.no_sub_type1
		Left join barcode_sub_type2 bcst2 on  ccv.sub2 = bcst2.no_sub_type2
		Left join barcode_sub_type3 bcst3 on ccv.sub3 = bcst3.no_sub_type3
		Left join barcode_sub_type4 bcst4 on ccv.sub4 = bcst4.no_sub_type4
		Left join barcode_sub_type5 bcst5 on ccv.sub5 = bcst5.no_sub_type5
		Left join barcode_sub_type6 bcst6 on  ccv.sub6 = bcst6.no_sub_type6
		WHERE ccv.contract_no = '".$id."' and ccv.user_type = '".$userType."'
		and bct.CH = 1 and bcst4.CH = 1 and bcst5.CH = 1
		";
	}else if($job == 'customerclearancecargo'){
		$fQuery = " SELECT DISTINCT ccc.contract_line_number,ccc.description,
		bcs.type_service_name as name,bct.product_type_name as type,bcst1.sub_type1 as sub1,bcst2.sub_type2 as sub2,bcst3.sub_type3 as sub3,bcst4.sub_type4 as sub4,bcst5.sub_type5 as sub5,bcst6.sub_type6 as sub6,
		bcl_from.location_name as fromlocation,bcl_to.location_name as tolocation,
		ccc.uom,ccc.charge_per_unit ,
		ccc.minimum_qty,ccc.minimum_charge_amount ,ccc.customer_reference
		FROM ".$Table[$job]." ccc
		Left join barcode_location bcl_from on ccc.weight_from  = bcl_from.no_location 
		Left join barcode_location bcl_to on ccc.weight_to = bcl_to.no_location 
		Left join barcode_service bcs on  ccc.barcode_service = bcs.no_service 
		Left join barcode_product_type bct on ccc.barcode_type = bct.no_product_type
		Left join barcode_sub_type1 bcst1 on  ccc.sub1 = bcst1.no_sub_type1
		Left join barcode_sub_type2 bcst2 on  ccc.sub2 = bcst2.no_sub_type2
		Left join barcode_sub_type3 bcst3 on ccc.sub3 = bcst3.no_sub_type3
		Left join barcode_sub_type4 bcst4 on ccc.sub4 = bcst4.no_sub_type4
		Left join barcode_sub_type5 bcst5 on ccc.sub5 = bcst5.no_sub_type5
		Left join barcode_sub_type6 bcst6 on  ccc.sub6 = bcst6.no_sub_type6

		WHERE ccc.contract_no = '".$id."' and ccc.user_type = '".$userType."'
		and bct.CH = 1 and bcst4.CH = 1 and bcst5.CH = 1 and bcs.[group]  = 'CH'
		";
	}

$raw['$fQuery'] = $fQuery;
   
 $result = sqlsrv_query($conn, $fQuery);
   
 
    if($result == false){
        $raw['status'] = 0;
        $raw['msg'] = 'error';
    }else{
    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
       $data = array();
        array_push($data,'');
		foreach ($row as $key =>$value) {

            if($key == 'no_charge' || $key== 'fixed_space' || $key== 'reimbursement' || $key=='reimbursment' || $key == 'lump_sum_charge' || $key == 'with_luggage' || $key ==  'meal_included' || $key == 'laundry_included'){
                if($value == 1){
                    $value = "Y";
                }
				if($value == 0 || $value == '-' || is_null($value) || $value == ''){
                    $value = "N";
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



    