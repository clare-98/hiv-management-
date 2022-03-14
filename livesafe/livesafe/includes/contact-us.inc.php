<?php
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $mailTo = "gichungasteve6@gmail.com";
        $headers = "From: ". $email;
        $txt = "You have received an email from". $name ."\n\n". $phone ."\n\n". $message;

        if(mail($mailTo, $subject, $txt, $headers))
        {
            header("location: ../contact-us.php?mailsent=1");
            exit();
        }
        else
        {
            header("location: ../contact-us.php?error=1");
            exit();
        }
    }
?>