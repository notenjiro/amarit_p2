<?php
if (isset($_GET["type"])) {

    require_once '../config_db.php';

    $data = Array();

    $type = $_GET["type"];
    $module_name = array('branch','group_name','type','type_1','type_2','type_3','type_4','type_5','calendar_public_holiday','cancellation_reason','contract_location_master','customer','day_type','diesel_rates','operator','vehicle','location','outsource_reason','sub_location','subject','uom','vehicle_brand','vehicle_owner','vehicle_type');
    
    

    if (in_array($type, $module_name)) {

        
        
        if($type == 'contract_location_master'){
            $fQuery = "SELECT a.reccode, a.location, a.universal_location, a.sub_location, a.active, a.new_location_name, a.old_location_name, b.reccode as 'postcode_id', a.post_code, b.place, b.district1 FROM contract_location_master a LEFT OUTER JOIN post_code b ON b.post_code = a.post_code WHERE active = 1";
        }
        else if($type == 'operator'){
            $fQuery = "SELECT o.*, p.code AS position_code, p.description AS position_name, c.code AS branch_code, c.description AS branch_name FROM operator o LEFT JOIN POSITION p ON p.code = o.position LEFT JOIN location c ON o.branch = c.code";
        }
        else{
            $fQuery = "SELECT  * FROM ".$type;
        }

        $result = sqlsrv_query($conn, $fQuery);

        if($type == 'calendar_public_holiday'){
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                if ($row['non_working_date'] instanceof DateTime) {
                    $row['non_working_date'] = $row['non_working_date']->format('Y-m-d');
                }
                $data[] = $row;
            }
        }
        if($type == 'diesel_rates'){
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                if ($row['diesel_rate_date'] instanceof DateTime) {
                    $row['diesel_rate_date'] = $row['diesel_rate_date']->format('Y-m-d');
                }
                $data[] = $row;
            }
        }
        else if($type == 'operator'){
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                if ($row['start_time'] instanceof DateTime) {
                    $row['start_time'] = $row['start_time']->format('H:i:s');
                }
                if ($row['end_time'] instanceof DateTime) {
                    $row['end_time'] = $row['end_time']->format('H:i:s');
                }
                $data[] = $row;
            }
        }
        else{

            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                $data[] = $row;
            }
        }


        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="'.$_GET["type"].'.csv"');
        $output = fopen('php://output', 'w');

        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        fclose($output);

    }

}
?>