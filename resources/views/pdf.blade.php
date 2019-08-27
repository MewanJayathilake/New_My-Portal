<?
 // for my resulte certificate pdf 
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

header("Access-Control-Allow-Headers: X-APIKEY");

header("Content-type: application/pdf");

header('Content-Disposition: attachment; filename="certificate.pdf"');

echo base64_decode($pdf)

?>