<?php 

include './dbinit.php';
session_start();
function liked($blogId){
    include './dbinit.php';
    $id=$_SESSION['id'];
    $sql="SELECT * FROM likes WHERE blogId=$blogId AND userId=$id";
    $results =mysqli_query($conn,$sql);
    $likes=mysqli_fetch_all($results,MYSQLI_ASSOC);
    return count($likes);


}
if (count($_SESSION)==0) {
	header('location: ./login.php');
}
if (isset($_GET['page'])) {
	$id= base64_decode($_GET['id']) ;
	$page=$_GET['page'];
	$user=$_SESSION['id'];

	if (liked($id)>0) {
		$sql="DELETE FROM likes WHERE blogId=$id AND userId=$user";
	if (mysqli_query($conn,$sql)) {
		header('location: '.$page);
		
      	
    }else {
      echo 'failed';
    }
	} else {
		
	$sql="INSERT INTO likes(blogId,userId) VALUES($id,$user)";
	if (mysqli_query($conn,$sql)) {
		header('location: '.$page);
		
      	
    }else {
      echo 'failed';
    }
	}
	



}

 ?>