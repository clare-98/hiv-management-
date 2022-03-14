<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="css/admin-orders.css">
         <link rel="stylesheet" href="css/signup.css">
    </head>
    <body>
        <div class="container">
            <div class="left">
                <div class="form">
                    <div class="logo">
                   <!--  <img src="img/logo.png" /> -->
                    </div>
                    <form action="includes/signup.inc.php" method="POST">
                    <div class="rende">
                    <?php
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
                        else if($_GET['error'] == "invaliddetails")
                        {
                            echo "
                                <div class='error'>
                                    Please provide valid details.
                                </div>
                            ";
                        }
                        else if($_GET['error'] == "passwordmatch")
                        {
                            echo "
                                <div class='error'>
                                    The passwords you gave do not match.
                                </div>
                            ";
                        }
                        else if($_GET['error'] == "phoneexists")
                        {
                            echo "
                                <div class='error'>
                                    Phone provided already exits.
                                </div>
                            ";
                        }
                    }
                ?>
                     <div>
                      <p><label>User Name</label></p>
                      <input type="text" name="userName" class="text-input">
                    </div>                    

                    <div class="rende">
                        <p><label>Email</label></p>
                        <input type="email" name="email" class="text-input">
                    </div>


                    <div class="rende">
                        <div>
                        <p><label>Password</label></p>
                        <input type="password" name="password" class="text-input">
                        </div>
                        <div>
                        <p><label>Confirm Password</label></p>
                        <input type="password" name="password_2" class="text-input">
                        </div>
                    </div>

                        <button type="submit" name="signup-submit" class="signup-btn">Sign Up</button>

                    </form>
                    <div class="already">
                        Already have an account?
                    </div>
                    <div>
                        <a href="index.php" class="login-btn">Log In</a>
                    </div>
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
