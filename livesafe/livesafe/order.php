<?php
    session_start();
    require "includes/dbh.inc.php";
    $id = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Contact</title>
<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="css/admin-orders.css">
</head>
<body>
    <div class="header">
        <div class="logo">
           <!--  <img src="img/logo.png"> -->
        </div>
        <div class="menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="contact-us.php">Contact Us</a></li>
                <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="content">
        <div class="products">
            <h2>Order</h2>
            <?php

                $sql = "SELECT * FROM orders WHERE user_id = $id";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $name = $row['pname'];
                     $image = $row['image'];
                    $description = $row['description'];
                    $_SESSION['id'] = $id;
                }
                echo "
                    <div id='img_div'>
                        Name: <span style=color:#D41CA2>$name</span><br>
                        <img src = 'images/".$image."'><br>
                        Description: <span style=color:coral> $description</span><br>
                        <form action='order.php' method='POST'>
                            <button type='submit' name='place'>Place Order</button>
                        </form>
                    </div>
                ";

                if(isset($_POST['place']))
                {
                    session_start();
                    $uid = $_SESSION['uid'];
                    echo $uid;
                    $checked = 1;
                    $sql = "INSERT INTO orders(user_id, product_id, pname,image, checked) VALUES('$uid', '$id', '$name','$image', '$checked')";
                    $result = mysqli_query($conn, $sql);
                    if($result)
                    {
                        header("location: order.php?order=success");
                        exit();
                    }
                    else
                    {
                        header("location: order.php?error=order");
                        exit();
                    }
                }
                
            ?>
        </div>
        <div class="result">
            <?php
                if(isset($_GET['order']))
                {
                    echo "
                        <div class='success'>
                            Order placed successfully. Please await confirmation.
                        </div>
                    ";
                }
                else if(isset($_GET['error']))
                {
                    echo "
                        <div class='error'>
                            You already placed this order.
                        </div>
                    ";
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