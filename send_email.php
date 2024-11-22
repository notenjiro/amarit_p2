<?php
require_once '../config_db.php';
require_once '../utils/helper.php';
require_once "../phpmailer/class.phpmailer.php";

$user_name = $_GET['user_name'];
$worksheet_id = $_GET['worksheet_id'];

$fQuery = "SELECT  * FROM users WHERE user_name = '$user_name'";
$result = sqlsrv_query($conn, $fQuery);
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

//-- Setup
$host = "mail.csloxinfo.com";//SMTP_HOST;
$user = "frontend@amarit.co.th";//SMTP_USER;
$pass = "Amaritfe@2022";//SMTP_PASS;
$from = "frontend@amarit.co.th";//SMTP_FROM;
$from_name = "frontend@amarit.co.th";//SMTP_FROM_NAME;
$port = "587";//SMTP_PORT;

$to = $row["email"];
$subject = "Worksheet No. $worksheet_id";
$message = "Worksheet No. $worksheet_id"; 

$mail = new PHPMailer();
$mail->CharSet = "utf-8"; 
//$mail->SMTPDebug = 1;

$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;

$mail->SMTPSecure = "tls";
$mail->Port = 587;  
$mail->IsHTML(true);

$mail->Host = $host;          
$mail->Username = $user;
$mail->Password = $pass;

$mail->SetFrom($from,$from_name);
$mail->AddAddress($to);
$mail->Subject = $subject;
$mail->Body = $message;
$mail->WordWrap = 50;

 if(!$mail->Send()) {
    $Data["Status"] = "Error";
    $Data["msg"] = "Unable to send email. Please try again.". $mail->ErrorInfo;
} else {
    $Data["Status"] = "Success";
    $Data["msg"] = "Your mail has been sent successfully.";
}

echo json_encode($Data);
sqlsrv_close($conn);
?>