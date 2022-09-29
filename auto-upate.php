<?php 
  $mydir = 'C:\\Users\\Administrator\\Desktop\\'; 
  
  $folderFiles = array_diff(scandir($mydir), array('.', '..')); 
  
  print_r($folderFiles); 
?> 