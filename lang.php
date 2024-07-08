<?php
session_start();
$lang=$_GET['language'];
$_SESSION['lang']=$lang;
print_r($_SESSION);
header('location: ./index.php');


?>