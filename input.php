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

  if (empty($_POST["webhookApi"])) {
    $webhookApiErr = "Webhook Api is required";
  } else {
    $webhookApi = test_input($_POST["webhookApi"]);
  }
  
    
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

    Path Folder: <input type="text" name="pathFolder" value="">
    <span class="error">* <?php echo $pathFolderErr;?></span>
    <br><br>

    Webhook Api: <input type="text" name="webhookApi" value="https://discord.com/api/webhooks/1024255700651757578/U9GqXIQ-WeBtYorKVcPKsHUQuPl4r7OFrJ4Z1epiozemnhSRzW1Yu9ccJKdToxvL9lYl">
    <span class="error">*<?php echo $webhookApiErr;?></span>
    <br><br>

    Title Name: <input type="text" name="titleName" value="King">
    <span class="error">* <?php echo $titleNameErr;?></span>
    <br><br>

    Bot Name: <input type="text" name="botName" value="Captain Bot">
    <span class="error">*<?php echo $botNameErr;?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit">  

  </form>
</div>
<?php
echo "<h2>Your Input:</h2>";
echo "Path File: ".$pathFolder;
echo "<br>";
echo "Webhook Api: ".$webhookApi;
echo "<br>";
echo "Title Name: ".$titleName;
echo "<br>";
echo "Bot Name: ".$botName;

?>

</body>
</html>


