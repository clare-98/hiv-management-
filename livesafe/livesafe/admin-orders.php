<?php
    session_start();
    require "includes/dbh.inc.php";
    $_SESSION['username'] = $user;
?>
<!DOCTYPE html>
<html>
<head>
        <header>

    <h1 align="center"><img src="images/download.jpg" alt=""  width="250px" height="50px"  ></h1>
    <h1 align="center"><b>LIVE SAFE</b></h1>

    </header>
<title>Home</title>
<link rel="stylesheet" href="css/admin-orders.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="admin.php">
                
            </a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="admin.php">Home</a></li>
                <li><a href="admin-orders.php ">View Orders</a></li>
                <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="content">
        <div class="hello">
            Hello there, <strong><?php echo $_SESSION['username']; ?></strong>
        </div>
        <div class="products">
              <h2 style="color: red">Here are the customer order details.</h2><br>
            <?php
                $sql = "SELECT * FROM orders WHERE checked=1";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $user = $row['user_id'];
                    $orderid = $row['product_id'];
                    $pname = $row['pname'];
                    $sql = "SELECT * FROM users WHERE userId = '$user'";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $name = $row['firstName'] . " " . $row['lastName'];
                        $phone = $row['phone'];
                        $email = $row['email'];
                        $county = $row['county'];
                    }
                    echo "
                        <div class='order'>
                            Product name: $pname<br>
                            User Name: $name<br>
                            Phone: $phone<br>
                            Email: $email<br>
                            County: $county<br>
                            <form action='admin-orders.php' method='POST'>
                                <button type='submit' name='hey'>Check</button>
                            </form>
                        </div>
                    ";
                    if(isset($_POST['hey']))
                    {
                        $sql = "UPDATE orders SET checked=1 WHERE id = '$orderid'";
                        $result = mysqli_query($conn, $sql);
                    }
                
                }
            ?>       
        </div>
    </div>
    <hr>
    <div class="footer">
        Copyright &copy 2019 | All Rights Reserved
    </div>
</body>
</html>