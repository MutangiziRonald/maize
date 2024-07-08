<?php 
session_start();
if ( count($_SESSION)>0 && $_SERVER['PHP_SELF']=='/project/login.php') {
  
  
	header('location: ./index.php');
  }


include './dbinit.php';
$error='';
if (isset($_POST['submit'])) {
  $email= $_POST['email'];
  $password=base64_encode($_POST['password']) ;
  $sql="SELECT * FROM users WHERE password='$password' and email='$email' and status='verified'";
  $results=mysqli_query($conn,$sql);
  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);
  if (count($users)>0) {
    session_start();
    $_SESSION['userName']=$users[0]['name'];
    $_SESSION['email']=$users[0]['email'];
    $_SESSION['role']=$users[0]['role'];
    $_SESSION['image']=$users[0]['image'];
    $_SESSION['company']=$users[0]['company'];
    $_SESSION['id']=$users[0]['id'];
    $_SESSION['admin']=$users[0]['admin'];

	if ($_SESSION['admin']==1) {
		
		header('location: ./dashboard.php');
		   
	} else {
		header('location:index.php');
	}
	

    
  }else {
    $error='invalid login';
  }
}

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UG Maize</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="wrapper">
	<section class="form signup">
		<header>Login</header>
		<form action="login.php" method="POST" >
			
				<div class="field input">
					<label>Email</label>
					<input type="email" name="email" placeholder="Email" required>
					
				</div>
				<div class="field input">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password" required>
					
					<p class='text-danger text-center '><?php echo $error ?></p>
				<div class="field button">
					<input type="submit" name="submit" value="Sign In">
				</div>

		</form>
		<div class="link">Already signed Up  <a href="create.php">Sign Up</a></div>
	</section>
</div>


</body>
</html>