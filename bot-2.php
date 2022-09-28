<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://discord.com/api/webhooks/1024255700651757578/U9GqXIQ-WeBtYorKVcPKsHUQuPl4r7OFrJ4Z1epiozemnhSRzW1Yu9ccJKdToxvL9lYl',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('file1'=> new CURLFILE('/home/thang/Desktop/2.png')),
  CURLOPT_HTTPHEADER => array(
    'Cookie: __cfruid=86de761e9e9c45f31a72c71984e0ce8d34bebd15-1664332450; __dcfduid=17ec92ec3ed611ed9b6e2aa9284243bb; __sdcfduid=17ec92ec3ed611ed9b6e2aa9284243bb5dafe0d4bc85410152a484cd72c4e504d8e39d79ef8421edb67d5303038031a7'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
