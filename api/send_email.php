<?php
require_once '../config_db.php';
require_once '../utils/helper.php';
require_once "../phpmailer/class.phpmailer.php";

//$user_name = $_GET['user_name'];
//$worksheet_id = $_GET['worksheet_id'];

//$fQuery = "SELECT  * FROM users WHERE user_name = '$user_name'";
//$result = sqlsrv_query($conn, $fQuery);
//$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

//-- Setup
//$host = "smtp.csloxinfo.com";//SMTP_HOST;
//$user = "frontend@amarit.co.th";//SMTP_USER;
//$pass = "Amaritfe@2022";//SMTP_PASS;
//$from = "frontend@amarit.co.th";//SMTP_FROM;
//$from_name = "frontend@amarit.co.th";//SMTP_FROM_NAME;
//$port = "25";//SMTP_PORT;

//$to = "pnitarn.t@gmail.com";//$row["email"];
//$subject = "Worksheet No. $worksheet_id Ready to transfer";
//$message = "Worksheet No. $worksheet_id Ready to transfer"; 

//$fm = "frontend@amarit.co.th"; 
//$to = "pnitarn.t@gmail.com"; 
//$subj = "Worksheet No. $worksheet_id Ready to transfer";
//$message = "Worksheet No. $worksheet_id Ready to transfer";
//$mesg = $message;
//$mail = new PHPMailer();

//$mail->CharSet = "utf-8"; 
//$mail->IsSMTP();
//$mail->Mailer = "smtp";
//$mail->SMTPAuth = true;
//$mail->Host = "smtp.csloxinfo.com"; 
//$mail->Port = "587"; 
//$mail->Username = "frontend@amarit.co.th"; 
//$mail->Password = "Amaritfe@2022"; 

//$mail->From = $fm;
//$mail->AddAddress($to);
//$mail->Subject = $subj;
//$mail->Body     = $mesg;
//$mail->WordWrap = 50;

//$mail->CharSet = "utf-8"; 
//$mail->SMTPDebug = 1;

//$mail->IsSMTP();
//$mail->Mailer = "smtp";
//$mail->SMTPAuth = true;

//$mail->SMTPSecure = "tls";
//$mail->Port = '25';  
//$mail->IsHTML(true);

//$mail->Host = $host;          
//$mail->Username = $user;
//$mail->Password = $pass;

//$mail->SetFrom($fm,$fm);
//$mail->AddAddress($to);
//$mail->Subject = $subject;
//$mail->Body = $message;
//$mail->WordWrap = 50;

$worksheet_id = $_GET['worksheet_id'];
$iquery = "SELECT *, a.remark as remark, b.name as customer_name from worksheet a join customer b on a.customer = b.customer_id join subject c on a.subject = c.code left join users u on u.user_name = a.user_id  WHERE worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
$worksheetcontact = $row["contract"];

// $fm = "frontend@amarit.co.th"; 
$fm = "auto-system@rich-th.com"; 
$to = 'siriwat.v@rich-th.com';
//$to = 'peerapol.k@rich-th.com';
//$to = $row["email"];
$subj = "Worksheet No. $worksheet_id";

$message = '<html><head><title></title>
<style>
#customers {
  font-family: Calibri, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers > thead > tr:nth-child(1) > td:nth-child(1){
// padding: 0px!important;
}


#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #228B22;
  color: white;
}

#manpower {
  font-family: Calibri, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#manpower td, #manpower th {
  border: 1px solid #ddd;
  padding: 8px;
}

#manpower tr:nth-child(even){background-color: #f2f2f2;}

#manpower tr:hover {background-color: #ddd;}

#manpower th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #228B22;
  color: white;
}
</style>
</head>
<body>
  <p></p>';


$iquery = "SELECT top 1 a.* from worksheet_manpower a WHERE worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery);
if(sqlsrv_has_rows($stmt)){
    $message.= '
<p style="margin-top:50px;">Manpower</p>
<table id="customers">
	<thead>';
}
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
$message.= '
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">No.</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Worker type</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Worker detail</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Work location</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" colspan="2">Started</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" colspan="2">Finished</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Charge as</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Client</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Service ID</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Status</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Remark</td>
	</tr>
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">time</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">time</td>
	</tr>';
}
$iquery = "SELECT a.*,b.name,b.lastname,b.company,c.description as location_desc, cu.name as customer_name, a.charge_as as position
    from worksheet_manpower a
    left join operator b on a.labor = b.operator_id 
    left join location c on a.location = c.code
	left join customer cu on a.customer = cu.customer_id
	left join position p on a.charge_as = p.code
    WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
$message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

	$message.= '<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$x.'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["position"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["name"].' '.$row["lastname"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["location"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["charge_as"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["customer_name"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["labor_service_id"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >Booked</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["remark"].'</td>    
	</tr>';
	$x++;
}
if(sqlsrv_has_rows($stmt)){
	$message.= '<tr><td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" colspan="13">'.'Worksheet No. : '.$worksheet_id.' |  Remark :'.'</td></tr>';
	$message.= '</tbody></table>';
}

// $iquery = "SELECT top 1 a.* from worksheet_cargo_handling a WHERE worksheet_id = '$worksheet_id'";
// $stmt = sqlsrv_query($conn, $iquery);

// while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
// $message.= '<br><table id="customers">
// 	<thead>
// 	<tr>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" rowspan="2">No.</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" >Worker type</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" >Worker detail</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" rowspan="2">Work location</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" colspan="2">Started</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" colspan="2">Finished</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" rowspan="2">Charge as</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" rowspan="2">Service ID</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" rowspan="2">Status</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;" rowspan="2">Remark</td>
// 	</tr>
// 	<tr>
// 	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;">Registration No.</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;">Name &amp; Contact No.</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;">date</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;">time</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;">date</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:green;color:#ffffff;">time</td>
// 	</tr>';
// }
//  $iquery = "SELECT a.*,b.registration_no,c.description as vtype_desc,d.description as vowner_desc,e.name+' '+e.lastname+' '+e.tel as operate_by,f.description as from_desc,g.description  as to_desc
//     from worksheet_cargo_handling a 
//     left join vehicle b on a.vehicle = b.vehicle_id 
//     left join vehicle_type c on b.vehicle_type = c.code 
//     left join vehicle_owner d on b.vehicle_owner = d.code 
//     left join operator e on a.operator = e.operator_id 
//     left join location f on a.transport_from = f.code 
//     left join location g on a.transport_to = g.code
//     WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
// $stmt = sqlsrv_query($conn, $iquery); 

// $x = 1;
// while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
// 	$worksheet_cargo_handling = 1;
// 	$message.= '<tr>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$x.'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["vtype_desc"].' '.$row["registration_no"].'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["operate_by"].'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["transport_from"].'</td>
// 	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_date"],"d-M-y").'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_time"],"H:i").'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_date"],"d-M-y").'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_time"],"H:i").'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["charge_as"].'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["cargo_service_id"].'</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >Booked</td>
//     <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["remark"].'</td>    
// 	</tr>';
// 	$x++;
// }
// if ($worksheet_cargo_handling == 1){
// 	$message.= '<tr><td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" colspan="13">'.'Worksheet No. : '.$worksheet_id.' |  Remark :'.'</td></tr>';
// 	$message.= '</thead></table>';
// }





$iquery = "SELECT top 1 a.* from worksheet_service a WHERE worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery);
if(sqlsrv_has_rows($stmt)){
    $message.= '
<p style="margin-top:50px;">Service - Other</p>
<table id="customers">
	<thead>';
}
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
$message.= '
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">No.</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Description</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Description 2</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Contact person</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" colspan="2">Started</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" colspan="2">Finished</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Remark</td>
	</tr>
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">time</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">time</td>
	</tr>';
}
$iquery = "SELECT a.*
    from worksheet_service a 
    WHERE a.worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

	$message.= '<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$x.'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["description"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["description2"].' '.$row["lastname"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["contact"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["remark"].'</td>    
	</tr>';
	$x++;
}


if(sqlsrv_has_rows($stmt)){
	
	$message.= '</tbody></table>';
}














$iquery = "SELECT top 1 a.*,b.description as service_name
    from worksheet_immigration a 
	left join contract_immigration b on a.service = b.contract_line
    WHERE a.worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery);

if(sqlsrv_has_rows($stmt)){
$message.= '
<p style="margin-top:50px;">Immigration</p>
<table id="customers">
	<thead>';
}
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){ 
	$worksheet_immigration = 1;
	$message.= '
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">No.</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Expat name</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Description</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Service</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" colspan="2">Started</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" colspan="2">Finished</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;" rowspan="2">Remark</td>
	</tr>
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">time</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:red;color:#ffffff;">time</td>
	</tr>';
}
if(sqlsrv_has_rows($stmt)){
$message.= '</thead><tbody>';
}
$iquery = "SELECT a.*,b.description as service_name
    from worksheet_immigration a 
	left join contract_immigration b on a.service = b.contract_line
    WHERE a.worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery); 

$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  
$message.= '<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$x.'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["expat_name"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["description"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["service"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["remark"].'</td>    
	</tr>';
	$x++;
}

if(sqlsrv_has_rows($stmt)){
$message.= '<tr><td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" colspan="13">'.'Worksheet No. : '.$worksheet_id.' |  Remark :'.'</td></tr>';
	$message.= '</tbody></table>';

}










$iquery = "SELECT top 1 a.* from worksheet_taxi a WHERE worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery);

if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">PERSONNEL TRANSPORT</p>
    <table id="customers">
        <thead>';
}


while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
$message.= '
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">No.</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">Vehicle</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">Driver</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">Client</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">Passenger details</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">Transport from</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">Transport to</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" colspan="2">Started</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" colspan="2">Finished</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;" rowspan="2">Remark</td>
	</tr>
	<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;">time</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;">date</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;background-color:#228B22;color:#ffffff;">time</td>
	</tr>';
}
if(sqlsrv_has_rows($stmt)){
$message.= '</thead><tbody>';
}
$iquery = "SELECT a.*,b.name,b.lastname,b.company, u.description as uom_desc, v.registration_no, c.name as customer_name, v.vehicle_type
	from worksheet_taxi a 
    left join operator b on a.operator = b.operator_id
	left join uom u on a.uom = u.code
	left join vehicle v on a.vehicle = v.vehicle_id
	left join customer c on a.customer = c.customer_id
    WHERE a.worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery); 

$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  
$message.= '<tr>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$x.'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["registration_no"].' '.$row["vehicle_type"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["name"].' '.$row["lastname"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["customer_name"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["contact"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["transport_from"].'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["transport_to"].'</td>
	<td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["start_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_date"],"d-M-y").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;">'.date_format($row["end_time"],"H:i").'</td>
    <td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" >'.$row["remark"].'</td>    
	</tr>

    ';
    
	$x++;
}

if(sqlsrv_has_rows($stmt)){
$message.= '<tr><td style="font-size:12px;font-family:Calibri;border-color:black;border-style:solid;border-width:1px;" colspan="13">'.'Worksheet No. : '.$worksheet_id.' |  Remark :'.'</td></tr>';
$message.= '</tbody></table>';
}












$iquery = "SELECT top 1 a.* from worksheet_warehousing_space_rental a WHERE worksheet_id = '$worksheet_id'";
$stmt = sqlsrv_query($conn, $iquery);

if(sqlsrv_has_rows($stmt)){
$message .= '   <p style="margin-top:50px;">Warehousing/Space Rental</p>
    <table id="customers" >
    <thead>';
}
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	$message.= '
 
    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Type</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Location</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;border-width:1px;background-color:#228B22;color:#ffffff;" width="100">Sub-Location</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="300">Description</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Started</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Finished</td>
    </tr>
   
    ';
    
}

$iquery = "
	SELECT  worksheet_warehousing_space_rental.warehousing_space_rental_id AS \"service_id\",
	barcode_service.type_service_name AS \"name\",
	barcode_location.location_name AS \"location\",
	barcode_sub_type4.sub_type4 ,
    barcode_product_type.product_type_name  AS \"type\",
    worksheet_warehousing_space_rental.fix_space ,
	worksheet_warehousing_space_rental.description,
	worksheet_warehousing_space_rental.start_date,
	worksheet_warehousing_space_rental.end_date,
	worksheet_warehousing_space_rental.contract_number,
	worksheet_warehousing_space_rental.qty,
	worksheet_warehousing_space_rental.uom,
	worksheet_warehousing_space_rental.ref1,
	worksheet_warehousing_space_rental.ref2,
	worksheet_warehousing_space_rental.ref3,
	worksheet_warehousing_space_rental.ref4,
	worksheet_warehousing_space_rental.ref5,
	worksheet_warehousing_space_rental.ref6 
FROM
	dbo.worksheet_warehousing_space_rental
	LEFT JOIN barcode_service ON barcode_service.no_service = worksheet_warehousing_space_rental.name
	LEFT JOIN barcode_location ON barcode_location.no_location = worksheet_warehousing_space_rental.location
	LEFT JOIN barcode_sub_type4 ON barcode_sub_type4.no_sub_type4 = worksheet_warehousing_space_rental.sub4 
	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type = worksheet_warehousing_space_rental.[type]
WHERE
	dbo.worksheet_warehousing_space_rental.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled'";

$stmt = sqlsrv_query($conn, $iquery); 

if(sqlsrv_has_rows($stmt)){
    $message .= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  
    $fixspace = "";
        if($row['fix_space'] == 1){
            $fixspace = "Yes";
            }else{
            $fixspace = "No";
            }
    $message.= '
        <tr>
            <td rowspan="6" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> '.$row['service_id'].'</td>
            <td rowspan="3" style="text-align:center;"> '.$row['type'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['location'].' </td>
            <td rowspan="3" style="text-align:center;">'.$row[''].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['description'].'</td>
            <td rowspan="3" style="text-align:center;word-wrap: break-word;">'.date('d/m/Y', strtotime($row['start_date'])).'</td>
            <td rowspan="3" style="text-align:center;">'.date('d/m/Y', strtotime($row['end_date'])).'</td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Fxied Space : '.$fixspace .'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['contract_number'].'</td>
            <td colspan="2" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['qty']." ".$row['uom'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="2"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="2"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>
    ';
    $x++;
}
if(sqlsrv_has_rows($stmt)){
$message.= '</tbody></table>';
}





$iquery = "SELECT TOP 1  worksheet_utilities.* FROM dbo.worksheet_utilities WHERE dbo.worksheet_utilities.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery);

if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">Utilities</p>
    <table id="customers" >
    <thead>
    ';
}
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	$message.= '
    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Type</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Location</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;border-width:1px;background-color:#228B22;color:#ffffff;" width="100">Sub-Location</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="300">Description</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Started</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Finished</td>
    </tr>
   ';
}

$iquery = "SELECT worksheet_utilities.utilities_id as \"service_id\",
	barcode_service.type_service_name AS \"name\",
    barcode_product_type.product_type_name  AS \"type\",
	barcode_location.location_name as \"location\",
	barcode_sub_type4.sub_type4 as \"sub_type4\",
	worksheet_utilities.description,
	worksheet_utilities.start_date,
	worksheet_utilities.end_date,
	worksheet_utilities.meter_record,
	worksheet_utilities.contract_number,
	worksheet_utilities.qty,
	worksheet_utilities.uom,
	worksheet_utilities.ref1,
	worksheet_utilities.ref2,
	worksheet_utilities.ref3,
	worksheet_utilities.ref4,
	worksheet_utilities.ref5,
	worksheet_utilities.ref6
	FROM
	dbo.worksheet_utilities 
	LEFT JOIN barcode_service on barcode_service.no_service = worksheet_utilities.type
	LEFT JOIN barcode_location on barcode_location.no_location = worksheet_utilities.location
	LEFT JOIN barcode_sub_type4 on barcode_sub_type4.no_sub_type4 = worksheet_utilities.type4
    LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type = worksheet_utilities.[type]
WHERE
	dbo.worksheet_utilities.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled'";
$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
 $message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

    $message.= '

        <tr>
            <td rowspan="6" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> '.$row['service_id'].'</td>
            <td rowspan="3" style="text-align:center;"> '.$row['type'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['location'].' </td>
            <td rowspan="3" style="text-align:center;">'.$row[''].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['description'].'</td>
            <td rowspan="3" style="text-align:center;word-wrap: break-word;">'.date('d/m/Y', strtotime($row['start_date'])).'</td>
            <td rowspan="3" style="text-align:center;">'.date('d/m/Y', strtotime($row['end_date'])).'</td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Meter record : '.$row['meter_record'].'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['contract_number'].'</td>
            <td colspan="2" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['qty']." ".$row['uom'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="2"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="2"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>
   
    ';
    $x++;
}
if(sqlsrv_has_rows($stmt)){
$message.= '</tbody></table>';
}











/////////////////////////////////////////// worksheet_rental ///////////////////////////////////////////


$iquery = "SELECT TOP 1  worksheet_rental.* FROM dbo.worksheet_rental WHERE dbo.worksheet_rental.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery);
if(sqlsrv_has_rows($stmt)){
$message.= '
    <p style="margin-top:50px;">Rental - Vehicle & heavy equipment</p>
    <table id="customers" >
    <thead>';
}
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	$message.= '
    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Vehicle/Equipment</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Type 1</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Type 2</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="300">Description</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Started</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Finished</td>
    </tr>
  ';
}

$iquery = "SELECT
	TOP 1 worksheet_rental.rental_id as \"service_id\",
	worksheet_rental.vehicle_equipment_id as \"type\",
	barcode_sub_type3.sub_type3 as \"sub_type3\",
	barcode_sub_type4.sub_type4 as \"sub_type4\",
	worksheet_rental.description,
	worksheet_rental.start_date,
	worksheet_rental.end_date,
	worksheet_rental.charge_as ,
	worksheet_rental.contract_number,
	worksheet_rental.qty,
	worksheet_rental.uom,
	worksheet_rental.ref1,
	worksheet_rental.ref2,
	worksheet_rental.ref3,
	worksheet_rental.ref4,
	worksheet_rental.ref5,
	worksheet_rental.ref6
FROM
	dbo.worksheet_rental
LEFT JOIN barcode_location on
	barcode_location.no_location = worksheet_rental.location
	LEFT JOIN barcode_sub_type3 on
	barcode_sub_type3.no_sub_type3 = worksheet_rental.sub3 
LEFT JOIN barcode_sub_type4 on
	barcode_sub_type4.no_sub_type4 = worksheet_rental.sub4 
WHERE
	dbo.worksheet_rental.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled'";

$stmt = sqlsrv_query($conn, $iquery); 

if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}

$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

    $message.= '

        <tr>
            <td rowspan="6" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> '.$row['service_id'].'</td>
            <td rowspan="3" style="text-align:center;"> '.$row['type'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['location'].' </td>
            <td rowspan="3" style="text-align:center;">'.$row[''].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['description'].'</td>
            <td rowspan="3" style="text-align:center;word-wrap: break-word;">'.date('d/m/Y', strtotime($row['start_date'])).'</td>
            <td rowspan="3" style="text-align:center;">'.date('d/m/Y', strtotime($row['end_date'])).'</td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Meter record : '.$row['meter_record'].'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['contract_number'].'</td>
            <td colspan="2" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['qty']." ".$row['uom'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="2"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="2"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>

    ';
    $x++;
}
if(sqlsrv_has_rows($stmt)){
    $message.= '</tbody></table>';
}

////////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////// worksheet_hotel_booking ///////////////////////////////////////////


$iquery = "SELECT TOP 1  worksheet_hotel_booking.* FROM dbo.worksheet_hotel_booking WHERE dbo.worksheet_hotel_booking.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery);
if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">Hotel Booking</p>
    <table id="customers">
        <thead>';
        }
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	$message.= '

    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Hotel Name</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Room Type</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Meat Incl</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Laundary Incl</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Description</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Check-in</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Check-out</td>
    </tr>
';
}

$iquery = "SELECT
	TOP 1 
	worksheet_hotel_booking.hotelbooking_id as \"service_id\",
	hotel.hotel_name,
	worksheet_hotel_booking.occupant,
	barcode_service.type_service_name as \"type\",
	worksheet_hotel_booking.meal_included ,
	worksheet_hotel_booking.laundry_included ,
	worksheet_hotel_booking.checkin_date as \"start_date\",
	worksheet_hotel_booking.checkout_date as \"end_date\",
	location.description AS \"location\",
	worksheet_hotel_booking.contract_number,
	worksheet_hotel_booking.qty,
	worksheet_hotel_booking.uom,
	worksheet_hotel_booking.ref1,
	worksheet_hotel_booking.ref2,
	worksheet_hotel_booking.ref3,
	worksheet_hotel_booking.ref4,
	worksheet_hotel_booking.ref5,
	worksheet_hotel_booking.ref6
FROM
	dbo.worksheet_hotel_booking
LEFT JOIN hotel ON
	hotel.hotel_id  = worksheet_hotel_booking.hotel_name 
LEFT JOIN barcode_service on barcode_service.no_service = worksheet_hotel_booking.type
LEFT JOIN location on location.code  = worksheet_hotel_booking.location 

WHERE
	dbo.worksheet_hotel_booking.worksheet_id = '$worksheet_id'
	AND \"status\" <> 'Cancelled'";

$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

    $message.= '

        <tr>
            <td rowspan="6" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> '.$row['service_id'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['hotel_name'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['occupant'].'</td>
            <td rowspan="3" style="text-align:center;">'.($row["meal_included"]==1?'Y':'N').'</td>
            <td rowspan="3" style="text-align:center;">'.($row["laundry_included"]==1?'Y':'N').'</td>
            <td rowspan="3" style="text-align:center;">'.($row["description"]==""?"":$row["description"]).'</td>
            <td rowspan="3" style="text-align:center;">'.date('d/m/Y', strtotime($row['start_date'])).'</td>
            <td rowspan="3" style="text-align:center;">'.date('d/m/Y', strtotime($row['end_date'])).'</td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Fixed Space : '.$row['meter_record'].'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['contract_number'].'</td>
            <td colspan="3" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['qty']." ".$row['uom'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="3"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="3"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>

    ';
    $x++;
}
if(sqlsrv_has_rows($stmt)){
    $message.= '</tbody></table>';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////








/////////////////////////////////////////// worksheet_ticket_booking_job ///////////////////////////////////////////


$iquery = "SELECT TOP 1  worksheet_ticket_booking_job.* FROM dbo.worksheet_ticket_booking_job WHERE dbo.worksheet_ticket_booking_job.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery);
if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">Booking - Ticket</p>
    <table id="customers">
        <thead>';
        }
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
	$message.= '

    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Guest</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Description</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Airline</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Flight Number</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Departure</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Destination</td>
    </tr>
';
}

$iquery = "
	SELECT worksheet_ticket_booking_job.ticketbooking_id AS \"service_id\",
	worksheet_ticket_booking_job.passenger,
	worksheet_ticket_booking_job.airline_name,
	worksheet_ticket_booking_job.description,
	worksheet_ticket_booking_job.flight_number,
	location.description AS \"departure_location\",
	barcode_product_type.product_type_name AS \"type\",
	worksheet_ticket_booking_job.departure_date AS \"start_date\",
	worksheet_ticket_booking_job.destination_date AS \"end_date\",
	location2.description AS \"destination_location\",
	worksheet_ticket_booking_job.contract_number,
	worksheet_ticket_booking_job.qty,
	worksheet_ticket_booking_job.uom,
	worksheet_ticket_booking_job.ref1,
	worksheet_ticket_booking_job.ref2,
	worksheet_ticket_booking_job.ref3,
	worksheet_ticket_booking_job.ref4,
	worksheet_ticket_booking_job.ref5,
	worksheet_ticket_booking_job.ref6 
FROM
	dbo.worksheet_ticket_booking_job
	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type = worksheet_ticket_booking_job.type
	LEFT JOIN location ON location.code = worksheet_ticket_booking_job.departure_location
	LEFT JOIN location location2 ON LTRIM(STR(CAST(location2.code AS INT))) = worksheet_ticket_booking_job.destination_location
WHERE
	dbo.worksheet_ticket_booking_job.worksheet_id = '".$worksheet_id."'
	AND 'status' <> 'Cancelled'
	
	";

$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

    $message.= '

        <tr>
            <td rowspan="6" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> '.$row['service_id'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['passenger'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['description'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['airline_name'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['flight_number'].'</td>
            <td rowspan="3" style="text-align:center;">'.($row["departure_location"]==""?"-":$row["departure_location"]).'<br>'.date("d-M-y", strtotime($row["start_date"])).'</td>
            <td rowspan="3" style="text-align:center;">'.($row["destination_location"]==""?"-":$row["destination_location"]).'<br>'.date("d-M-y", strtotime($row["end_date"])).'</td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Ticket Type : '.$row['type'].'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['contract_number'].'</td>
            <td colspan="3" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['qty']." ".$row['uom'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="3"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="3"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>
    ';
    $x++;
}

if(sqlsrv_has_rows($stmt)){
    $message.= '</tbody></table>';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////









/////////////////////////////////////////// worksheet_cargo_transport ///////////////////////////////////////////


 $iquery = "SELECT TOP 1  worksheet_cargo_transport.* FROM dbo.worksheet_cargo_transport WHERE dbo.worksheet_cargo_transport.worksheet_id = '$worksheet_id' and \"line_status\" <> 'Cancelled' ";
 $stmt = sqlsrv_query($conn, $iquery);
 if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">Transportation</p>
    <table id="customers">
        <thead>';
        }
 while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
     $message.= '
     <tr>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">License No.</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Company</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Operated By</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">From</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">To</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Started</td>
         <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Finished</td>
     </tr>

          ';
 }
 
 $iquery = "SELECT a.*,b.registration_no,c.description as vtype_desc,d.description as vowner_desc,e.name as operate_by,f.description as from_desc,g.description as to_desc, u.description as uom_desc, cc.erp_contract_no
     from worksheet_cargo_transport a
     left join vehicle b on a.vehicle = b.vehicle_id
     left join vehicle_type c on b.vehicle_type = c.code
     left join vehicle_owner d on b.vehicle_owner = d.code
     left join operator e on a.operator = e.operator_id
     left join location f on a.transport_from = f.code
     left join location g on a.transport_to = g.code
     left join uom u on a.uom = u.code
     left join customer_contract cc on a.contract_no = cc.contract_no
     WHERE worksheet_id = '$worksheet_id' AND no_charge = 0 and line_status <> 'Cancelled' ";

 $stmt = sqlsrv_query($conn, $iquery); 
 if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}
 $x = 1;
 while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  
 
     $message.= '

         <tr>
             <td rowspan="7" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
             <td rowspan="3" style="text-align:center;" height="100"> '.$row['transport_id'].'</td>
             <td rowspan="3" style="text-align:center;">'.$row['registration_no'].'</td>
             <td rowspan="3" style="text-align:center;">'.($row["vowner_desc"]=="AAL"?$row["vowner_desc"]:"AAL Other").'</td>
             <td rowspan="3" style="text-align:center;">'.$row['operate_by'].'</td>
             <td rowspan="3" style="text-align:center;">'.$row['specific_location_from'].'</td>
             <td rowspan="3" style="text-align:center;">'.$row['specific_location_to'].'</td>
             <td rowspan="3" style="text-align:center;">'.$row["start_date"]->format('d-M-y').'</td>
             <td rowspan="3" style="text-align:center;">'.$row["end_date"]->format('d-M-y').'</td>
         </tr>
         <tr></tr>
         <tr></tr>
 
         <tr>
             <td colspan="3" style="border:none !important;">Charge as : '.$row['charge_as'].'</td>
             <td colspan="2" style="border:none !important;">Contract Number : '.$row['erp_contract_no'].'</td>
             <td colspan="3" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['quantity']." ".$row['uom_desc'].'</td>
         </tr>

         <tr>
             <td colspan="3" style="border:none !important;">Remark : '.$row['remark'].'</td>
             <td colspan="5" style="border:none !important;">Diesel : '.$row['diesel_rate'].'</td>
         </tr>
 
 
         <tr > 
              <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
             <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
             <td colspan="3"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
         </tr>
          <tr style="border:none;">
             <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
             <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
             <td colspan="3"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
         </tr>

     ';
     $x++;
 }

 if(sqlsrv_has_rows($stmt)){
    $message.= '</tbody></table>';
}
 ////////////////////////////////////////////////////////////////////////////////////////////////////////











/////////////////////////////////////////// worksheet_cargo_handling ///////////////////////////////////////////


$iquery = "SELECT TOP 1  worksheet_cargo_handling.* FROM dbo.worksheet_cargo_handling WHERE dbo.worksheet_cargo_handling.worksheet_id = '$worksheet_id' and \"line_status\" <> 'Cancelled' ";
$stmt = sqlsrv_query($conn, $iquery);

if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">Cargo Handling</p>
    <table id="customers">
        <thead>';
        }

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
    $message.= '
 
    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Vehicle Type</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">License No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Company</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Operated By</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Operated at</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Started</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Finished</td>
    </tr>
    </thead>
    <tbody>
    '
    ;
}

$iquery = "SELECT a.*,b.registration_no,c.description as vtype_desc,d.description as vowner_desc,e.name as operate_by,f.description as from_desc,g.description as to_desc, u.description as uom_desc, cc.erp_contract_no
   from worksheet_cargo_handling a
   left join vehicle b on a.vehicle = b.vehicle_id
   left join vehicle_type c on b.vehicle_type = c.code
   left join vehicle_owner d on b.vehicle_owner = d.code
   left join operator e on a.operator = e.operator_id
   left join location f on a.transport_from = f.code
   left join location g on a.transport_to = g.code
   left join uom u on a.uom = u.code
   left join customer_contract cc on a.contract_no = cc.contract_no
   WHERE worksheet_id = '$worksheet_id' and line_status <> 'Cancelled' and (no_charge = 0 or no_charge is null) ";
   $stmt = sqlsrv_query($conn, $iquery);

$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

    $message.= '

        <tr>
            <td rowspan="7" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> '.$row['cargo_service_id'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['vtype_desc'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['registration_no'].'</td>
            <td rowspan="3" style="text-align:center;">'.($row["vowner_desc"]=="AAL"?$row["vowner_desc"]:"AAL Other").'</td>
            <td rowspan="3" style="text-align:center;">'.$row['operate_by'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row['transport_from'].'</td>
            <td rowspan="3" style="text-align:center;">'.$row["start_date"]->format('d-M-y').'<br>'.date_format($row["start_time"],"H:i").'</td>
            <td rowspan="3" style="text-align:center;">'.$row["end_date"]->format('d-M-y').'<br>'.date_format($row["end_time"],"H:i").'</td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Charge as : '.$row['charge_as'].'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['erp_contract_no'].'</td>
            <td colspan="3" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['quantity']." ".$row['uom_desc'].'</td>
        </tr>

        <tr>
            <td colspan="3" style="border:none !important;">Remark : '.$row['remark'].'</td>
            <td colspan="5" style="border:none !important;">Diesel : '.$row['diesel_rate'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="3"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="3"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>

    ';
    $x++;
}

if(sqlsrv_has_rows($stmt)){
    $message.= '</tbody></table>';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////














/////////////////////////////////////////// worksheet_customer_clearance_cargo ///////////////////////////////////////////


$iquery = "SELECT TOP
	1  worksheet_customer_clearance_cargo.* 
FROM
	dbo.worksheet_customer_clearance_cargo 
WHERE
	dbo.worksheet_customer_clearance_cargo.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and charge <> 1";
$stmt = sqlsrv_query($conn, $iquery);

if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">Clearance Cargo</p>
    <table id="customers">
        <thead>';
        }

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
    $message.= '
 
    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Vehicle Type</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">License No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Company</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Operated By</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Operated at</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Started</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Finished</td>
    </tr>
    </thead>
    <tbody>
    '
    ;
}


$iquery = '

	SELECT TOP
	1 worksheet_customer_clearance_cargo.customerclearancecargo_id as "service_id",
	barcode_service.type_service_name as "name",
	barcode_location.location_name as "location",
	barcode_product_type.product_type_name  AS "type",
	worksheet_customer_clearance_cargo.description,
	\'\' AS "start_date",
	\'\' AS "end_date",
	worksheet_customer_clearance_cargo.contract_number,
	worksheet_customer_clearance_cargo.qty,
	worksheet_customer_clearance_cargo.uom,
	worksheet_customer_clearance_cargo.ref1,
	worksheet_customer_clearance_cargo.ref2,
	worksheet_customer_clearance_cargo.ref3,
	worksheet_customer_clearance_cargo.ref4,
	worksheet_customer_clearance_cargo.ref5,
	worksheet_customer_clearance_cargo.ref6
	FROM
	dbo.worksheet_customer_clearance_cargo 
	LEFT JOIN barcode_service on barcode_service.no_service = worksheet_customer_clearance_cargo.type
	LEFT JOIN barcode_location on barcode_location.no_location = worksheet_customer_clearance_cargo.location

	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type =  worksheet_customer_clearance_cargo.[type]
WHERE
	dbo.worksheet_customer_clearance_cargo.worksheet_id = \''.$worksheet_id.'\'
	AND "status" <> \'Cancelled\' and charge <> 1

';
	

   $stmt = sqlsrv_query($conn, $iquery);

$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

    $message.= '

        <tr>
            <td rowspan="7" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> </td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Charge as : '.$row['charge_as'].'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['erp_contract_no'].'</td>
            <td colspan="3" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['quantity']." ".$row['uom_desc'].'</td>
        </tr>

        <tr>
            <td colspan="3" style="border:none !important;">Remark : '.$row['remark'].'</td>
            <td colspan="5" style="border:none !important;">Diesel : '.$row['diesel_rate'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="3"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="3"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>

    ';
    $x++;
}

if(sqlsrv_has_rows($stmt)){
    $message.= '</tbody></table>';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////









/////////////////////////////////////////// worksheet_customer_clearance_vessel ///////////////////////////////////////////


$iquery = "SELECT TOP
	1  worksheet_customer_clearance_vessel.* 
FROM
	dbo.worksheet_customer_clearance_vessel 
WHERE
	dbo.worksheet_customer_clearance_vessel.worksheet_id = '$worksheet_id' and \"status\" <> 'Cancelled' and charge <> 1";
$stmt = sqlsrv_query($conn, $iquery);

if(sqlsrv_has_rows($stmt)){
    $message.= '
    <p style="margin-top:50px;">Clearance Vessel</p>
    <table id="customers">
        <thead>';
        }

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
    $message.= '
 
    <tr>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border-bottom:none !important;background-color:#228B22;color:#ffffff;border: 1px solid black;" width="10">No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Service ID</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Vehicle Type</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">License No.</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Company</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Operated By</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="100">Operated at</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Started</td>
        <td style="text-align:center;font-size:12px;font-family:Calibri;border: 1px solid black;background-color:#228B22;color:#ffffff;" width="80">Finished</td>
    </tr>
    </thead>
    <tbody>
    '
    ;
}



$iquery = '

	SELECT TOP
	1 worksheet_customer_clearance_vessel.customerclearancevessel_id as "service_id",
	barcode_service.type_service_name as "name",
	worksheet_customer_clearance_vessel.vessel_name,
	worksheet_customer_clearance_vessel.vessel_weight,
	worksheet_customer_clearance_vessel.vessel_length,
	worksheet_customer_clearance_vessel.vessel_draft,
	
	worksheet_customer_clearance_vessel.clearance_port,
	worksheet_customer_clearance_vessel.description,
	
	worksheet_customer_clearance_vessel.startdate,
	worksheet_customer_clearance_vessel.finishdate,
	
	barcode_product_type.product_type_name  AS "type",

	worksheet_customer_clearance_vessel.contract_number,
	worksheet_customer_clearance_vessel.qty,
	worksheet_customer_clearance_vessel.uom,
	worksheet_customer_clearance_vessel.ref1,
	worksheet_customer_clearance_vessel.ref2,
	worksheet_customer_clearance_vessel.ref3,
	worksheet_customer_clearance_vessel.ref4,
	worksheet_customer_clearance_vessel.ref5,
	worksheet_customer_clearance_vessel.ref6
	FROM
	dbo.worksheet_customer_clearance_vessel 
	LEFT JOIN barcode_service on barcode_service.no_service = worksheet_customer_clearance_vessel.type
	LEFT JOIN barcode_location on barcode_location.no_location = worksheet_customer_clearance_vessel.location

	LEFT JOIN barcode_product_type ON barcode_product_type.no_product_type =  worksheet_customer_clearance_vessel.[type]
WHERE
	dbo.worksheet_customer_clearance_vessel.worksheet_id = \''.$worksheet_id.'\'
	AND "status" <> \'Cancelled\' and charge <> 1

';
	

   $stmt = sqlsrv_query($conn, $iquery);

$stmt = sqlsrv_query($conn, $iquery); 
if(sqlsrv_has_rows($stmt)){
    $message.= '</thead><tbody>';
}
$x = 1;
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){  

    $message.= '

        <tr>
            <td rowspan="7" style="text-align:center;border-top:none;background-color:#228B22;color:#ffffff;">'.$x.'</td>
            <td rowspan="3" style="text-align:center;" height="100"> </td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
            <td rowspan="3" style="text-align:center;"></td>
        </tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td colspan="3" style="border:none !important;">Charge as : '.$row['charge_as'].'</td>
            <td colspan="2" style="border:none !important;">Contract Number : '.$row['erp_contract_no'].'</td>
            <td colspan="3" style="border:none !important; border-right:1px solid #ddd!important;"> | &nbsp; '.$row['quantity']." ".$row['uom_desc'].'</td>
        </tr>

        <tr>
            <td colspan="3" style="border:none !important;">Remark : '.$row['remark'].'</td>
            <td colspan="5" style="border:none !important;">Diesel : '.$row['diesel_rate'].'</td>
        </tr>


        <tr > 
             <td colspan="3"  style="border:none !important;">Remark 1 '.$row['ref1'].'</td>
            <td colspan="2"  style="border:none !important;">Remark 3 '.$row['ref3'].'</td>
            <td colspan="3"  style="border:none !important; border-right:1px solid #ddd!important;">Remark 5 '.$row['ref5'].'</td>
        </tr>
         <tr style="border:none;">
            <td colspan="3"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 2 '.$row['ref2'].'</td>
            <td colspan="2"  style="border:none !important;border-bottom:1px solid #ddd !important;">Remark 4 '.$row['ref4'].'</td>
            <td colspan="3"  style="border-left:none !important;border-top:none !important;">Remark 6 '.$row['ref6'].'</td>
        </tr>

    ';
    $x++;
}

if(sqlsrv_has_rows($stmt)){
    $message.= '</tbody></table>';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////










$message.= '</body></html>';

$mesg = $message;

// header('Content-Type: text/html');
// echo $mesg;
// die();

$mail = new PHPMailer();
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->Mailer = "smtp";                                
// $mail->Host = "smtp.csloxinfo.com";      
$mail->Host = "smtp.gmail.com";      
// $mail->Port = 25;
$mail->Port = 587;
$mail->IsHTML(true);
// $mail->Username = "frontend@amarit.co.th";  
$mail->Username = "auto-system@rich-th.com";  
// $mail->Password = "Amaritfe@2022";    
$mail->Password = "dxeyseogtgadbgiu";    
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'tls';
$mail->SetFrom($fm,$fm);
$mail->AddAddress($to);
$mail->Subject = $subj;
$mail->Body     = $mesg;
$mail->WordWrap = 50;  

if(!$mail->Send()) {
    $Data["Status"] = "Error";
    $Data["msg"] = "Unable to send email. Please try again.";
} else {
	$Data["Status"] = "Success";
    $Data["msg"] = "Your mail has been sent successfully.";
}
 
echo json_encode($Data);
sqlsrv_close($conn);
?>