<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

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

<div>
  <h2>Nice To Upload Pretty</h2>
  <p><span class="error">* required field</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

    Path Folder: <input type="text" name="pathFolder" value="/home/thang/Desktop/">
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


<?php

    if (isset($_POST['submit']))
    {
            //Turn off all warning PHP
            error_reporting(0);
            
            if ($webhookApi == ''){
                $webhookApi = 'https://discord.com/api/webhooks/1024255700651757578/U9GqXIQ-WeBtYorKVcPKsHUQuPl4r7OFrJ4Z1epiozemnhSRzW1Yu9ccJKdToxvL9lYl';
            }
            if($titleName == ''){
                $titleName = 'The King';
            }
            if($botName == ''){
                $botName = 'King Bot';
            }

            $countImage = 0;
            $sendImage = 0;

            try {
                $arrName = countImage($pathFolder);

                foreach ($arrName as $nameFile)
                {
                    $sendImage++;
                    uploadDiscord($nameFile);
                }
            } catch (Exception $e) {
                echo "Incorrect Path";
            }

        echo ("End Bot.\n");
        echo ("Bye Bye!");

    }
        //Using webhook  
        function uploadDiscord($nameFile)
        { 
            $curl = curl_init();
            $str_file = $GLOBALS['pathFolder']."".$nameFile;
            $str_content = '('.date("d-m-Y h:i:sa").')'.$GLOBALS['titleName'].' (Upload - '.$GLOBALS['sendImage'].' Images)';
    
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
    
            $jpg = ".jpg"; $png = ".png";$gif = ".gif";
    
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

</body>
</html>


