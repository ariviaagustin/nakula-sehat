<?php function kategori_produk_helper()
{
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://indonesiafisheries.id/Share/kategori_produk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "Postman-Token: a9d2ba8b-dc65-45c9-a1b4-0445d467985e"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
  curl_close($curl);
  return $response;
}
?>