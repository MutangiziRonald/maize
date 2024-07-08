<?php

include './dbinit.php';
if (!isset($_GET['status']) || !isset($_GET['id'])) {
    header('location:./index.php');
}
$chances=3;
$id=base64_decode($_GET['id']); 
if (isset($_POST['submit'])) {
    $input1=$_POST['input1'];
    $input2=$_POST['input2'];
    $input3=$_POST['input3'];
    $input4=$_POST['input4'];
    $input5=$_POST['input5'];
    $otp=$input1.$input2.$input3.$input4.$input5;
    $sql="SELECT * FROM otps WHERE otp='$otp' AND userId=$id ";
    $results =mysqli_query($conn,$sql);
    $otps=mysqli_fetch_all($results,MYSQLI_ASSOC);
    if (count($otps)>0) {
        $sql="UPDATE users set status='verified' where id=$id";
        if (mysqli_query($conn,$sql)) {
			header('location: ./login.php');
		}else{
            if ($chances==0) {
                header('location: ./index.php');
            }else{
                $chances=$chances-1;
            }
        }
    }
}


?>


<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>OTP Verification Form</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <script src="script.js" defer></script>
   <style>
    /* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4070f4;
}
:where(.container, form, .input-field, header) {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.container {
  background: #fff;
  padding: 30px 65px;
  border-radius: 12px;
  row-gap: 20px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.container header {
  height: 65px;
  width: 65px;
  background: #4070f4;
  color: #fff;
  font-size: 2.5rem;
  border-radius: 50%;
}
.container h4 {
  font-size: 1.25rem;
  color: #333;
  font-weight: 500;
}
form .input-field {
  flex-direction: row;
  column-gap: 10px;
}
.input-field input {
  height: 45px;
  width: 42px;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.input-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.input-field input::-webkit-inner-spin-button,
.input-field input::-webkit-outer-spin-button {
  display: none;
}
form button {
  margin-top: 25px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 6px;
  pointer-events: none;
  background: #6e93f7;
  transition: all 0.2s ease;
}
form button.active {
  background: #4070f4;
  pointer-events: auto;
}
form button:hover {
  background: #0e4bf1;
}
   </style>
  </head>
  <body>
    
    <?php if ($_GET['status']=='failed') {?>
        <div class="container">
      <header>
        <i class="bx bxs-check-shield"></i>
      </header>
      <h4>Internal Server Error</h4>
      
    </div>
    <?php } ?>
    <?php if ($_GET['status']=='success') {?>
        <div class="container">
      <header>
        <i class="bx bxs-check-shield"></i>
      </header>
      <h4>Enter OTP Code</h4>
      <form action="#" method="POST">
        <div class="input-field">
          <input name='input1' type="number" />
          <input name='input2' type="number" disabled />
          <input name='input3' type="number" disabled />
          <input name='input4' type="number" disabled />
          <input name='input5' type="number" disabled />
        </div>
        
        <button name='submit'>Verify OTP</button>
      </form>
    </div>
    <?php } ?>
    <script>
         const inputs = document.querySelectorAll("input"),
  button = document.querySelector("button");

inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
  
    const currentInput = input,
      nextInput = input.nextElementSibling,
      prevInput = input.previousElementSibling;

    
    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }
    
    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }
//dododopd hjiujjdd
    if (e.key === "Backspace") {
      inputs.forEach((input, index2) => {
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }
  
    if (!inputs[3].disabled && inputs[4].value !== "") {
      button.classList.add("active");
      return;
    }
    button.classList.remove("active");
  });
});


window.addEventListener("load", () => inputs[0].focus());
    </script>
  </body>
</html>