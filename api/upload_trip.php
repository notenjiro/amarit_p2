<?php

require_once '../config_db.php';
require_once '../utils/helper.php';

$fQuery = "SELECT  * FROM application_setup";
$result = sqlsrv_query($conn, $fQuery);

$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

/* Getting file name */
$filename = $_GET['filename'];

$file = $_FILES['file']['tmp_name']; 
$sourceProperties = getimagesize($file);
$imageType = $sourceProperties[2];
  
$file_name = $_FILES['file']['name'];

if ($imageType == 3)
  $ext = 'png';
else 
  $ext = 'jpg';

/* Location */
$location = $row['picture_folder'].$filename.".".$ext;

//test
$imageTemp = $_FILES['file']['tmp_name']; 
$imageSize = convert_filesize($_FILES["file"]["size"]);

//$compressedImage = compressImage($imageTemp, '../uploads/test.png', 75); 
//$sourceProperties = getimagesize($file);
//$fileNewName = 'test';
//$folderPath = $row['picture_folder'];
//$imageType = 'png';

//$imageResourceId = imagecreatefrompng($file);
//$bck   = imagecolorallocate( $imageResourceId , 0, 0, 0 );
//imagecolortransparent( $imageResourceId, $bck );
//imagealphablending( $imageResourceId, false );
//imagesavealpha( $imageResourceId, true );

//$targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
//imagejpeg($targetLayer,$folderPath. $fileNewName. "_thump.". $ext, 90);

if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
    $Data["status"] = "success";
    $Data["msg"] = "Upload success";
}else{
    $Data["status"] = "error";
    $Data["msg"] = "มีบางอย่างผิดพลาด";
}

//$image = imagecreatefrompng('../uploads/WS220500002TP2200001step201.png'); 



//$fileName = 'WS220500002TP2200001step201';
if ($ext == 'png')
  shell_exec('"../Tesseract-OCR/tesseract.exe" "../uploads/'.$_GET['filename'].'.png" out');
else
  shell_exec('"../Tesseract-OCR/tesseract.exe" "../uploads/'.$_GET['filename'].'.jpg" out');

$myfile = fopen("../api/out.txt", "r") or die("Unable to open file!");
$Data["miledge"] = fread($myfile,filesize("../api/out.txt"));
fclose($myfile);

//$source_img = "../uploads/WS220500002TP2200001step201.png";
//$destination_img = "../uploads/test.png";

//$d = compress($source_img, $destination_img, 90);

echo json_encode($Data);

sqlsrv_close($conn);

function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    $image = imagecreatefrompng($source); 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
}

function convert_filesize($bytes, $decimals = 2) { 
    $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB'); 
    $factor = floor((strlen($bytes) - 1) / 3); 
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor]; 
}

?>