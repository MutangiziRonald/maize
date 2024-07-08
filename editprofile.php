<?php
session_start();
include './dbinit.php';
if (isset($_POST['submit'])) {
    print_r($_POST);
    $name=$_POST['name'];
    $company = $_POST['company'];
    $motto=$_POST['motto'];
    $description=$_POST['text'];
    $contact=$_POST['contact'];
    $location=$_POST['location'];
    $website=$_POST['website'];
    $user=$_SESSION['id'];

    if (empty($name)|| empty($motto)||empty($contact)||empty($location)||empty($website) ) {
        header('location:./profile.php');
    } else {
        $sql="UPDATE users SET name='$name', company = '$company', website='$website',motto='$motto',contact=$contact ,description='$description', location='$location' WHERE id=$user";
        if (mysqli_query($conn,$sql)) {
            header('location: ./profile.php');
            
              
        }else {
          echo 'failed';
        }
    }
    

}


?>