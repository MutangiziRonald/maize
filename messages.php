<?php include './header.php'?>
<?php 
include './dbinit.php';

$id=$_SESSION['id'];
$sql="SELECT * FROM messages WHERE receiver=$id";
$results =mysqli_query($conn,$sql);
$messages=mysqli_fetch_all($results,MYSQLI_ASSOC);




$arr=array();
foreach ($messages as $message) {
	array_push($arr,$message['sender']);
}
$senders=array_unique($arr);







?>
<?php
function getUser( $userId){

	include './dbinit.php';
	$sql="SELECT * FROM users WHERE id=$userId";
	$results =mysqli_query($conn,$sql);
	$users=mysqli_fetch_all($results,MYSQLI_ASSOC);
	

	return ($users[0]);
}

?>
<?php
function getlikes( $userId){
	$id=$_SESSION['id'];
	include './dbinit.php';
	$sql="SELECT * FROM messages WHERE sender=$userId AND receiver=$id AND seen=false";
	$results =mysqli_query($conn,$sql);
	$numlikes=mysqli_fetch_all($results,MYSQLI_ASSOC);
	

	return (count($numlikes));
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
<body>
	<div class="container">
		<div class="row">
			<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> -->
			 <div class="col-xxl-4 col-lg-4 col-md-4">
				
			</div>
			 <div class="col-xxl-4 col-lg-4 col-md-4 col-xxs-12">


		<div class="wrapper1">
		<section class="chat-area">
			<?php foreach ($senders as $sender) { ?>
				<a href="chat.php?id=<?php echo $sender  ?>" style="text-decoration: none; color: black;">
				<header style="position:relative; height: 20px; ">
				<!-- <a href="buyers.html" class="back-icon bi bi-arrow-left"></a> -->
					<!-- <img src="logos/<?php// echo getUser($sender)['logo']   ?>"  alt=""> -->

				<div class="details" style="position:relative;" >
					<span> <?php echo getUser($sender)['name'] ?> </span>
					
					<!-- <p>Active now</p> -->

					<!-- <span style="position:absolute; color: red; right: -130px;" class="badge rounded-pill bg-primary-"></span> -->
					<?php if ( getlikes($sender)>0): ?>
						<span style="position: absolute; right: -200px;" class=" badge rounded-pill bg-success"><?php echo getlikes($sender) ?></span>

					<?php endif ?>
					<p><?php echo getUser($sender)['company'] ?></p>
				</div>
			
			</header>
		</a>
		<hr>
			<?php } ?>

			
			



			
		
			
				

				
			
			
		</section>
		</div>

				
	</div>

	<div class="col-xxl-4 col-lg-4 col-md-4 ">
				
	</div>
		</div>
		
	</div>
	

</body>

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