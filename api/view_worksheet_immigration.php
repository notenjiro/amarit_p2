<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$worksheet_id = $_GET['worksheet_id'];

$fQuery = "SELECT  a.*,bs1.sub_type1 as tsub1,bs2.sub_type2 as tsub2,bs3.sub_type3 as tsub3,bs4.sub_type4 as tsub4,bs5.sub_type5 as tsub5,bs6.sub_type6 as tsub6 FROM worksheet_immigration a
left join barcode_sub_type1 bs1 on a.type1 = bs1.no_sub_type1
left join barcode_sub_type2 bs2 on a.type2 = bs2.no_sub_type2
left join barcode_sub_type3 bs3 on a.type3 = bs3.no_sub_type3
left join barcode_sub_type4 bs4 on a.type4 = bs4.no_sub_type4
left join barcode_sub_type5 bs5 on a.type5 = bs5.no_sub_type5
left join barcode_sub_type6 bs6 on a.type6 = bs6.no_sub_type6
 WHERE a.worksheet_id = '$worksheet_id'";
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data = [$row['reccode'], $row['immigration_id'], date_format($row['start_date'],'d/m/Y'), date_format($row['start_time'],'H:i'), $row['quantity'],$row['uom'], $row['remark'], $row['line_status'],
    $row['tsub1'],$row['tsub2'],$row['tsub3'],$row['tsub4'],$row['tsub5'] ,$row['tsub6'],$row['ref1'], $row['ref2'], $row['ref3'], $row['ref4'], $row['ref5'], $row['ref6'],$row['type1'],$row['type2'],$row['type3'],$row['type4'],$row['type5'] ,$row['type6']];
    array_push($raw['data'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>