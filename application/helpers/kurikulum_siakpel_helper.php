<?php 
  function kurikulum_siakpel_helper($pelatihan)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://siakpel.kemkes.go.id/index.php/Api/kurikulum_metode',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('username' => 'Ekurma','pelatihan_id' => $pelatihan),
      CURLOPT_HTTPHEADER => array(
        'Cookie: ci_session=vucvhlq1bclqnfm65dkat7ei17cof6rk'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }
?>  