<?php
function generateOTP() {
    // Generate a random number between 10000 and 99999
    $otp = mt_rand(10000, 99999);
    return $otp;
}
include './dbinit.php' ;

$keys=array(
    'mutangizir@gmail.com'=>'re_GXPbKyg6_Pon9wTgNMQjidfLa6Ve8Agi2',
    "maizemarketing3@gmail.com"=>"re_9uAXyzkR_3hxmk2m6yk4eUTv9sv9L72cN"
);
function Checkemail($email) : String {
    global $keys; 
    
    if (array_key_exists($email, $keys)) {
        return $keys[$email];
    } else {
        return "Email not found.";
    }
}

function sendEmail($to, $subject, $body,$id) {
    $apiKey = Checkemail($to);
    $url = 'https://api.resend.com/emails';

    $data = [
        'to' => $to,
        'subject' => $subject,
        'html' =>(string) $body,
        'from' => 'maize market <ugmaize@resend.dev>'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

   

    if ($httpCode >= 200 && $httpCode < 300) {
        if ($id!=null) {
            header('location:./verify.php?status=success&&id='.base64_encode($id));
        print_r($response);
        }
        
    } else {
    if ($id!=null) {
         header('location:./verify.php?status=failed&&di='.base64_encode($id));
        print_r($response);
    }
       
        // return [
        //     'error' => true,
        //     'http_code' => $httpCode,
        //     'response' => json_decode($response, true)
        // ];
    }

    
    curl_close($ch);

    return $response;
}

if (isset($_GET['id'])) {
    $id=base64_decode($_GET['id']);
    $email=base64_decode($_GET['email']);
    echo $id;
    echo $email;
    $otp=generateOTP();
    $sql="INSERT INTO otps (userId,otp) values ($id,'$otp')";
    if (mysqli_query($conn,$sql)) {
       sendEmail($email,'please verify your account',$otp,$id);
    }
    
}

?>
