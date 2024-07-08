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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <style type="text/css">
    @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap");
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }
    html,
    body {
      display: grid;
      height: 100%;
      width: 100%;
      place-items: center;
      background: -webkit-linear-gradient(left, #fcfbfc, #a2faae);
      
    }
    ::selection {
      background: #fa4299;
      color: #fff;
    }
    .wrapper {
      overflow: hidden;
      max-width: 500px;
      background: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.1);
    }
    .wrapper .title-text {
      display: flex;
      width: 200%;
    }
    .wrapper .title {
      width: 50%;
      font-size: 35px;
      font-weight: 600;
      text-align: center;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .wrapper .slide-controls {
      position: relative;
      display: flex;
      height: 50px;
      width: 100%;
      overflow: hidden;
      margin: 30px 0 10px 0;
      justify-content: space-between;
      border: 1px solid lightgrey;
      border-radius: 5px;
    }
    .slide-controls .slide {
      height: 100%;
      width: 100%;
      color: #fff;
      font-size: 18px;
      font-weight: 500;
      text-align: center;
      line-height: 48px;
      cursor: pointer;
      z-index: 1;
      transition: all 0.6s ease;
    }
    .slide-controls label.signup {
      color: #000;
    }
    .slide-controls .slider-tab {
      position: absolute;
      height: 100%;
      width: 50%;
      left: 0;
      z-index: 0;
      border-radius: 5px;
      background: -webkit-linear-gradient(left, #a445b2, #fa4299);
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    input[type="radio"] {
      display: none;
    }
    #signup:checked ~ .slider-tab {
      left: 50%;
    }
    #signup:checked ~ label.signup {
      color: #fff;
      cursor: default;
      user-select: none;
    }
    #signup:checked ~ label.login {
      color: #000;
    }
    #login:checked ~ label.signup {
      color: #000;
    }
    #login:checked ~ label.login {
      cursor: default;
      user-select: none;
    }
    .wrapper .form-container {
      width: 100%;
      overflow: hidden;
    }
    .form-container .form-inner {
      display: flex;
      width: 200%;
    }
    .form-container .form-inner form {
      width: 50%;
      transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .form-inner form .field {
      height: 50px;
      width: 100%;
      margin-top: 20px;
    }
    .form-inner form .field input,select {
      height: 100%;
      width: 100%;
      outline: none;
      padding-left: 15px;
      border-radius: 5px;
      border: 1px solid lightgrey;
      border-bottom-width: 2px;
      font-size: 17px;
      transition: all 0.3s ease;
    }
    .form-inner form .field input:focus {
      border-color: #fc83bb;
      /* box-shadow: inset 0 0 3px #fb6aae; */
    }
    .form-inner form .field input::placeholder {
      color: #999;
      transition: all 0.3s ease;
    }
    form .field input:focus::placeholder {
      color: #b3b3b3;
    }
    .form-inner form .pass-link {
      margin-top: 5px;
    }
    .form-inner form .signup-link {
      text-align: center;
      margin-top: 30px;
    }
    .form-inner form .pass-link a,
    .form-inner form .signup-link a {
      color: #fa4299;
      text-decoration: none;
    }
    .form-inner form .pass-link a:hover,
    .form-inner form .signup-link a:hover {
      text-decoration: underline;
    }
    form .btn {
      height: 50px;
      width: 100%;
      border-radius: 5px;
      position: relative;
      overflow: hidden;
    }
    form .btn .btn-layer {
      height: 100%;
      width: 300%;
      position: absolute;
      left: -100%;
      background: -webkit-linear-gradient(
        right,
        #a445b2,
        #fa4299,
        #a445b2,
        #fa4299
      );
      border-radius: 5px;
      transition: all 0.4s ease;
    }
    form .btn:hover .btn-layer {
      left: 0;
    }
    form .btn input[type="submit"] {
      height: 100%;
      width: 100%;
      z-index: 1;
      position: relative;
      background: none;
      border: none;
      color: #fff;
      padding-left: 0;
      border-radius: 5px;
      font-size: 20px;
      font-weight: 500;
      cursor: pointer;
    }
    .hidelogin{
    transform: translateX(-400%);
    }
    .hidesignup{
        transform: translateX(400%);
    }
    .sign{
      display:flex;
    }
  </style>
  <body>
   

    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Login </div>
        <div class="title signup">Signup </div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked />
          <input type="radio" name="slide" id="signup" />
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form  method="POST" action='login.php' class="login">
            <div class="field">
              <input
                type="email"
                name="email"
                placeholder="Email Address"
                required />
            </div>
            <div class="field">
              <input
                type="password"
                name="password"
                placeholder="Password"
                required />
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit"  name="submit" value="Login" />
            </div>
            <div class="signup-link">
              Don't have an Account? <a href="">Signup now</a>
            </div>
          </form>
          <form  method="POST" action='create.php' enctype="multipart/form-data" id='signup' class="signup">
            <div class="field sign">
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="name" placeholder="Full Name" required>
              </div>
            <div class="field sign">
            <input type="text" name="company" placeholder="Company name" >
            <input type="number" name="contact" placeholder="Contact" required>
            </div>
            
            <div class="field sign">
              <div class="">
                <p>image</p>
               <input type="file" name="image" placeholder="Company Image" id='image' title="Company Image" required>             

              </div>
              <div class="">
                <p>logo</p>
               <input type="file" name="logo" placeholder="Logo" required>

              </div>
            </div>
            <div class="field ">
            <input type="text" name="location" placeholder="Location" required >
            </div>
            <div class="field ">
            <input type="password" name="password" placeholder="Password" required>
            </div>
            <label>Select Category</label>
            <div class="field" >
					<div class="field">
            <select name='category'>
						<option>sellect...</option>
						<option>Buyer</option>
						<option>Seller</option>
						<option>Service Provider</option>
					</select>
          </div>
					
				</div>
            
            
            
            <p><?php echo $error ?></p>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="submit" value="Signup" />
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>
  </body>
</html>
