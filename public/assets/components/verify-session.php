<?php
  if(!isset($_SESSION['id']) && !isset($_SESSION['email']) && !isset($_SESSION['userName'])){
    if(headers_sent()){
    echo "<script> window.location.href='index.php?view=homepage'; </script>";
  }else{
    header("location: index.php?view=homepage");
  }
  }
?>