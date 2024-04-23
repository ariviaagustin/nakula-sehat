<?php function produk_helper()
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://indonesiafisheries.id/Share/all",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Cache-Control: no-cache",
      "Postman-Token: 9b7f780d-7f48-403b-a7f1-4264c1d681b8"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  return $response;
}
?>