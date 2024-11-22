<?php 
	require_once 'config_db.php';
	require_once 'utils/helper.php';
    $output = '';  
	$output.= "
    <html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">
    <html>
        <head><meta http-equiv=\"Content-type\" content=\"text/html;charset=utf-8\" /></head>
        <body>
";
	
	if( $conn ) {
		$from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
		$show_amount = $_GET['show_amount'];
		$output.= '
        <table class="table" bordered="1">
            <tr>
                <th>No.</th>
				<th>User ID</th>
				<th>Branch</th>
				<th>Client request date</th>
				<th>time</th>
				<th>Worksheet status</th>
				<th>line status</th>
				<th>Close date</th>
				<th>Close time</th>
				<th>Send date</th>
				<th>Send time</th>
				<th>RCVD date</th>
				<th>RCVD time</th>				
				
				<th>Worksheet ID</th>
				<th>Worksheet date</th>
				<th>Service Type</th>
				<th>Service ID</th>
				<th>G/L Account</th>  
				<th>Customer No.</th>
				<th>Customer</th>
				<th>Subject</th>
				<th>Contract number</th>
				<th>Contract line number</th>
				<th>Customer ref.</th>
				<th>Requester</th>
				<th>Remark</th>					
				<th>Request method</th>
				<th>Request to</th>
				<th>CS inform OPR</th>
				<th>time</th>
				<th>OPR inform CS</th>
				<th>time</th>
				<th>CS inform client</th>
				<th>time</th>
				<th>Vehicle</th>
				<th>Vehicle ERP ID</th>
				<th>Charge as</th>
				<th>Outsource charge as</th>
				<th>Outsource</th>
				<th>Vendor Name</th>
				<th>Empleyee ID</th>
                <th>Operator/Manpower</th>
				<th>Base location/Branch</th>
				<th>Position</th>
                <th>From (Contract)</th>
				<th>To (Contract)</th>
				<th>Specific location from</th>
				<th>Specific location to</th>
				<th>Contact person (from)</th>
				<th>Contact person (to)</th>
				

				<th>Remark</th>
				<th>Reference 1</th>
				<th>Reference 2</th>
				<th>Department</th>
				<th>Cost center</th>
				<th>Universal Location/From</th>
				<th>Universal To</th>
				<th>Mileage start</th>
				<th>Mileage end</th>
				<th>Fuel ratio</th>
				<th>Total Km.</th>
				<th>Km. from contract</th>
				<th>Start date</th>
				<th>Start time</th>
				<th>End date</th>
				<th>End time</th>
                <th>Qty</th>
				<th>Qty Contract</th>
                <th>UOM</th>
				<th>Amount</th>
				<th>Total amount</th>
				<th>Diesel rate</th>
				<th>No charge</th>
				<th>Consolidate</th>
				<th>Vehicle switch</th>
				<th>Standby charge</th>
				<th>Round trip</th>
				<th>Cancel reason</th>
				<th>Reason for outsource</th>
				<th>Cargo type</th>
				<th>Cargo quantity</th>
				<th>Cargo weight</th>
				<th>Dimension</th>
				<th>User ID</th>
				<th>Name</th>
                <th>Branch</th>
                <th>Type</th>
                <th>Sub type 1</th>
				<th>Sub type 2</th>
				<th>Sub type 3</th>
				<th>Sub type 4</th>
                <th>Barcode</th>
                
				<th>type 1</th>
				<th>type 2</th>
				<th>type 3</th>
				<th>type 4</th>
				<th>worksheet reference 1</th>
				<th>worksheet reference 2</th>
				<th>worksheet reference 3</th>
				<th>worksheet reference 4</th>
				<th>worksheet reference 5</th>
				<th>worksheet reference 6</th>
				<th>line reference 1</th>
				<th>line reference 2</th>
				<th>line reference 3</th>
				<th>line reference 4</th>
				<th>line reference 5</th>
				<th>line reference 6</th>
				
				<th>ERP Invoice No.</th>
				<th>Invoice date</th>				
				<th>Invoice amount ERP</th>
				<th>Diff</th>
				<th>Billing submission date</th>
				<th>RV & CN number</th>
				<th>RV date</th>
				<th>Service line push to ERP</th>
				<th>Lump-sum charge</th>
				<th>Reimbursment</th>
				<th>Transport Solution</th>

				<th>line create date</th>
				<th>line modify date</th>
				<th>line modify by</th>
				<th>data export date</th>
            </tr>
        ';
	

$exquery = "update worksheet set close_date = send_date, close_time = send_time
where close_date is null and worksheet_status in ('Closed','Send to NAV')
and send_date is not null";
$stmt = sqlsrv_query($conn, $exquery);

$exquery = "update worksheet set close_date = modify_date, close_time = client_inform_amarit_time  where close_date is null and worksheet_status in ('Closed','Send to NAV') and modify_date is not null";
$stmt = sqlsrv_query($conn, $exquery);

$exquery = "update worksheet set send_date = close_date, send_time = close_time  where send_date is null and worksheet_status in ('Send to NAV')";
$stmt = sqlsrv_query($conn, $exquery);

$exquery = "update worksheet set rcvd_date = send_date, rcvd_time = send_time  where rcvd_date is null and worksheet_status in ('Send to NAV')";
$stmt = sqlsrv_query($conn, $exquery);

$exquery = "update worksheet set rcvd_date = send_date where rcvd_date < send_date";
$stmt = sqlsrv_query($conn, $exquery);

$fQuery = "select 'TRANSPORT' as service_type, a.worksheet_id, w.worksheet_date, a.transport_id, v.registration_no, o.name,a.transport_from, a.transport_to, a.contact1, a.contact2, a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, a.mileage_start, a.mileage_end, vt.fuel_km_per_litre, a.actual_start_date as start_date ,a.actual_start_time as start_time,a.actual_finish_date as end_date, a.actual_finish_time as end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,a.cost_center as basebranch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.specific_location_from, a.specific_location_to, a.diesel_rate, a.no_charge, a.consolidate, a.vehicle_switch, a.cancel_reason, a.cargo_type, a.cargo_qty, a.cargo_weight, a.dimension, a.actual_start_date, a.actual_start_time, a.actual_finish_date, a.actual_finish_time, w.user_id, po.description as position

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, a.standby_charge, u.erp_id, a.transport_solution, 0 as amount

, w.close_date, w.close_time, w.rcvd_date, w.rcvd_time, w.send_date, w.send_time, a.charge_as as charge_as_name, a.outsource_charge_as as outsource_charge_as_name, o.staff_id, lumsum_charge, promotion_code, a.create_date, a.modify_date, ct.erp_contract_no, a.erp_invoice_no, v.branch as branch, '' as reimbursment, 0 as q, a.round_trip, a.lumsum_charge as lump_sum, a.invoice

,a.doc_no, a.invoice_amount, a.rv_no, a.posting_date, a.submit_date, a.rv_date, a.modify_by, a.transport_solution
,w.print_date
from worksheet_cargo_transport a 
left join contract_location_master c on c.location = a.transport_from
and c.active = 1
left join location l on l.code = c.universal_location
left join contract_location_master cc on cc.location = a.transport_to
and cc.active = 1
left join location ll on ll.code = cc.universal_location
left join vehicle v on v.vehicle_id = a.vehicle 
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join position po on po.code = o.position
left join customer u on u.customer_id = a.customer
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join vehicle_type vt on vt.code = v.vehicle_type
left join customer_contract ct on ct.contract_no = a.contract_no
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
union 

select 'MANPOWER', a.worksheet_id,w.worksheet_date,a.labor_service_id,'',v.name,a.[location],'', '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,0,
a.start_date,a.start_time,a.end_date,a.end_time,quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,a.cost_center as basebranch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', 0, a.no_charge, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, a.position

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6, '', v.outsource, vo.description, '', u.erp_id, 0, 0 as amount 

, w.close_date, w.close_time, w.rcvd_date, w.rcvd_time, w.send_date, w.send_time, a.charge_as as charge_as_name, pp.description as outsource_charge_as_name, v.staff_id, 0 as lumsum_charge,'' as promotion_code, a.create_date, a.modify_date, ct.erp_contract_no, a.erp_invoice_no, v.branch as branch, '' as reimbursment, 0 as q, 0 as round_trip, a.lump_sum, a.invoice 

,a.doc_no, a.invoice_amount, a.rv_no, a.posting_date, a.submit_date, a.rv_date, a.modify_by, '' as transport_solution
,w.print_date
from worksheet_manpower a
left join contract_location c on c.location = a.location
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join operator v on v.operator_id = a.labor
left join vehicle_owner vo on vo.code=v.vendor
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join position p on p.code = a.charge_as
left join position pp on pp.code = a.outsource_charge_as
left join customer_contract ct on ct.contract_no = a.contract_no
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'  
 union 

 select 'CARGO HANDLE',a.worksheet_id,w.worksheet_date,a.cargo_service_id,v.registration_no,o.name,a.transport_from,'', '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,0,
a.start_date,a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,a.cost_center as basebranch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', a.diesel_rate, a.no_charge, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, ''

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, '', u.erp_id, 0, 0 as amount

, w.close_date, w.close_time, w.rcvd_date, w.rcvd_time, w.send_date, w.send_time, a.charge_as as charge_as_name, a.outsource_charge_as as outsource_charge_as_name, o.staff_id, 0 as lumsum_charge,'' as promotion_code, a.create_date, a.modify_date, ct.erp_contract_no, a.erp_invoice_no, v.branch as branch, '' as reimbursment,(select sum(quantity) as q from worksheet_cargo_handling WHERE customer = a.customer and worksheet_id = a.worksheet_id and vehicle = a.vehicle) as q, 0 as round_trip, 0 as lump_sum, a.invoice

,a.doc_no, a.invoice_amount, a.rv_no, a.posting_date, a.submit_date, a.rv_date, a.modify_by, '' as transport_solution
,w.print_date
from worksheet_cargo_handling a
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join customer_contract ct on ct.contract_no = a.contract_no
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' 
union 

select 'SERVICE - OTHER',a.worksheet_id,w.worksheet_date,a.cargo_service_id,v.registration_no,o.name,a.description,a.description2, '', '', '', '', a.agreement_number, '', a.remark, a.ref1, a.ref2, a.department, a.cost_center,l.description as u_from,'',0,0,0,
a.start_date,a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,a.cost_center as basebranch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+c.sub_location+'-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, '', '', 0, a.no_charge, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, ''

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, '', u.erp_id, 0, a.amount 

, w.close_date, w.close_time, w.rcvd_date, w.rcvd_time, w.send_date, w.send_time, '' as charge_as_name, '' as outsource_charge_as_name, o.staff_id, 0 as lumsum_charge,'' as promotion_code, a.create_date, a.modify_date, a.agreement_number as erp_contract_no, a.erp_invoice_no, v.branch as branch, a.reimbursment, 0 as q, 0 as round_trip, 0 as lump_sum, a.invoice      

,a.doc_no, a.invoice_amount, a.rv_no, a.posting_date, a.submit_date, a.rv_date, a.modify_by, '' as transport_solution
,w.print_date
from worksheet_service a
left join contract_location_master c on c.location = a.transport_from and c.active = 1
left join location l on l.code = c.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join customer_contract ct on ct.contract_no = a.agreement_number
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
union 

select 'IMMIGRATION',a.worksheet_id,w.worksheet_date,a.immigration_id,'','','','', '', '', '', '', a.agreement_number, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center,'' as u_from,'',0,0,0,
a.start_date,a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,a.cost_center as basebranch,'12' as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-'+'00'+'-'+'12'+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-00-00' as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.service as specific_location_from, '', 0, a.no_charge, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, ''

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6, '', '', '', '', u.erp_id, 0, 0 as amount 

, w.close_date, w.close_time, w.rcvd_date, w.rcvd_time, w.send_date, w.send_time, '' as charge_as_name, '' as outsource_charge_as_name, '' as staff_id, 0 as lumsum_charge,'' as promotion_code, a.create_date, a.modify_date, ct.erp_contract_no, a.erp_invoice_no , '' as branch, a.reimbursment, 0 as q, 0 as round_trip, 0 as lump_sum, a.invoice

,a.doc_no, a.invoice_amount, a.rv_no, a.posting_date, a.submit_date, a.rv_date, a.modify_by, '' as transport_solution
,w.print_date
from worksheet_immigration a 
left join customer u on u.customer_id = a.customer 
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join customer_contract ct on ct.contract_no = a.agreement_number
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'
union 

select 'PERSONNEL TRANSPORT' as service_type, a.worksheet_id, w.worksheet_date, a.taxi_service_id, v.registration_no, o.name,a.transport_from, a.transport_to, '', '', a.charge_as, a.outsource_charge_as, a.contract_no, a.contract_line, a.remark, a.ref1, a.ref2, a.department, a.cost_center, l.description as u_from, ll.description as u_to, 0, 0,0, a.start_date,a.start_time,a.end_date,a.end_time,a.quantity,a.uom,a.customer,u.name as customer_name,a.line_status,w.contract,w.customer_ref,s.description as subject,
a.group_name,a.cost_center as basebranch,case when v.outsource = 1 then '13' else '12' end as ttype,a.type1,a.type2,a.type3,a.type4
, a.group_name+'-'+a.branch+'-00-'+case when v.outsource = 1 then '13' else '12' end+'-'+a.type1+'-'+a.type2+'-'+a.type3+'-'+a.type4+'-'+c.universal_location+'-'+cc.universal_location as barcode,
a.group_name_desc as group_name, a.type_1_desc as type1_desc, a.type_2_desc as type2_desc, a.type_3_desc as type3_desc,a.type_4_desc as type4_desc

,w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, w.client_inform_amarit_time, w.cs_inform_opr_date, w.cs_inform_opr_time, w.opr_inform_cs_date, w.opr_inform_cs_time, w.cs_inform_client_date, w.cs_inform_client_time

, a.specific_location_from, a.specific_location_to , a.diesel_rate, a.no_charge, 0, 0, a.cancel_reason, '', 0, 0, '', '', '', '', '', w.user_id, '' as position

, a.ref3, a.ref4, a.ref5, a.ref6, w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, v.vehicle_id_erp, v.outsource, vo.description, '', u.erp_id, 0, 0 as amount 

, w.close_date, w.close_time, w.rcvd_date, w.rcvd_time, w.send_date, w.send_time, a.charge_as as charge_as_name, a.outsource_charge_as as outsource_charge_as_name, o.staff_id, 0 as lumsum_charge,'' as promotion_code, a.create_date, a.modify_date, ct.erp_contract_no, a.erp_invoice_no, v.branch as branch, '' as reimbursment, 0 as q, 0 as round_trip, 0 as lump_sum, a.invoice          

,a.doc_no, a.invoice_amount, a.rv_no, a.posting_date, a.submit_date, a.rv_date, a.modify_by, '' as transport_solution
,w.print_date
from worksheet_taxi a 
left join contract_location c on c.location = a.transport_from
and c.customer = a.customer and c.contract_no = a.contract_no
left join location l on l.code = c.universal_location
left join contract_location cc on cc.location = a.transport_to
and cc.customer = a.customer and cc.contract_no = a.contract_no
left join location ll on ll.code = cc.universal_location
left join vehicle v on v.vehicle_id = a.vehicle
left join vehicle_owner vo on vo.code = v.vehicle_owner
left join operator o on o.operator_id = a.operator
left join customer u on u.customer_id = a.customer
left join worksheet w on w.worksheet_id = a.worksheet_id
left join subject s on s.code = w.subject
left join customer_contract ct on ct.contract_no = a.contract_no
WHERE w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date'

union

select '' as service_type, w.worksheet_id, w.worksheet_date, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '' as u_from, '' as u_to, 0, 0,0, '', '', '', '', 0, '',u.erp_id as customer,u.name as customer_name, '', w.contract, 
w.customer_ref, '' as subject, '', '', '', '', '', '', '', '' as barcode,
'' as group_name, '' as type1_desc, '' as type2_desc, '' as type3_desc, '' as type4_desc

, w.contract, w.remark, w.worksheet_status, w.request_method, w.request_to, w.client_inform_amarit_date, '', w.cs_inform_opr_date, '', w.opr_inform_cs_date, '', w.cs_inform_client_date, ''

, '', '', 0, 0, 0, 0, '', '', 0, 0, '', '', '', '', '', w.user_id, '' as position

, '', '', '', '', w.ref1 as wref1, w.ref2 as wref2, w.ref3 as wref3, w.ref4 as wref4, w.ref5 as wref5, w.ref6 as wref6

, '', '', '', '', u.erp_id, 0, 0 as amount

, w.close_date, w.close_time, w.rcvd_date, w.rcvd_time, w.send_date, w.send_time, '' as charge_as_name, '' as outsource_charge_as_name, '' as staff_id, 0 as lumsum_charge,'' as promotion_code, w.create_date, w.modify_date, '' as erp_contract_no, '-' as erp_invoice_no, '' as branch, '' as reimbursment, 0 as q, 0 as round_trip, 0 as lump_sum,0 as invoice  

,'' as doc_no, 0 as invoice_amount, '' as rv_no, '' as posting_date, '' as submit_date, '' as rv_date, '' as modify_by, '' as transport_solution
,w.print_date
from worksheet w 
left join customer u on u.customer_id = w.customer
where w.worksheet_id not in (
select worksheet_id from worksheet_cargo_handling union
select worksheet_id from worksheet_cargo_transport union
select worksheet_id from worksheet_immigration union
select worksheet_id from worksheet_service union
select worksheet_id from worksheet_taxi union
select worksheet_id from worksheet_manpower)
and w.worksheet_date >= '$from_date' AND w.worksheet_date <= '$to_date' ";


   
	$result = sqlsrv_query($conn, $fQuery);
	$x = 0;


	while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){

		if($row['print_date']!=""){
		
			

			$print_date = ($row['print_date'])->format('Y-m-d H:i:s');


			//echo '<pre>';
			//	print_r($row);
			//echo '</pre>';
			
		}
		else{
			$print_date = '-';
		}
		
		//$print_date = ($row['$print_date']==null?"":$row['$print_date']);
	
		
		$x = $x+1;
		if (is_null($row['mileage_end'])) {
			$tatalkm = 0;
		} else {
			$tatalkm = $row['mileage_end']- $row['mileage_start'];
		}
		if (is_null($row['start_time'])) {
			$start_time = '';
		} else {
			$start_time = date_format($row['start_time'],'H:i');
		}
		if (is_null($row['end_time'])) {
			$end_time = '';
		} else {
			$end_time = date_format($row['end_time'],'H:i');
		}
		if (is_null($row['client_inform_amarit_date'])) {
			$client_inform_amarit_date = '';
		} else {
			$client_inform_amarit_date = date_format($row['client_inform_amarit_date'],'d/m/Y');
		}
		if (is_null($row['client_inform_amarit_time'])) {
			$client_inform_amarit_time = '';
		} else {
			$client_inform_amarit_time = date_format($row['client_inform_amarit_time'],'H:i');
		}
		if (is_null($row['cs_inform_opr_date'])) {
			$cs_inform_opr_date = '';
		} else {
			$cs_inform_opr_date = date_format($row['cs_inform_opr_date'],'d/m/Y');
		}
		if (is_null($row['cs_inform_opr_time'])) {
			$cs_inform_opr_time = '';
		} else {
			$cs_inform_opr_time = date_format($row['cs_inform_opr_time'],'H:i');
		}
		if (is_null($row['opr_inform_cs_date'])) {
			$opr_inform_cs_date = '';
		} else {
			$opr_inform_cs_date = date_format($row['opr_inform_cs_date'],'d/m/Y');
		}
		if (is_null($row['opr_inform_cs_time'])) {
			$opr_inform_cs_time = '';
		} else {
			$opr_inform_cs_time = date_format($row['opr_inform_cs_time'],'H:i');
		}
		if (is_null($row['cs_inform_client_date'])) {
			$cs_inform_client_date = '';
		} else {
			$cs_inform_client_date = date_format($row['cs_inform_client_date'],'d/m/Y');
		}
		if (is_null($row['cs_inform_client_time'])) {
			$cs_inform_client_time = '';
		} else {
			$cs_inform_client_time = date_format($row['cs_inform_client_time'],'H:i');
		}
		if (is_null($row['actual_start_date'])) {
			$actual_start_date = '';
		} else {
			$actual_start_date = date_format($row['actual_start_date'],'d/m/Y');
		}
		if (is_null($row['actual_start_time'])) {
			$actual_start_time = '';
		} else {
			$actual_start_time = date_format($row['actual_start_time'],'H:i');
		}
		if (is_null($row['actual_finish_date'])) {
			$actual_finish_date = '';
		} else {
			$actual_finish_date = date_format($row['actual_finish_date'],'d/m/Y');
		}
		if (is_null($row['actual_finish_time'])) {
			$actual_finish_time = '';
		} else {
			$actual_finish_time = date_format($row['actual_finish_time'],'H:i');
		}
		if (is_null($row['start_date'])) {
			$start_date = '';
		} else {
			$start_date = date_format($row['start_date'],'d/m/Y');
		}
		if (is_null($row['end_date'])) {
			$end_date = '';
		} else {
			$end_date = date_format($row['end_date'],'d/m/Y');
		}

		if (is_null($row['close_date'])) {
			$close_date = '';
		} else {
			$close_date = date_format($row['close_date'],'d/m/Y');
		}
		if (is_null($row['close_time'])) {
			$close_time = '';
		} else {
			$close_time = date_format($row['close_time'],'H:i');
		}
		if (is_null($row['send_date'])) {
			$send_date = '';
		} else {
			$send_date = date_format($row['send_date'],'d/m/Y');
		}
		if (is_null($row['send_time'])) {
			$send_time = '';
		} else {
			$send_time = date_format($row['send_time'],'H:i');
		}
		if (is_null($row['rcvd_date'])) {
			$rcvd_date = '';
		} else {
			$rcvd_date = date_format($row['rcvd_date'],'d/m/Y');
		}
		if (is_null($row['rcvd_time'])) {
			$rcvd_time = '';
		} else {
			$rcvd_time = date_format($row['rcvd_time'],'H:i');
		}
		if (is_null($row['create_date'])) {
			$create_date = '';
		} else {
			$create_date = date_format($row['create_date'],'d/m/Y');
		}
		if (is_null($row['modify_date'])) {
			$modify_date = '';
		} else {
			$modify_date = date_format($row['modify_date'],'d/m/Y');
		}

		$total_km = 0;
		$qty_contract = '-';

		$outsource_reason = '';
		$GL = '';

		$customer = $row["customer"];
		$transport_from = $row["transport_from"];
		$transport_to = $row["transport_to"];
		$contract_no = $row["contract_no"];
		$position = $row["position"];
		$service = $row["specific_location_from"];
		$vehicle_type = $row["charge_as"];
		$UOM = $row["uom"];
		$Service_type = $row['service_type'];

		if (is_null($row['start_date'])) 
			$nameOfday = '';
		else 
			$nameOfday = date('D', strtotime(date_format($row['start_date'],'Y/m/d')));

		$amount = 0;

		$doc_no = $row['doc_no'];
		$invoice_amount = $row['invoice_amount'];
		$rv_no = $row['rv_no'];
		if (is_null($row['posting_date'])) 
			$invoice_date = '';
		else 
			$invoice_date = date_format($row['posting_date'],'d/m/Y');
		if (is_null($row['submit_date'])) 
			$submit_date = '';
		else 
			$submit_date = date_format($row['submit_date'],'d/m/Y');
		if ($submit_date == '01/01/1753')
			$submit_date = '';
		if (is_null($row['rv_date'])) 
			$rv_date = '';
		else 
			$rv_date = date_format($row['rv_date'],'d/m/Y'); 
		if ($rv_date == '01/01/1753')
			$rv_date = '';

		$transport_id = $row['transport_id'];

		//if ($row["erp_invoice_no"] == ''){
		//	$invoice_date = '';
		//	$doc_no = '';
		//	$invoice_amount = 0;
		//	$submit_date = '';
		//	$rv_no = '';
		//	$rv_date = '';
//
		//	$transport_id = $row['transport_id'];
		//	$doc_no = '';
		//	$invoice_amount = 0;
		//	$value = " where service_id = '$transport_id' order by reccode, doc_no desc ";
		//	$aaQuery = ' select * from invoice_data '.$value;
		//	//$resultamount = sqlsrv_query($connx, $aaQuery);
		//	$resultamount = sqlsrv_query($conn, $aaQuery);
		//	while($rowupdate = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
		//		if (($doc_no == '') or ($doc_no == $rowupdate['doc_no']))
		//			$doc_no = $rowupdate['doc_no'];
		//		else
		//			$doc_no = $doc_no .','.$rowupdate['doc_no'];
		//		//if (($invoice_amount == 0) or ($invoice_amount == $rowupdate['invoice_amount']))
		//		if ($invoice_amount == 0)
		//			$invoice_amount = $rowupdate['invoice_amount'];
		//		else 
		//			$invoice_amount = $invoice_amount+$rowupdate['invoice_amount'];
//
		//		//$rv_no = $rowupdate['rv_no'];
		//		if (($rv_no == '') or ($rv_no == $rowupdate['rv_no']))
		//			$rv_no = $rowupdate['rv_no'];
		//		else
		//			$rv_no = $rv_no .','.$rowupdate['rv_no'];
//
		//		if (is_null($rowupdate['posting_date'])) {
		//			$invoice_date = '';
		//		} else {
		//			$invoice_date = date_format($rowupdate['posting_date'],'d/m/Y');
		//		}
		//		if (is_null($rowupdate['submit_date'])) {
		//			$submit_date = '';
		//		} else {
		//			$submit_date = date_format($rowupdate['submit_date'],'d/m/Y');
		//		}
		//		if ($submit_date == '01/01/1753')
		//			$submit_date = '';
		//		if (is_null($rowupdate['rv_date'])) {
		//			$rv_date = '';
		//		} else {
		//			$rv_date = date_format($rowupdate['rv_date'],'d/m/Y'); 
		//		}
		//		if ($rv_date == '01/01/1753')
		//			$rv_date = '';
		//	}
			

		//}


	if ($row['service_type'] == 'TRANSPORT') {
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' order by diesel_baht_to ";// and a.uom = '$UOM' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411100';
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			if ($UOM == 'R/Tp' and $rowamount['round_trip_rate'] > 0)
				$amount = $rowamount['round_trip_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
				if ($row['diesel_rate'] < 31)
					$amount = $amount*1.02;
				else if ($row['diesel_rate'] < 32)
					$amount = $amount*1.04;
				else if ($row['diesel_rate'] < 33)
					$amount = $amount*1.06;
				else if ($row['diesel_rate'] < 34)
					$amount = $amount*1.08;
				else if ($row['diesel_rate'] < 35)
					$amount = $amount*1.10;
				else if ($row['diesel_rate'] < 36)
					$amount = $amount*1.12;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount*1.14;
				else if ($row['diesel_rate'] < 38)
					$amount = $amount*1.16;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount*1.18;
				else if ($row['diesel_rate'] < 40)
					$amount = $amount*1.20;
				else if ($row['diesel_rate'] < 41)
					$amount = $amount*1.22;

			}
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
		}
		if ($amount == 0) {
			$aQuery2 = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";// and a.uom = '$UOM' ";
			$resultamount2 = sqlsrv_query($conn, $aQuery2);
			$amount = 0;
			while($rowamount2 = sqlsrv_fetch_array( $resultamount2, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount2['transportation_rate'];
				if ($UOM == 'R/Tp' and $rowamount2['round_trip_rate'] > 0)
					$amount = $rowamount2['round_trip_rate'];
				$total_km = $rowamount2['total_km'];
				if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] and $rowamount2['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
						$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;
				}
				if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] and $rowamount2['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
			}
		}
		$diesel_rate = $row['diesel_rate'];
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";// and a.uom = '$UOM' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			if ($UOM == 'R/Tp' and $rowamount['round_trip_rate'] > 0)
					$amount = $rowamount['round_trip_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;
				}
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
		}
		$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km, a.round_trip_rate from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_to = '$transport_from' and a.transportation_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";// and a.uom = '$UOM' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transportation_rate'];
			if ($UOM == 'R/Tp' and $rowamount['round_trip_rate'] > 0)
					$amount = $rowamount['round_trip_rate'];
			$total_km = $rowamount['total_km'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;
				}
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
		}
		if ($row['transport_solution'] == 1){
			$aQuery = "select hourly_rate, daily_rate, minimum_charge_hour from contract_service_rate where contract_no = '$contract_no' and vehicle_type = '$vehicle_type' ";
			$resultamount = sqlsrv_query($conn, $aQuery);
			while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
				if ($UOM == 'Hour') {
					if ($row['quantity'] < $rowamount['minimum_charge_hour']){
						$amount = $rowamount['hourly_rate'];//*$rowamount['minimum_charge_hour'];
						$qty_contract = $rowamount['minimum_charge_hour'];
					} else
						$amount = $rowamount['hourly_rate'];
				} else {
					$amount = $rowamount['daily_rate'];
				}
			}
			$total_km = 0;
			$Service_type = 'TRANSPORT SOLUTION';
			$GL = '411110';
			
		}
		if ($row['lumsum_charge'] == 1){
			$aQuery = "select a.transportation_rate, a.diesel_baht_to, c.diesel1, a.total_km from contract_transportation_rate a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transportation_from = '$transport_from' and a.transportation_to = '$transport_to' and a.contract_no = '$contract_no' and a.transport_solution = 1 ";
			$resultamount = sqlsrv_query($conn, $aQuery);
			while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount['transportation_rate'];
			}
			$total_km = 0;
			//$Service_type = 'TRANSPORT SOLUTION';
			//$GL = '411110';
		}
		if ($row['promotion_code'] <> ''){
			$pro = $row['promotion_code'];
			$aQuery = "SELECT * FROM contract_promotion WHERE customer = '$customer' and contract_no = '$contract_no' and description = '$pro' ";
			$resultamount = sqlsrv_query($conn, $aQuery);
			while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
				$amount = $amount*($rowamount['discount']/100);
			}
			$total_km = 0;
			//$Service_type = 'TRANSPORT SOLUTION';
			//$GL = '411110';
		}
	} else if ($row['service_type'] == 'MANPOWER') {		
		$aQuery = "select normal, after_normal, s_normal, s_after_normal, minimum_charge, sunday, saturday, lamsum_charge_rate from contract_hourly_rate where customer = '$customer' and position = '$position' and contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411500';
		if (is_null($row['start_date'])) {
			$s_date = '';
		} else {
			$s_date = date_format($row['start_date'],'Y/m/d');
		}
		$nonwork = 0;
		$dQuery = " select * from contract_non_working_date where non_working_date = '$s_date' ";
		$resultnonwork = sqlsrv_query($conn, $dQuery);
		while($rownonwork = sqlsrv_fetch_array( $resultnonwork, SQLSRV_FETCH_ASSOC)){
			$nonwork = 1;
		}

		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			if ($row['lump_sum'] == 1){ 
				$amount = $rowamount['lamsum_charge_rate'];
			} else if (($nameOfday == 'Sun' and $rowamount['sunday'] == 0) or ($nameOfday == 'Sat' and $rowamount['saturday'] == 0)){
				if ($row['uom'] == 'Day'){
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '10:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00' or $start_time == '14:30' or $start_time == '14:00') {
						$amount = $rowamount['s_normal'];//*$rowamount['minimum_charge'];
						$qty_contract = $rowamount['minimum_charge'];
					} else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00' or $start_time == '18:00') {
						$amount = $rowamount['s_after_normal'];//*$rowamount['minimum_charge'];
						$qty_contract = $rowamount['minimum_charge'];
					}
				} else if ($row['uom'] == 'Hour'){
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '10:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00' or $start_time == '14:30' or $start_time == '14:00')
						$amount = $rowamount['s_normal'];
					else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00' or $start_time == '18:00')
						$amount = $rowamount['s_after_normal'];
				}
			} else if ($nonwork == 1){ 
				$amount = $rowamount['s_normal'];
			} else {
				if ($row['uom'] == 'Day') {
					$amount = $rowamount['normal'];//*$rowamount['minimum_charge'];
					$qty_contract = $rowamount['minimum_charge'];
				} else if ($row['uom'] == 'Hour') {
					if ($start_time == '08:00' or $start_time == '09:00' or $start_time == '10:00' or $start_time == '13:00' or ($start_time >= '07:30' and $start_time <= '13:00') or $start_time == '15:00' or $start_time == '16:00' or $start_time == '14:30' or $start_time == '14:00')
						$amount = $rowamount['normal'];
					else if ($start_time == '17:00' or $start_time == '06:00' or $start_time == '20:00' or $start_time == '01:00' or $start_time == '19:00' or $start_time == '18:00')
						$amount = $rowamount['after_normal'];
				}
			}
			$qty_contract = $rowamount['minimum_charge'];
		}
	} else if ($row['service_type'] == 'IMMIGRATION') {		
		$aQuery = "select unit_price from contract_immigration where customer = '$customer' and description = '$service' and contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		//$GL = '411810';
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['unit_price'];
		}
		if ($row['reimbursment'] == 1)
		  $GL = '119600';
		else
		  $GL = '411810';
	} else if ($row['service_type'] == 'PERSONNEL TRANSPORT') {
		$aQuery = "select a.transport_rate, c.diesel2, a.total_km, diesel_baht_to, diesel1 from contract_taxi_service a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transport_from = '$transport_from' and a.transport_to = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411820';
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
			$amount = $rowamount['transport_rate'];
			if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $rowamount['transport_rate']*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $rowamount['transport_rate']*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $rowamount['transport_rate']*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $rowamount['transport_rate']*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $rowamount['transport_rate']*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $rowamount['transport_rate']*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $rowamount['transport_rate']*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $rowamount['transport_rate']*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $rowamount['transport_rate']*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $rowamount['transport_rate']*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $rowamount['transport_rate']*1.22;
				}
		}
		if ($amount == 0) {
			$aQuery2 = "select a.transport_rate, c.diesel2, a.total_km, diesel_baht_to, diesel1 from contract_taxi_service a left join customer_contract c on c.contract_no = a.contract_no where a.customer = '$customer' and a.transport_to = '$transport_from' and a.transport_from = '$transport_to' and a.contract_no = '$contract_no' and a.vehicle_type = '$vehicle_type' ";
			$resultamount2 = sqlsrv_query($conn, $aQuery2);
			while($rowamount2 = sqlsrv_fetch_array( $resultamount2, SQLSRV_FETCH_ASSOC)){
				$amount = $rowamount2['transport_rate'];
				if ($row['diesel_rate'] > $rowamount2['diesel_baht_to'] and $rowamount2['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
					$amount = $rowamount2['transport_rate']*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $rowamount2['transport_rate']*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $rowamount2['transport_rate']*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $rowamount2['transport_rate']*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $rowamount2['transport_rate']*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $rowamount2['transport_rate']*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $rowamount2['transport_rate']*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $rowamount2['transport_rate']*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $rowamount2['transport_rate']*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $rowamount2['transport_rate']*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $rowamount2['transport_rate']*1.22;
				}
			}
		}
	} else if ($row['service_type'] == 'CARGO HANDLE') {		
		$aQuery = "select a.contract_no, contract_line, diesel_baht_from, diesel_baht_to, rate, minimum_charge_hour, c.diesel1, a.day_rate from contract_equipment_rental a left join customer_contract c on c.contract_no = a.contract_no WHERE a.customer = '$customer'  and equipment = '$vehicle_type' and branch = '$transport_from' and uom = '$UOM' and a.contract_no = '$contract_no' ";
		$resultamount = sqlsrv_query($conn, $aQuery);
		$amount = 0;
		$GL = '411400';
		while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){			
			if ($UOM == 'Hour') {
				if ($row['quantity'] < $rowamount['minimum_charge_hour'])
					$qty_contract = $rowamount['minimum_charge_hour'];
				
				if($rowamount['diesel_baht_from']<= $row['diesel_rate']  and  $row['diesel_rate'] <= $rowamount['diesel_baht_to'] )
				{
					$amount = $rowamount['rate'];
					
				}
				
				
				// $amount = $rowamount['rate'];


				// if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
				// 	if ($row['diesel_rate'] < 31)
				// 		$amount = $amount*1.02;
				// 	else if ($row['diesel_rate'] < 32)
				// 		$amount = $amount*1.04;
				// 	else if ($row['diesel_rate'] < 33)
				// 		$amount = $amount*1.06;
				// 	else if ($row['diesel_rate'] < 34)
				// 		$amount = $amount*1.08;
				// 	else if ($row['diesel_rate'] < 35)
				// 		$amount = $amount*1.10;
				// 	else if ($row['diesel_rate'] < 36)
				// 		$amount = $amount*1.12;
				// 	else if ($row['diesel_rate'] < 37)
				// 		$amount = $amount*1.14;
				// 	else if ($row['diesel_rate'] < 38)
				// 		$amount = $amount*1.16;
				// 	else if ($row['diesel_rate'] < 39)
				// 		$amount = $amount*1.18;
				// 	else if ($row['diesel_rate'] < 40)
				// 		$amount = $amount*1.20;
				// 	else if ($row['diesel_rate'] < 41)
				// 		$amount = $amount*1.22;

				// }
				// if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				// 	if ($row['diesel_rate'] < 35)
				// 		$amount = $amount *1.05;
				// 	else if ($row['diesel_rate'] < 37)
				// 		$amount = $amount *1.10;
				// 	else if ($row['diesel_rate'] < 39)
				// 		$amount = $amount *1.15;
				// }
				
			}
			if ($UOM == 'Day') {
				$amount = $rowamount['day_rate'];
				if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
					if ($row['diesel_rate'] < 31)
						$amount = $amount*1.02;
					else if ($row['diesel_rate'] < 32)
						$amount = $amount*1.04;
					else if ($row['diesel_rate'] < 33)
						$amount = $amount*1.06;
					else if ($row['diesel_rate'] < 34)
						$amount = $amount*1.08;
					else if ($row['diesel_rate'] < 35)
						$amount = $amount*1.10;
					else if ($row['diesel_rate'] < 36)
						$amount = $amount*1.12;
					else if ($row['diesel_rate'] < 37)
						$amount = $amount*1.14;
					else if ($row['diesel_rate'] < 38)
						$amount = $amount*1.16;
					else if ($row['diesel_rate'] < 39)
						$amount = $amount*1.18;
					else if ($row['diesel_rate'] < 40)
						$amount = $amount*1.20;
					else if ($row['diesel_rate'] < 41)
						$amount = $amount*1.22;

				}
				if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 33) {
				if ($row['diesel_rate'] < 35)
					$amount = $amount *1.05;
				else if ($row['diesel_rate'] < 37)
					$amount = $amount *1.10;
				else if ($row['diesel_rate'] < 39)
					$amount = $amount *1.15;
				}
			}
		}
		//$diesel_rate = $row['diesel_rate'];
		//$aQuery = "select a.contract_no, contract_line, diesel_baht_from, diesel_baht_to, rate, minimum_charge_hour, c.diesel1, a.day_rate from contract_equipment_rental a left join customer_contract c on c.contract_no = a.contract_no WHERE a.customer = '$customer'  and equipment = '$vehicle_type' and branch = '$transport_from' and uom = '$UOM' and a.contract_no = '$contract_no' and diesel_baht_from <= '$diesel_rate' and diesel_baht_to >= '$diesel_rate' ";// and a.uom = '$UOM' ";
		//$resultamount = sqlsrv_query($conn, $aQuery);
		//while($rowamount = sqlsrv_fetch_array( $resultamount, SQLSRV_FETCH_ASSOC)){
		//	$amount = $rowamount['rate'];
		//	if ($row['diesel_rate'] > $rowamount['diesel_baht_to'] and $rowamount['diesel1'] == 30) {
		//			if ($row['diesel_rate'] < 31)
		//			$amount = $amount*1.02;
		//			else if ($row['diesel_rate'] < 32)
		//				$amount = $amount*1.04;
		//			else if ($row['diesel_rate'] < 33)
		//				$amount = $amount*1.06;
		//			else if ($row['diesel_rate'] < 34)
		//				$amount = $amount*1.08;
		//			else if ($row['diesel_rate'] < 35)
		//				$amount = $amount*1.10;
		//			else if ($row['diesel_rate'] < 36)
		//				$amount = $amount*1.12;
		//			else if ($row['diesel_rate'] < 37)
		//				$amount = $amount*1.14;
		//			else if ($row['diesel_rate'] < 38)
		//				$amount = $amount*1.16;
		//			else if ($row['diesel_rate'] < 39)
		//				$amount = $amount*1.18;
		//			else if ($row['diesel_rate'] < 40)
		//				$amount = $amount*1.20;
		//			else if ($row['diesel_rate'] < 41)
		//				$amount = $amount*1.22;
		//		}
		//}

	} else if ($row['service_type'] == 'SERVICE - OTHER') {
		$amount = $row['amount'];
		if ($row['reimbursment'] == 1)
		  $GL = '119600';
		else
		  $GL = '411900';
	}
    

	if ($row['service_type'] == 'CARGO HANDLE' and $row['q'] >= $qty_contract)
		$qty_con = $row['quantity'];
	else
		$qty_con = $qty_contract;

	if ($qty_con > 0 and $qty_contract > $row['quantity'])
		$totalamount = $qty_con*$amount;
	else
		$totalamount = $row['quantity']*$amount;
	$diff = $totalamount - $invoice_amount;

	if ($show_amount != 1){
		$amount = 0;
		$totalamount = 0;
		$diff = 0;
		$invoice_amount = 0;
	}

	if ($row['no_charge'] == 0)
		$nocharge = 'No';
	else
		$nocharge = 'Yes';
	if ($row['consolidate'] == 0)
		$consolidate = 'No';
	else
		$consolidate = 'Yes';
	if ($row['vehicle_switch'] == 0)
		$vehicle_switch = 'No';
	else
		$vehicle_switch = 'Yes';
	if ($row['outsource'] == 0)
		$outsource = 'No';
	else
		$outsource = 'Yes';
	if ($row['standby_charge'] == 0)
		$standby_charge = 'No';
	else
		$standby_charge = 'Yes';

	if ($row['round_trip'] == 0)
		$round_trip = 'No';
	else
		$round_trip = 'Yes';	

	if ($row['erp_id'] == '')
		$erp_id = 'AAL';
	else
		$erp_id = $row['erp_id'];

	//if ($row['erp_id'] == 'C0084')
	//	$GL = '480001';
	//
	//SEM
	if ($row['erp_id'] == 'C0084'){
		if ($row['reimbursment'] == 1){
			$GL = '119600';
		}else{
			$GL = '480001';
		}
	}
	//SEM

	$vehicle_erp_id = $row['vehicle_id_erp'];
	
	if ($row['invoice'] == 1)
		$invoice = 'Yes';
	else
		$invoice = 'No';
	if ($row['lump_sum'] == 1)
		$lump_sum = 'Yes';
	else
		$lump_sum = 'No';
	if ($row['reimbursment'] == 1)
		$reimbursment = 'Yes';
	else
		$reimbursment = 'No';
	if ($row['transport_solution'] == 1)
		$transport_solution = 'Yes';
	else
		$transport_solution = 'No';
	if($row['description'] == '')
		$vendorname = 'AAL';
	else
		$vendorname = $row['description'];

		$output.='<tr>
					<td>'.$x.'</td>
					<td>'.$row['user_id'].'</td>
					<td>'.$row['basebranch'].'</td>
					<td>'.$client_inform_amarit_date.'</td>
					<td>'.$client_inform_amarit_time.'</td>
					<td>'.$row['worksheet_status'].'</td>
					<td>'.$row['line_status'].'</td>
					<td>'.$close_date.'</td>
					<td>'.$close_time.'</td>
					<td>'.$send_date.'</td>
					<td>'.$send_time.'</td>
					<td>'.$rcvd_date.'</td>
					<td>'.$rcvd_time.'</td>

					<td>'.$row['worksheet_id'].'</td>
					<td>'.date_format($row['worksheet_date'],'d/m/Y').'</td>
					<td>'.$Service_type .'</td>
					<td>'.$row['transport_id'].'</td>
					<td>'.$GL.'</td>
					<td>'.$erp_id.'</td>

					<td>'.$row['customer_name'].'</td>
					<td>'.$row['subject'].'</td>
					<td>'.$row['erp_contract_no'].'</td>
					<td>'.$row['contract_line'].'</td>
					<td>'.$row['customer_ref'].'</td>
					<td>'.$row['contract'].'</td>
					<td>'.$row['remark'].'</td>
					<td>'.$row['request_method'].'</td>
					<td>'.$row['request_to'].'</td>
					<td>'.$cs_inform_opr_date.'</td>
					<td>'.$cs_inform_opr_time.'</td>
					<td>'.$opr_inform_cs_date.'</td>
					<td>'.$opr_inform_cs_time.'</td>
					<td>'.$cs_inform_client_date.'</td>
					<td>'.$cs_inform_client_time.'</td>
					<td>'.$row['registration_no'].'</td>
					<td>'.$vehicle_erp_id.'</td>
					
					<td>'.$row['charge_as_name'].'</td>
					<td>'.$row['outsource_charge_as_name'].'</td>
					<td>'.$outsource.'</td>
					<td>'.$vendorname .'</td>
					<td>'.$row['staff_id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['basebranch'].'</td>
					<td>'.$row['position'].'</td>					
					<td>'.$row['transport_from'].'</td>
					<td>'.$row['transport_to'].'</td>
					<td>'.$row['specific_location_from'].'</td>
					<td>'.$row['specific_location_to'].'</td>

					<td>'.$row['contact1'].'</td>
					<td>'.$row['contact2'].'</td>
					
					<td>'.$row['remark'].'</td>
					<td>'.$row['ref1'].'</td>
					<td>'.$row['ref2'].'</td>
					<td>'.$row['department'].'</td>
					<td>'.$row['cost_center'].'</td>
					<td>'.$row['u_from'].'</td>
					<td>'.$row['u_to'].'</td>
					<td>'.$row['mileage_start'].'</td>
					<td>'.$row['mileage_end'].'</td>
					<td>'.$row['fuel_km_per_litre'].'</td>
					<td>'.$tatalkm.'</td>
					<td>'.$total_km.'</td>
					<td>'.$start_date.'</td>
					<td>'.$start_time.'</td>
                    <td>'.$end_date.'</td>
                    <td>'.$end_time.'</td>
					<td>'.$row['quantity'].'</td>
					<td>'.$qty_contract.'</td>
                    <td>'.$row['uom'].'</td>
					<td>'.$amount.'</td>
					<td>'.$totalamount.'</td>
					
					<td>'.$row['diesel_rate'].'</td>
					<td>'.$nocharge.'</td>
					<td>'.$consolidate.'</td>
					<td>'.$vehicle_switch.'</td>
					<td>'.$standby_charge.'</td>
					<td>'.$round_trip.'</td>
					<td>'.$row['cancel_reason'].'</td>
					<td>'.$outsource_reason.'</td>
					<td>'.$row['cargo_type'].'</td>
					<td>'.$row['cargo_qty'].'</td>
					<td>'.$row['cargo_weight'].'</td>
					<td>'.$row['dimension'].'</td>

					<td>'.$row['user_id'].'</td>
                    <td>'.$row['group_name'].'</td>
                    <td>'.$row['basebranch'].'</td>
                    <td>'.$row['ttype'].'</td>
                    <td>'.$row['type1'].'</td>
                    <td>'.$row['type2'].'</td>
					<td>'.$row['type3'].'</td>
					<td>'.$row['type4'].'</td>
					<td>'.$row['barcode'].'</td>
					
					<td>'.$row['type1_desc'].'</td>
                    <td>'.$row['type2_desc'].'</td>
					<td>'.$row['type3_desc'].'</td>
					<td>'.$row['type4_desc'].'</td>
					<td>'.$row['wref1'].'</td>
					<td>'.$row['wref2'].'</td>
					<td>'.$row['wref3'].'</td>
					<td>'.$row['wref4'].'</td>
					<td>'.$row['wref5'].'</td>
					<td>'.$row['wref6'].'</td>
					<td>'.$row['ref1'].'</td>
					<td>'.$row['ref2'].'</td>
					<td>'.$row['ref3'].'</td>
					<td>'.$row['ref4'].'</td>
					<td>'.$row['ref5'].'</td>
					<td>'.$row['ref6'].'</td>
					
					<td>'.$doc_no.'</td>
					<td>'.$invoice_date.'</td>					
					<td>'.$invoice_amount.'</td>
					<td>'.$diff.'</td>
					<td>'.$submit_date.'</td>
					<td>'.$rv_no.'</td>
					<td>'.$rv_date.'</td>
					<td>'.$invoice.'</td>
					<td>'.$lump_sum.'</td>
					<td>'.$reimbursment.'</td>
					<td>'.$transport_solution.'</td>

					<td>'.$create_date.'</td>
					<td>'.$modify_date.'</td>
					<td>'.$row['modify_by'].'</td>
					<td>'.$print_date.'</td>
                  </tr>';  
	}
	$output.= '</table>';
    //header("content-type: application/xls;charset=tis-620");
	header("Content-Type: application/vnd.ms-excel"); 
	//header("content-type: application/xls;charset=utf-8");
    header("content-disposition: attachment; filename=Worksheet status.xls");
	//header("Content-Type: application/vnd.ms-excel"); 
	//header('Content-Disposition: attachment; filename="sample.xls"');
    echo $output;       
}
?>