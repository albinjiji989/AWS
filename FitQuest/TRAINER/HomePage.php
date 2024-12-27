
<?php
ob_start();
include("../ASSETS/Connection/connection.php");
session_start();
$trainerid=$_SESSION['tid'];
$selq="select trainer_name from tbl_trainer where trainer_id='".$trainerid."'";
$row=$con->query($selq);
$data=$row->fetch_assoc();
$trainername=$data["trainer_name"];
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
<h1>Welcome  <?php  echo $trainername;?></h1>

            

<?php

ob_flush();
?>


    
</body>
</html>