<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$user_role = $_GET["user_role"];
$user_name = $_GET["user_name"];
$type = $_GET["type"];

if ($type == 'Admin') {
    $fQuery = "SELECT  
    a.reccode, 
    a.worksheet_id as id, 
    a.worksheet_status as status, 
    a.printed, 
    a.branch, 
    a.worksheet_date as date, 
    a.contract, 
    a.customer_ref, 
    a.reccode as code, 
    b.name as customer_name, 
    c.description as subject_name 
FROM worksheet a 
LEFT JOIN customer b ON b.customer_id = a.customer 
LEFT JOIN subject c ON c.code = a.subject

UNION ALL

SELECT  
    a.reccode, 
    a.job_id as id, 
    a.job_status as status, 
    a.printed, 
    a.branch, 
    a.job_date as date, 
    a.contract, 
    a.customer_ref, 
    a.reccode as code, 
    b.name as customer_name, 
    c.description as subject_name 
FROM job a 
LEFT JOIN customer b ON b.customer_id = a.customer 
LEFT JOIN subject c ON c.code = a.subject";

} elseif ($type == 'AAL') {
    $fQuery = "SELECT  a.reccode, a.worksheet_id as id, a.worksheet_status as status, a.printed, a.branch, 
    a.worksheet_date as date, a.contract, a.customer_ref, a.reccode as code, b.name as customer_name, 
    c.description as subject_name 
    FROM worksheet a left join customer b on b.customer_id = a.customer 
    left join subject c on c.code = a.subject";
} elseif ($type == 'AA') {
    $fQuery = "SELECT  a.reccode, a.job_id as id, a.job_status as status , a.printed, a.branch, 
    a.job_date as date, a.contract, a.customer_ref, a.reccode as code, b.name as customer_name, 
    c.description as subject_name 
    FROM job a left join customer b on b.customer_id = a.customer 
    left join subject c on c.code = a.subject";
}

//if($user_role != 'supervisor'){
//    $fQuery .= " WHERE user_id = '$user_name'";
//}
$result = sqlsrv_query($conn, $fQuery);
$raw['data'] = array();
$logFileName = 'fetch_log.txt';
$logFile = fopen($logFileName, 'a');

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $data = [$row['reccode'], "", $row['id'], $row['status'], $row['printed'], $row['branch'], date_format($row['date'], 'd/m/Y'), $row['subject_name'], $row['customer_name'], $row['contract'], $row['customer_ref'], $row['code']];
    array_push($raw['data'], $data);
    fwrite($logFile, "Row data: " . print_r($data, true) . "\n");
}
fclose($logFile);
echo json_encode($raw);
sqlsrv_close($conn);
?>