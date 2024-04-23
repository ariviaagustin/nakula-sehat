<?php function produsen_helper()
{
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://indonesiafisheries.id/Share/produsen",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Postman-Token: 3738b538-858e-448c-ba1b-3732c3ef578d"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
return $response;
}
?>