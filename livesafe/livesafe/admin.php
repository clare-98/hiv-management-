<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <header background color="teal"><br>

   <!--  <h1 align="center"><img src="download.jpg" alt=""  width="250px" height="50px"  ></h1> -->
    <h1 align="center"><b>LIVE SAFE</b></h1>

    </header>
<title>Home</title>
<link rel="stylesheet" href="css/admin-orders.css">
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="admin.php">
               <!--  <img src="download.jpg"> -->
            </a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="admin.php">Home</a></li>
                <li><a href="admin-orders.php">View Orders</a></li>
                <li><form action="includes/logout.inc.php"> <button class="logout-btn">Log Out</button></form></li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="content">
        <div class="hello">
           <?php 

            require 'includes/dbh.inc.php';
            $sql = "SELECT * FROM admin WHERE id = 1";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];

                echo "Hello,".$username;
            }


         ?><strong>
        </div>
        <div class="products">
            <div class="admin-add">
                <h2 style="color: orange">Add Products</h2>
          
                The products you add here will be viewed directly by customers.<br>
            </div>
            <?php
                    if(isset($_GET['add']))
                    {
                        echo "
                            <div class='success'>
                                Product added successfully.
                            </div>

                        ";
                    }
                ?>
            <div id="content">
            <form action="admin.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div>
                    <input type="file" name="image">
                </div>
                <div>
                    <label style="color: orange">Product Name</label>
                    <input type="text" name="product_name">
                </div>
                <div>
                    <label style="color: orange">Description</label>
                    <input type="text" name="description">
                </div>
                <div>
                    <button type="submit" name="submit">Submit</button>
                </div>
                
            </form>
            </div>
            <hr>
            <?php
                if(isset($_POST['submit']))
                {
                    require "includes/dbh.inc.php";
                    $target = "images/".basename($_FILES['image']['name']);
                    $image = $_FILES['image']['name'];
                    $name = $_POST['product_name'];
                    $description = $_POST['description'];
                    $available = 1;

                    $sql = "INSERT INTO products(image, product_name, available, description) VALUES('$image','$name', '$available', '$description')";
                    if(mysqli_query($conn, $sql))
                    {
                        echo "
                            <div class='success'>
                                Product added successfully.
                            </div>
                        ";
                    }
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
                    {
                        $msg = "Image uploaded successfully";
                    }
                    else
                    {
                        $msg = "There was a problem uploading image";
                    }
                }
            ?>
            <h3 align="center"><u>AVAILABLE PRODUCTS</u></h3>
            <?php
                require "includes/dbh.inc.php";
                $sql = "SELECT * FROM products WHERE available=1";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    $name = $row['product_name'];
                    $description = $row['description'];
                    $id = $row['product_id'];
                    echo "
                        <div id='img_div'>
                            <h3  style=color:orange>Name:</h3> $name<br>
                            <img src = 'images/".$row['image']."'>
                            <br>
                            <h3 style=color:orange>Description:</h3> $description<br>
                            <form action='admin.php' method='POST'>
                                <input type='hidden' name='id' value=$id>
                                <button type='submit' name='remove'>Remove</button>
                            </form>
                        </div>
                    ";
                }
                if(isset($_POST['remove']))
                {
                    require "includes/dbh.inc.php";
                    $id = $_POST['id'];
                    $sql = "UPDATE products SET available = 0 WHERE product_id = '$id'";
                    mysqli_query($conn, $sql);
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