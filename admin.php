<?php
include './dbinit.php';
session_start();
if (isset($_GET['admin'])) {
  print_r($_GET);
  $type=$_GET['admin'];
   
   echo $type;
  if ($type==1) {
    $id=$_GET['id'];
    
    $sql="UPDATE users SET admin=false WHERE id= $id";
    if (mysqli_query($conn,$sql)) {
      
      header('location: ./people.php');
          
      }else {
        echo 'failed';
        exit();
      }
  }else{
    $id=$_GET['id'];
    $sql="UPDATE users SET admin=true WHERE id= $id";
    if (mysqli_query($conn,$sql)) {
      
      header('location: ./people.php');
          
      }else {
        echo 'failed';
        exit();
      }
  }
}

 




?>