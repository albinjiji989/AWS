
<?php
ob_start();
include("../ASSETS/Connection/connection.php");
session_start();
$userid=$_SESSION['uid'];
$selq="select user_name from tbl_user where user_id='".$userid."'";
$row=$con->query($selq);
$data=$row->fetch_assoc();
$username=$data["user_name"];
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
<h1>Welcome  <?php  echo $username;?></h1>

            

<?php

ob_flush();
?>


    
</body>
</html>