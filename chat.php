<?php include 'header.php' ?>
<!-- End Header -->


<?php
//session_start();include './dbinit.php';
if ( count($_SESSION)==0) {
  
  
	header('location: ./login.php');
  }else {
	if ($_GET['id']) {
		
		$seller= $_GET['id'] ;
		$vistor=$_SESSION['id'];

		$ql="UPDATE messages SET seen=true WHERE sender=$seller AND receiver=$vistor";
		if (mysqli_query($conn,$ql)) {
      
			
				
			}else {
			  echo 'failed';
			}

		$sql="SELECT * FROM messages WHERE sender  = $seller AND receiver = $vistor or sender  = $vistor and receiver = $seller order by id desc";
		$results =mysqli_query($conn,$sql);
		$messages=mysqli_fetch_all($results,MYSQLI_ASSOC);


	} else {
		header('location: ./index.php');
	}
	 
  }

  $sql="SELECT * FROM users WHERE id=$seller";
  $results =mysqli_query($conn,$sql);
  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);

  $user=$users[0];


  	if (isset($_POST['submit'])) {
  		if (empty($_POST['message'])) {
  			header('location: ./chat.php?id='.$seller);
  		} else {
  		$message=$_POST['message'];
		$sender=$vistor;
		$receiver=$seller;
		$sql="INSERT INTO messages (message,sender,receiver) VALUES('$message',$sender,$receiver)";
		if (mysqli_query($conn,$sql)) {
			header('location: ./chat.php?id='.$seller);
		}
  		}
  		

		

	}



?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UG Maize</title>

	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  	<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<br>
	
	

		<section class="chat-area">
			<div class="w-100" style='height:20px;'></div>
			<header class='' style="height:70px;">
			
				<!-- <a href="buyers.html" class="back-icon bi bi-arrow-left"></a> -->
				<img src="logos/<?php echo $user['logo']  ?>" alt="">

				<div class="details" style="position:relative;" >
					<span><?php echo $user['company'] ?></span>
					<!-- <p>Active now</p> -->

					<span style="position:absolute; color: red; right: -130px;" class="bi bi-"></span>
				</div>
			
			</header>
			<div class="chat-box">
				<?php echo count($messages)<1?'start a chart with '.$user['name']:''  ?>
				<?php foreach ($messages as $message) {?>
					<div class=" <?php echo $message['sender']==$vistor?'chat outgoing':'chat incoming'  ?> ">
					<?php if ($message['receiver']==$seller) {?>
						<img src="logos/<?php $user['logo'] ?>" alt="">
					<?php } ?>
					
					<div class="details">
						<p><?php echo $message['message'] ?></p>
				
					</div>
				</div>
				<?php } ?>

				
			</div>
			<form action="" method='POST' class="typing-area">
				<input type="text"  style="width:100%" id="message" name='message' placeholder="Type a message here...">
				

				&nbsp;<i class="fab fa-telegram-plane" style="width:150px">
					<input id='btn'  value="send" disabled style="cursor: pointer; width:100%" type='submit' name='submit'></input>
				</i>
			</form>
		</section>
	
	



<script>
	var message = document.getElementById('message');
	var btn=document.getElementById('btn')
	message.addEventListener('change' ,(e)=>{
		if (e.target.value.length<0) {
			btn.disabled=true
		}else{
			btn.disabled=false
		}

	})
</script>
</html>