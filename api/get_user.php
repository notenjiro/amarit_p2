<?php
require_once '../config_db.php';
require_once '../utils/helper.php';

$user_name = $_GET['user_name'];

$fQuery = "SELECT  * FROM users WHERE user_name = '$user_name'";

$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
$raw['user_name'] = $row['user_name'];
$raw['name'] = $row['name'];
$raw['password'] = $row['password'];
$raw['reopen'] = $row['reopen'];
$raw['show_price'] = $row['show_price'];
$raw['print_worksheet'] = $row['print_worksheet'];
$raw['email'] = $row['email'];
$raw['manager_name'] = $row['manager_name'];
// add
$raw['user_type'] = $row['user_type'];
$raw['user_role'] = $row['user_role'];
$raw['user_menu'] = array();
$fQuery = "SELECT * FROM user_permission WHERE user_name = '$user_name'";
$result = sqlsrv_query($conn, $fQuery);
while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $data['id'] = $row['menu_id'];
    $data['access'] = $row['access'];
    $data['add'] = $row['is_add'];
    $data['edit'] = $row['is_edit'];
    $data['delete'] = $row['is_delete'];
    array_push($raw['user_menu'],$data);
}

echo json_encode($raw);
sqlsrv_close($conn);
?>