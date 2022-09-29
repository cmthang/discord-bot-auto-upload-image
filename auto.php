<?php 
  $path_Folder_Win = 'C:\\Users\\Administrator\\Desktop\\'; 
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
    printf($count_true.".  ");
    printf("Check:".$item);
    $count_true++;
  }
  
?> 