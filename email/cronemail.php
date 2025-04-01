<?php
    $name = "Cron Job E-mail";
    $visitor_email = "zurnergymedia@gmail.com";
    $message = "A new mail from the Cron Job to tell the hourly.";


    $email_from = 'james@martville.app';

    $email_subject = 'New Mail from Cron Job';

    $email_body = "User Name: $name.\n".
                    "User Email: $visitor_email.\n". 
                    "User Message: $message.\n";

    $to = "ioadejuwon@gmail.com";

    $headers =  "From: $email_from \r\n";
    $headers = "Reply-To: $visitor_email \r\n";


    if(mail($to,$email_subject,$email_body,$headers) == true ){
        echo "Done";
    }else{
        echo "False";
    }
    
?>