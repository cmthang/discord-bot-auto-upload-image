<?PHP
echo "Bot executed \n";

// Server data - replace placeholders below with your data
// $servername = "http://localhost:96/discord-image-bot/";
// $username   = "thang";
// $password   = "";
// $dbname     = "discord";

// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

// // Set index
// $result = $conn->query("SELECT * FROM Counter");
// $row_cnt = $result->num_rows;
// // If database is empty - set 0 as initial value.
// if ($row_cnt === 0) {
//   $initial_entry = 0;
//   $sql_init = "INSERT INTO Counter (Number) VALUES ($initial_entry)";
//   $conn->query($sql_init);
//   $index = $initial_entry;
// }
// // If database is not empty - set index to highest value.
// else{
//   $newest_entry = "SELECT * FROM Counter ORDER BY Number DESC LIMIT 1";
//   $newest_entry = $conn->query($newest_entry);
//   $newest_entry= mysqli_fetch_assoc($newest_entry);
//   $index = $newest_entry["Number"];
// }

//Set image to post - replace path_placeholder with path to the file that stores the images.
$title = "...";
// $image = '/home/thang/Desktop/2.png';
// $image = "https://imgur.com/t/funny/ocKMJ1h";
// $image = "https://eu.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-lv-volt-upside-down-pendant-yellow-gold-jewelry--Q93868_PM2_Front%20View.png?wid=656&hei=656";

// Post to Discord - replace webhook_placeholder with your webhook.
$webhook = "https://discord.com/api/webhooks/1024255700651757578/U9GqXIQ-WeBtYorKVcPKsHUQuPl4r7OFrJ4Z1epiozemnhSRzW1Yu9ccJKdToxvL9lYl";
$message = json_encode([
  "content" => $title,  
  "username" => "Captain Bot",
  "embeds" => [
    [
      'image' => 
        [
          'url' => 'https://i.imgur.com/ZGPxFN2.jpg'
          // 'url' => 'attachment://http://localhost:96/discord-image-bot/2.png' 
        ]
    ]
  ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$send = curl_init($webhook);
curl_setopt($send, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
curl_setopt($send, CURLOPT_POST, 1);
curl_setopt($send, CURLOPT_POSTFIELDS, $message);
curl_setopt($send, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($send, CURLOPT_HEADER, 0);
curl_setopt($send, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($send);
echo $output;
curl_close($send);

// Increment index and save
// $next_entry = $index+1;
// $sql_save = "INSERT INTO Counter (Number) VALUES ($next_entry)"; 
// $conn->query($sql_save);

// // Close connection to database
// $conn->close();

?>










