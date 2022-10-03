<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  


<!-- Display input -->
<?php
// define variables and set to empty values
$pathFolderErr = $webhookApiErr = $titleNameErr = $botNameErr = "";
$pathFolder = $webhookApi = $titleName = $botName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["pathFolder"])) {
    $pathFolderErr = "Path Folder is required";
  } else {
    $pathFolder = test_input($_POST["pathFolder"]);
  }

    $webhookApi = test_input($_POST["webhookApi"]);
  
    
  if (empty($_POST["titleName"])) {
    $titleName = "";
  } else {
    $titleName = test_input($_POST["titleName"]);
  }

  if (empty($_POST["botName"])) {
    $botNameErr = "";
  } else {
    $botName = test_input($_POST["botName"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div style="text-align: center;">
  <h2>Nice To Upload Pretty</h2>
</div>
<div style="width:40%; text-align:center; padding-left: 30%;">
  <p><span class="error">* required field</span></p>
  <p><span class="error">  C:\\Users\\Administrator\\Desktop\\upload\\ </span></p>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

    Path Folder: <input type="text" name="pathFolder" value="C:\\Users\\NumberOne\\Desktop\\Upload\\">
    <span class="error">* <?php echo $pathFolderErr;?></span>
    <br><br>

    Webhook Api: <input type="text" name="webhookApi" value="">
    <span class="error"><?php echo $webhookApiErr;?></span>
    <br><br>

    Title Name: <input type="text" name="titleName" value="">
    <span class="error"><?php echo $titleNameErr;?></span>
    <br><br>

    Bot Name: <input type="text" name="botName" value="">
    <span class="error"><?php echo $botNameErr;?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit" style="margin-bottom: 20px;">  

  </form>
</div>


<!-- Methods action -->
<!-- Run Begin  -->
<?php

    if (isset($_POST['submit']))
    {
            //Turn off all warning PHP
            // error_reporting(0);

            $countImage = 0;
            $sendImage = 0;

            // $pathFolder = "";
            $defaultWebhookApi = "https://discordapp.com/api/webhooks/1025764741358039110/ICcEHEpYMea4bnqZFFB6KTVbQ9qhYkIX157iS9kiiR7BaSyx91AjUfxF6hbOUeLK1myg";
            $defaultBotName = "King Bot";
            $defaultTitle = "The King";

            $arrName = countImage($pathFolder);

            validate();

            foreach ($arrName as $nameFile)
            {
              $sendImage++;
              uploadDiscord($nameFile);
            }

            $lastArrName = $arrName;

            while(true)
            {
              setInterval(function(){
                $GLOBALS['arrName'] = countImage($GLOBALS['pathFolder']);
                
                $checkArr = array_diff($GLOBALS['arrName'], $GLOBALS['lastArrName']);

                if ($checkArr != null)
                {
                  foreach ($checkArr as $nameFile)
                  {
                    $GLOBALS['sendImage']++;
                    uploadDiscord($nameFile);
                  }
  
                  $GLOBALS['lastArrName'] = $GLOBALS['arrName'];
                }
  
              },4000);

            }

            echo ("End Bot.\n");
            echo ("Bye Bye!");
    
    }
      // Run End

        //Using webhook  
        function uploadDiscord($nameFile)
        { 
            $curl = curl_init();
            $str_file = $GLOBALS['pathFolder']."".$nameFile;
            date_default_timezone_get();
            $str_content = '('.date("l d-m-Y h:i:sa").')'.$GLOBALS['titleName'].' (Upload - '.$GLOBALS['sendImage'].' Images)';
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => $GLOBALS['webhookApi'],
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
    
            // echo $response;
        }
    
        //Execute Folder - countImage File .jpg, .png, .gif
        function countImage($pathFolder)
        {
            $folderFiles = array_diff(scandir($pathFolder), array('.', '..')); 
    
            $jpg = ".jpg"; $png = ".png";$gif = ".gif";$jepg = ".jepg";
    
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
              if (strlen(strstr($item, $jepg))>0){
                array_push($true,$item);
                $GLOBALS['countImage']++;
              }
            }
            return $true;
        }

        //Interval PHP
        function setInterval($f, $milliseconds)
        {
            $seconds=(int)$milliseconds/1000;
            while(true)
            {
                $f();
                sleep($seconds);
            }
        }

        //Validate Input
        function validate()
        {
          if ($GLOBALS['webhookApi'] == ''){
              $GLOBALS['webhookApi'] = $GLOBALS['defaultWebhookApi'];
          }
          if($GLOBALS['titleName'] == ''){
              $GLOBALS['titleName'] = $GLOBALS['defaultTitle'];
          }
          if($GLOBALS['botName'] == ''){
              $GLOBALS['botName'] = $GLOBALS['defaultBotName'];
          }
        }

?>

</body>
</html>


