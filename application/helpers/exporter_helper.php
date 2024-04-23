<?php function exporter_helper()
{
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://indonesiafisheries.id/Share/entitas__tujuan_exporter",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Postman-Token: e54e519f-e4ab-4363-92af-3bfcd8cdf074"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

  return $response;
}
?>