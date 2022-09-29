<?php 
  $path_Folder_Linux = '/home/thang/Desktop'; 
  
  $folderFiles = array_diff(scandir($path_Folder_Linux), array('.', '..')); 
  
  $jpg = ".jpg";
  $png = ".png";
  $gif = ".gif";

  $check_image_jpg = in_array($jpg,$folderFiles);
  $check_image_png = in_array($png,$folderFiles);
  $check_image_gif = in_array($gif,$folderFiles);

  $count = 0;
  $true = array();

  foreach($folderFiles as $item){
    if (strlen(strstr($item, $jpg))>0){
      array_push($true,$item);
      $count++;
    }
    if (strlen(strstr($item, $png))>0){
      array_push($true,$item);
      $count++;
    }
    if (strlen(strstr($item, $gif))>0){
      array_push($true,$item);
      $count++;
    }
  }

  $count_true=1;
  foreach ($true as $item){
    uploadDiscord($item, $count_true);
    $count_true++;
  }
  

function uploadDiscord($path_file, $count_true){  
    $curl = curl_init();

    $half_path_file='/home/thang/Desktop/';
    $str_file= $half_path_file."".$path_file;
    $str_content = 'The King '.$count_true.':';
    $bot_name = 'Captain Bot';
    $webhooks_api = 'https://discord.com/api/webhooks/1024255700651757578/U9GqXIQ-WeBtYorKVcPKsHUQuPl4r7OFrJ4Z1epiozemnhSRzW1Yu9ccJKdToxvL9lYl';

    curl_setopt_array($curl, array(
    CURLOPT_URL => $webhooks_api,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'file1'=> new CURLFILE($str_file),
        'content' => $str_content,
        'username' => $bot_name,
    ),
    CURLOPT_HTTPHEADER => array(
        'Cookie: __cfruid=86de761e9e9c45f31a72c71984e0ce8d34bebd15-1664332450; __dcfduid=17ec92ec3ed611ed9b6e2aa9284243bb; __sdcfduid=17ec92ec3ed611ed9b6e2aa9284243bb5dafe0d4bc85410152a484cd72c4e504d8e39d79ef8421edb67d5303038031a7'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

?> 