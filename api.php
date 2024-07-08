<?php

    include 'dbinit.php';

    header('Access-Control-Allow-Orign:*');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Method:GET');
    header('Access-Control-Allow-Headers:Content-type,Access-Control-Allow-Headers,Authorization,X-Request-With  ');

    $sql="SELECT * FROM users";
    $results =mysqli_query($conn,$sql);
    $users=mysqli_fetch_all($results,MYSQLI_ASSOC);

    echo json_encode($users);









?>