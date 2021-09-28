<?php
  $filename=uniqid('f_').'.'.$_GET['filetype'];
  $fileData=file_get_contents('php://input');
  if (!file_exists('images')) {
    mkdir('images', 0777, true);
  }
  $fhandle=fopen("images/".$filename, 'wb');
  fwrite($fhandle, $fileData);
  fclose($fhandle);
  echo($filename);
?>