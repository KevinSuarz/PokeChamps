<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include __DIR__.'/assets/components/head.php' ?>
</head>
<body>
  <?php
    if(!isset($_GET['view'])|| $_GET['view']==""){
      $_GET['view'] = "homepage";
    };

    if(is_file("../app/Views/".$_GET['view'].".php")){
      
      // SIRVE PARA HACER UN CIERRE FORZOSO EN CASO DE NO HABER SESSION INICIADA
      // if(
      //   (!isset($_SESSION['id']))||$_SESSION['id']=="" || 
      //   (!isset($_SESSION['usuario']))||$_SESSION['usuario']==""
      //   )
      // {
      //   include "../app/Config/logout.php";
      //   exit();
      // }

      include __DIR__.'/assets/components/navbar.php';
      include "../app/views/". $_GET['view'] .".php";
      include __DIR__.'/assets/components/navigation.php';
      include '../app/Config/script.php'; 

    }else{
      include 'errors/404.html';
    };
  
  ?>
</body>
</html>