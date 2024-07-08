<?php

// $arr=array(9,1,3,4,5,6,7,);
// function fil(int $val){
//     return ($val>3);
// }

// print_r(array_filter($arr,'fil')) ;
// function test_odd(int $var)
//   {
//   return($var & 1);
//   }

// $a1=array(1,3,2,3,4);
// print_r(array_filter($a1,"test_odd"));

function  getLikes($BlogId)
{include './dbinit.php';
  $sql="SELECT * FROM likes WHERE blogId=$BlogId";
  $results =mysqli_query($conn,$sql);
  $likes=mysqli_fetch_all($results,MYSQLI_ASSOC);
  print_r($likes);
  return count($likes);
  

  
}
getlikes(2);

?>