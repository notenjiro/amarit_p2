<?php
error_reporting(0);
require_once '../config_db.php';
require_once '../utils/helper.php';

$contract_no = $_GET['contract_no'];
$customer = $_GET['customer'];
$vehicle_type = $_POST['vehicle_type1'];
$diesel_baht_from = $_POST['diesel_baht_from'];
$diesel_baht_to = $_POST['diesel_baht_to'];
$transportation_rate = $_POST['transportation_rate'];
$transportation_from = $_POST['transportation_from'];
$transportation_to = $_POST['transportation_to'];
$backhual = isset($_POST['backhual'])?$_POST['backhual']:false;
$total_km = $_POST['total_km'];
$transport_solution = isset($_POST['transport_solution1'])?$_POST['transport_solution1']:false;
$contract_line = $_POST['contract_line1'];
$uom = $_POST['transportation_uom'];
$category = $_POST['transport_category'];
$round_trip_rate = $_POST['transportation_round_trip_rate'];
$sub1 = $_POST['sub1'];
$sub2 = $_POST['sub2'];
$sub3 = $_POST['sub3'];
$sub4 = $_POST['sub4'];
$sub5 = $_POST['sub5'];
$sub6 = $_POST['sub6'];
$name= $_POST['name'];
$branch = $_POST['branch'];
$location = $_POST['location'];




$iquery = "INSERT INTO contract_transportation_rate (contract_no, customer, vehicle_type, diesel_baht_from, diesel_baht_to, transportation_rate, transportation_from, transportation_to, backhual, total_km, transport_solution, contract_line, uom, category, round_trip_rate,sub1,sub2,sub3,sub4,sub5,sub6,name,branch,location) VALUES ('$contract_no', '$customer', '$vehicle_type', '$diesel_baht_from', '$diesel_baht_to', '$transportation_rate', '$transportation_from', '$transportation_to', '$backhual', '$total_km', '$transport_solution', '$contract_line', '$uom', '$category', '$round_trip_rate','$sub1','$sub2','$sub3','$sub4','$sub5','$sub6','$name','$branch','$location')";
$stmt = sqlsrv_query($conn, $iquery);

if($stmt === false){
    $Data["Status"] = "Error";
    $Data["msg"] = $iquery;//"มีข้อมูลซ้ำกับที่มีอยู่แล้ว";
    $Data["query"] = $iquery;
}else{
    $Data["Status"] = "Success";
    $Data["msg"] = "Data has been updated";
}

echo json_encode($Data);

sqlsrv_close($conn);

?>