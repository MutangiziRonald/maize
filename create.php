

<?php 
include './dbinit.php' ;
$errors=[
    'name'=>'',
    'email'=>'',
    'password'=>'',
	'company'=>'',
	'image'=>'',
	'contact'=>'',
	'category'=>''

];
if (isset($_POST['submit'])) {
  $email= $_POST['email'];
  $password= base64_encode($_POST['password']) ;
  $company=$_POST['company'];
  $name=$_POST['name'];
//   $description=$_POST['description'];
  $contact=$_POST['contact'];
//   $website=$_POST['website'];
  $location=$_POST['location'];
//   $motto=$_POST['motto'];
 
  $category=$_POST['category'];
  

  //image
  $folder = './imgs/';
  $target=$folder.basename($_FILES['image']['name']);
  $image=basename($_FILES['image']['name']);


  $folder = './logos/';
  $target2=$folder.basename($_FILES['logo']['name']);
  $logo=basename($_FILES['logo']['name']);
  

  if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $errors['email']='invalid email address';
  } elseif(empty($name)) {
    $errors['name']='name cant be empty';
  }elseif(empty($contact)){
	$errors['contact']='a contact must be provided';
  } elseif(empty($company)) {
    $errors['company']='invalid company detais';
  }elseif(empty($password)){
    $errors['password']='wrong password';
  }elseif (empty($category)) {
    $errors['category']=' no category provided';
  }else{
    $sql="INSERT INTO users (name,email,password,role,image,company,logo,contact,location) VALUES('$name','$email','$password','$category','$image','$company','$logo','$contact','$location')";
    if (mysqli_query($conn,$sql)) {
		move_uploaded_file($_FILES['image']['tmp_name'],$target);
		move_uploaded_file($_FILES['logo']['tmp_name'],$target2);
      	$sql='SELECT * FROM users WHERE id=LAST_INSERT_ID()';
		  $results =mysqli_query($conn,$sql);
		  $users=mysqli_fetch_all($results,MYSQLI_ASSOC);
		  $user=$users[0];
		  header('location:./resend.php?id='.base64_encode($user['id']).'&&email='.base64_encode($email)  );
    }else {
      echo 'failed';
    }

  }
  






//   if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
//     $errors['email']='invalid email address';
//   } elseif(empty($name)) {
//     $errors['name']='name cant be empty';
//   }elseif(empty($password)){
//     $errors['password']='wrong password';
//   }elseif ($password!=$cpass) {
//     $errors['password']=' passwords dont macth';
//   }else{
//     $sql="INSERT INTO users (name,email,password,role) VALUES('$name','$email','$password','$role')";
//     if (mysqli_query($conn,$sql)) {
//       header('location:index.php');
//     }else {
//       echo 'failed';
//     }

//   }
  

};


  ?>


