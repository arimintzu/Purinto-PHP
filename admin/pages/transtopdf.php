<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array("source" => "https://purinto.thekingcorp.org/admin/pages/transprint.php", "landscape" => true, "use_print" => false)),
    CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
    CURLOPT_USERPWD => '0f1e8bcac3d34ee1adc9aca719528f96'
));

$response = curl_exec($curl);
file_put_contents('report/DataTransaksi.pdf', $response);
echo '<script type= "text/javascript">window.location.href = "report/DataTransaksi.pdf";</script>';
?>
