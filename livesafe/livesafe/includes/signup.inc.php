<?php

    if (isset($_POST['signup-submit']))
    {
        require 'dbh.inc.php';

        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $pwd1 = $_POST['password_2'];

        if(empty($userName) || empty($email) || empty($pwd) || empty($pwd1))
        {
            header("Location: ../signup.php?error=emptyfields");
            exit();
        }
        else if(!preg_match("/^['a-zA-Z0-9']*$/",$userName))
        {
            header("Location: ../signup.php?error=invaliddetails");
            exit();
        }
        else if(!preg_match("/^['a-zA-Z0-9']*$/",$userName) && !preg_match("/^['a-zA-Z']*$/",$firstName) && !preg_match("/^['a-zA-Z']*$/",$lastName) && !preg_match("/^['0-9']*$/",$phone))
        {
            header("Location: ../signup.php?error=invaliddetails&county=".$county);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z0-9']*$/",$userName) && !preg_match("/^['a-zA-Z']*$/",$firstName) && !preg_match("/^['a-zA-Z']*$/",$lastName) && !preg_match("/^['a-zA-Z']*$/",$county))
        {
            header("Location: ../signup.php?error=invaliddetails&phone=".$phone);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z0-9']*$/",$userName) && !preg_match("/^['a-zA-Z']*$/",$firstName) && !preg_match("/^['a-zA-Z']*$/",$county))
        {
            header("Location: ../signup.php?error=invaliddetails&lastName=".$lastName);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z0-9']*$/",$userName) && !preg_match("/^['a-zA-Z']*$/",$lastName) && !preg_match("/^['0-9']*$/",$phone) && !preg_match("/^['a-zA-Z']*$/",$county))
        {
            header("Location: ../signup.php?error=invaliddetails&firstName=".$firstName);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z']*$/",$firstName)  && !preg_match("/^['a-zA-Z']*$/",$lastName) && !preg_match("/^['0-9']*$/",$phone) && !preg_match("/^['a-zA-Z']*$/",$county))
        {
            header("Location: ../signup.php?error=invaliddetails&userName=".$userName);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z0-9']*$/",$userName))
        {
            header("Location: ../signup.php?error=invaliddetails&firstName=".$firstName."&lastName=".$lastName."&email=".$email."&phone=".$phone."&county=".$county);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z']*$/",$firstName))
        {
            header("Location: ../signup.php?error=invaliddetails&userName=".$userName."&lastName=".$lastName."&email=".$email."&phone=".$phone."&county=".$county);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z']*$/",$lastName))
        {
            header("Location: ../signup.php?error=invaliddetails&userName=".$userName."&firstName=".$firstName."&email=".$email."&phone=".$phone."&county=".$county);
            exit();
        }
        else if(!preg_match("/^['0-9']*$/",$phone))
        {
            header("Location: ../signup.php?error=invaliddetails&userName=".$userName."&firstName=".$firstName."&lastName=".$lastName."&email=".$email."&county=".$county);
            exit();
        }
        else if(!preg_match("/^['a-zA-Z']*$/",$county))
        {
            header("Location: ../signup.php?error=invaliddetails&userName=".$userName."&firstName=".$firstName."&lastName=".$lastName."&email=".$email."&phone=".$phone);
            exit();
        }
        else if($pwd !== $pwd1)
        {
            header("Location: ../signup.php?error=passwordmatch&userName=".$userName."&firstName=".$firstName."&lastName=".$lastName."&email=".$email."&phone=".$phone."&county=".$county);
            exit();
        }
        else
        {
            $sql = "SELECT * FROM users WHERE userName=?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt,$sql))
            {
                header("Location: ../signup.php?error=sqlerror$userName=".$userName."&email=".$email);
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt,'s',$userName);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0)
                {
                    header("Location: ../signup.php?error=userexists");
                    exit();
                }
                else
                {
                    $sql = "INSERT INTO users(userName, email, password)  VALUES(?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql))
                    {
                        header("Location: ../signup.php?error=sqlerror&userName=".$userName."&email=".$email);
                        exit();
                    }
                    else
                    {
                        $hashPassword = password_hash($pwd,PASSWORD_DEFAULT);
                          mysqli_stmt_bind_param($stmt,'sss',$userName, $email,$hashPassword);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../index.php?signup=success");
                        exit();
                    }

                }
            }
        }
            mysqli_stmt_close($stmt);
    mysqli_close();
    }


    else
    {
        header("Location: ../signup.php");
        exit();
    }

    ?>
