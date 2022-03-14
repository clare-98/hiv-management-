<?php

if(isset($_POST['login-submit']))
{
    require "dbh.inc.php";

    $mailphone = $_POST['mailphone'];
    $password = $_POST['password'];
    if(empty($mailphone) || empty($password))
    {
        header("location: ../admin-login.php?error=emptyfields");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: ../admin-login.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $mailphone);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_array($result))
            {
                $passwordCheck = password_verify($password, $row['password']);
                if($passwordCheck == false)
                {
                    header("location: ../admin-login.php?error=wrongpassword");
                    exit();
                }
                else if($passwordCheck == true)
                {
                    session_start();

                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];

                    header("location: ../admin.php");
                    exit();
                }
                else
                {
                    header("location: ../admin-login.php?error");
                    exit();
                }
            }
            else
            {
                header("location: ../admin-login.php?error=nouser");
                exit();
            }
        }
    }

}

else
{
    header("location: ../admin-login.php");
    exit();
}

?>