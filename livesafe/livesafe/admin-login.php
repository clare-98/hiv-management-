<!DOCTYPE html>
<html>
<head>
<title>Log In</title>
<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="css/contact-us.css">

</head>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="form">
                <div class="logo">
                   <!--  <img src="images/arv1.jpg" /> -->
                   <h1 style="align: center">LIVE SAFE</h1>
                </div>
                <form action="includes/admin-login.inc.php" method="POST">
                    <div>
                        <h3 style="color: coral"><u>ADMIN LOGIN</u></h3>
                    </div>
                    <div>
                        <label>Username</label>
                        <input type="text" name="mailphone" class="text-input">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" class="text-input">
                    </div>
                    <button type="submit" name="login-submit" class="signupl-btn">Log In</button>
                </form>
                <div class="links">
                    <a href="#">Forgot Password</a>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="showcase">
                <div class="showcase-content">
                    <form action="admin-signup.inc.php" method="POST">
                        <div>
                            <h3 style="color:coral"><u>ADMIN SIGNUP</u></h3>
                        </div>
                        <div>
                            <label>Username</label>
                            <input type="text" name="userName">
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" name="password">
                        </div>
                         <div>
                            <label>Confirm Password</label>
                            <input type="password" name="password1">
                        </div>
                         <div>
                            <input type="submit" name="signup-submit" value="SIGNUP">
                        </div>
                </div>
               
                    <div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
