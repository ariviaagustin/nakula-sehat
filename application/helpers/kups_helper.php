<?php function kups_helper()
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://sinav.usahahutan.id/index.php/api/petasebaran/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Referer: simping",
      "Cookie: ci_session=sn3hehkah1gc0epnuhp8e1adoour6m0f"
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
}
?>  