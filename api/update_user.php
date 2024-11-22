<?php
error_reporting(1);
require_once '../config_db.php';
require_once '../utils/helper.php';

$user_name = $_POST['user_name'];
$password = $_POST['password'];
$name = $_POST['name'];
$user_role = $_POST['user_role'];
$email = $_POST['email'];
$reopen = isset($_POST['reopen'])?$_POST['reopen']:false;
$show_price = isset($_POST['show_price'])?$_POST['show_price']:false;
$manager_name = $_POST['manager_name'];
$print_worksheet = isset($_POST['print_worksheet'])?$_POST['print_worksheet']:false;
// add
$user_type = isset($_POST['user_type'])?$_POST['user_type']:false;

$iquery = "UPDATE users SET name = '$name', password = '$password', user_role = '$user_role', email = '$email', reopen = '$reopen', show_price = '$show_price', manager_name = '$manager_name', print_worksheet = '$print_worksheet', user_type = '$user_type' WHERE user_name = '$user_name'";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = "มีบางอย่างผิดพลาด";
}else{
    $iquery = "DELETE FROM user_permission WHERE user_name = '$user_name'";
    $stmt = sqlsrv_query($conn, $iquery);

    $fQuery = "SELECT * FROM user_menu";
    $result = sqlsrv_query($conn, $fQuery);
    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
        $menu_access = 'check_access_'.$row['menu_id'];
        $menu_add = 'check_add_'.$row['menu_id'];
        $menu_edit = 'check_edit_'.$row['menu_id'];
        $menu_delete = 'check_delete_'.$row['menu_id'];
        $menu_id = $row['menu_id'];
        $is_access = (isset($_POST[$menu_access]) && $_POST[$menu_access] == $row['menu_id'])?1:0;
        $is_add = (isset($_POST[$menu_add]) && $_POST[$menu_add] == $row['menu_id'])?1:0;
        $is_edit = (isset($_POST[$menu_edit]) && $_POST[$menu_edit] == $row['menu_id'])?1:0;
        $is_delete = (isset($_POST[$menu_delete]) && $_POST[$menu_delete] == $row['menu_id'])?1:0;
        $iquery = "INSERT INTO user_permission (user_name, menu_id, access, is_add, is_edit, is_delete) VALUES ('$user_name', $menu_id , $is_access, $is_add, $is_edit, $is_delete)";

        $stmt = sqlsrv_query($conn, $iquery);
    }
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}


echo json_encode($Data);

sqlsrv_close($conn);

?>