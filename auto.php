<?php 

    // $file =  __FILE__;

    // echo ($file);


  $titleName = 'The King';
  $botName = 'Captain Bot';
  $webhooksApi = 'https://discord.com/api/webhooks/1024255700651757578/U9GqXIQ-WeBtYorKVcPKsHUQuPl4r7OFrJ4Z1epiozemnhSRzW1Yu9ccJKdToxvL9lYl';
  $pathFolder = "/home/thang/Desktop/";
  $countImage = 0;
  $sendImage = 0;

  $arrName = countImage($pathFolder);


  foreach ($arrName as $nameFile)
  {
    $sendImage++;
    uploadDiscord($nameFile);
  }
  

//Using webhook  
function uploadDiscord($nameFile)
{ 
    $curl = curl_init();

    $str_file = $GLOBALS['pathFolder']."".$nameFile;
    $str_content = '('.date("d-m-Y h:i:sa").')'.$GLOBALS['titleName'].' (Upload - '.$GLOBALS['sendImage'].' Images)';

    curl_setopt_array($curl, array(
    CURLOPT_URL => $GLOBALS['webhooksApi'],
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
        'username' => $GLOBALS['botName'],
    ),
    CURLOPT_HTTPHEADER => array(
        'Cookie: __cfruid=86de761e9e9c45f31a72c71984e0ce8d34bebd15-1664332450; __dcfduid=17ec92ec3ed611ed9b6e2aa9284243bb; __sdcfduid=17ec92ec3ed611ed9b6e2aa9284243bb5dafe0d4bc85410152a484cd72c4e504d8e39d79ef8421edb67d5303038031a7'
    ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    echo $response;
}

//Execute Folder - countImage File .jpg, .png, .gif
function countImage($pathFolder)
{
  $folderFiles = array_diff(scandir($pathFolder), array('.', '..')); 
  
  $jpg = ".jpg";
  $png = ".png";
  $gif = ".gif";

  $true = array();

  foreach($folderFiles as $item){
    if (strlen(strstr($item, $jpg))>0){
      array_push($true,$item);
      $GLOBALS['countImage']++;
    }
    if (strlen(strstr($item, $png))>0){
      array_push($true,$item);
      $GLOBALS['countImage']++;
    }
    if (strlen(strstr($item, $gif))>0){
      array_push($true,$item);
      $GLOBALS['countImage']++;
    }
  }

  return $true;
}

?> 