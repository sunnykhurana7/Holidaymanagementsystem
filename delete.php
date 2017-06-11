<?php
  include('conn.php');
  if(!$_SESSION['loggedinUser']){
        header('location:index.php');
    }
    
  if(isset($_GET['id'])){
      if($stmt=$conn->query("DELETE from employees where id ='".$_GET['id']."'")){
          header('location:dashboard.php');
      }
  }
?>
