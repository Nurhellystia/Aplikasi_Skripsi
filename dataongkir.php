<?php
$ekspedisi = $_POST["ekspedisi"];
$kota = $_POST["kota"];
$berat = $_POST["berat"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=501&destination=".$kota."&weight=".$berat."&courier=".$ekspedisi,
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: 467ef40e69e4afe2969793bd8a7d4c0a"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
  $array_response = json_decode($response,TRUE);
  $ongkir = $array_response["rajaongkir"]["results"]["0"]["costs"];

  // echo "<pre>";
  // print_r($ongkir);
  // echo "</pre>";

  echo "<option class='text-center' value='' selected disabled>-- Pilih Ongkir --</option>";
  foreach ($ongkir as $key => $tiap_ongkir) {
    echo "<option
    paket='".$tiap_ongkir['service']."'
    ongkir='".$tiap_ongkir["cost"]["0"]["value"]."'
    etd='".$tiap_ongkir["cost"]["0"]["etd"]."'
    >";
    echo $tiap_ongkir["service"]." ";
    echo number_format($tiap_ongkir["cost"]["0"]["value"])." ";
    echo $tiap_ongkir["cost"]["0"]["etd"];
    echo "</option>";
  }
}
?>