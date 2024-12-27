
<?php
ob_start();
include("../ASSETS/Connection/connection.php");
session_start();
$nutritionistid=$_SESSION['nid'];
$selq="select nutrition_name from tbl_nutrition where nutrition_id='".$nutritionistid."'";
$row=$con->query($selq);
$data=$row->fetch_assoc();
$nutritionistname=$data["nutrition_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="logout.php" class="logout-link">Logout</a>
<h1>Welcome  <?php  echo $nutritionistname;?></h1>

            

<?php

ob_flush();
?>


    
</body>
</html>