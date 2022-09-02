<?php
$from = "testphp21@outlook.com";
$to = "ervipinthakur21@gmail.com";
$subject = "Test mail";
$message = "PHP mail works just fine";
$headers = "From:" . $from;
if(mail($to,$subject,$message,$headers)) {
    echo "The email message was sent.";
} else {
    echo "The email message was not sent.";
}
?>