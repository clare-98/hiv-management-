<!DOCTYPE html>
<html>
<head>
<title>Log In</title>
<link rel="stylesheet" href="css/admin-orders.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="form">
                <div class="logo">
                    <img src="img/logo.png" />
                </div>
                <?php
                    if(isset($_GET['signup']))
                    {
                        echo "
                            <div class='success'>
                                Registered successfully. Please login.
                            </div>
                        ";
                    }
                    if(isset($_GET['error']))
                    {
                        if($_GET['error'] == "emptyfields")
                        {
                            echo "
                                <div class='error'>
                                    Please fill in all fields!
                                </div>
                            ";
                        }
                        else if($_GET['error'] == "wrongpassword")
                        {
                            echo "
                                <div class='error'>
                                    Incorrect password!
                                </div>
                            ";
                        }
                        else if($_GET['error'] == "nouser")
                        {
                            echo "
                                <div class='error'>
                                    No user found!
                                </div>
                            ";
                        }
                    }
                ?>
                <form action="includes/login.inc.php" method="POST">
                    <div>
                        <label>Email/Phone Number</label>
                        <input type="text" name="mailphone" class="text-input">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" class="text-input">
                    </div>
                    <button type="submit" name="login-submit" class="signupl-btn">Log In</button>
                </form>
                <div class="links">
                    
                </div>
                <div class="or">
                    <hr class="bar">
                    <span>OR</span>
                    <hr class="bar">
                </div>
                <a href="signup.php" class="loginl-btn">Create an Account</a>
            </div>
        </div>
        <div class="right">
            <div class="showcase">
                <div class="showcase-content">
                    <h1></h1>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
