<?php
$receiver ="20102164@apsit.edu.in";
$subject = "Emailjdkshf";
$body = "Hi, there...This is a test email send from Localhost.";
$sender = "From:20102164.meghasoni@gmail.com";

if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}
?>