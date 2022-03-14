<?php

session_start();
if(isset($_POST['msubmit']))
{
    require 'dbh.inc.php';
    
    $email = $_POST['new-mail'];
    $phone = $_POST['new-phone'];

    if(empty($email) && empty($phone))
    {
        header("location: ../profile.php?error=emptyfields");
        exit();
    }
    else if(empty($email))
    {
        $oldmail = $_SESSION['email'];
        $sql = "UPDATE users SET phone = '$phone' WHERE email = '$oldmail'";
        mysqli_query($conn, $sql);
        header("location: ../profile.php?update=success");
        exit();
    }
    else if(empty($phone))
    {
        $oldmail = $_SESSION['email'];
        $sql = "UPDATE users SET email = '$email' WHERE email = '$oldmail'";
        mysqli_query($conn, $sql);
        header("location: ../profile.php?update=success");
        exit();
    }
    else
    {
        $oldmail = $_SESSION['email'];
        $sql = "UPDATE users SET email = '$email', phone = '$phone' WHERE email = '$oldmail'";
        mysqli_query($conn, $sql);
        header("location: ../profile.php?update=success");
        exit();
    }
}

else
{
    header("location: ../index.php");
    exit();
}

?>