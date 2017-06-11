<?php
  session_start();
  $conn = new mysqli('localhost','root','','holidaymanagementsystem');
  if($conn->connect_errno){
      echo 'not connected properly with database';
      
  }
?>
