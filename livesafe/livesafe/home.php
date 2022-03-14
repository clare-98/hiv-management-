<?php
    session_start();
    require "includes/dbh.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Contact</title>
<!-- <link rel="stylesheet" href="css/contact-us.css"> -->
<link rel="stylesheet" type="text/css" href="css/home.css">

</head>
<body>
    <div class="header">
        <div class="logo">
            <!-- <img src="img/logo.png"> -->
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
            <h3 align="center"><u>AVAILABLE PRODUCTS</u></h3>
            <?php
                $sql = "SELECT * FROM products WHERE available=1";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['product_id'];
                    $name = $row['product_name'];
                    $image = $row['image'];
                    $description = $row['description'];
                    $_SESSION['id'] = $id;
                    echo "
                        <div id='img_div'>
                           <h3 style=color:orange> Name:</h3> $name<br>
                            <img src = 'images/".$row['image']."'>
                            <h3 style=color:orange>Description:</h3> $description<br>
                            <form action='order.php' method='POST'>
                                <input type='hidden' name='pid' value='$id'>
                                <button type='submit' name='order'>Order</button>
                            </form>
                        </div><br><br>
                        <div class='table'>

                            <tr>
                                <th>S.N</th>
                                <th>PRODUCT</th>
                                <th>IMAGE</th>
                                <th>DESCRIPTION</th>
                            </tr>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
    <hr>
    <div class="footer">
        Copyright 2022 | All Rights Reserved
    </div>
</body>
</html>