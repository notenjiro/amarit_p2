<?php
// include composer autoload
require_once 'vendor/autoload.php';
 
header('Content-Type: image/png');
$generator = new Picqer\Barcode\BarcodeGeneratorPNG(); 
if(isset($_GET['code']) && $_GET['code']!=""){
    echo $generator->getBarcode(urldecode(trim($_GET['code'])), $generator::TYPE_CODE_128);
}
?>