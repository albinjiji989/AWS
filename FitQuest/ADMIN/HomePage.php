<?php
ob_start();
include("../ASSETS/Connection/connection.php");
session_start();
$adminid=$_SESSION['aid'];
$selq="select admin_name from tbl_admin where admin_id='".$adminid."'";
$row=$con->query($selq);
$data=$row->fetch_assoc();
$adminname=$data["admin_name"];
?>

<h1 style="font-size: 90px;" data-animation="fadeInLeft" data-delay="0.4s">Welcome  <?php  echo $adminname;?></h1>
<!-- Top-right Logout Section -->
<div id="logout-container">
    <a href="logout.php" class="logout-link">Logout</a>
</div>

<!-- Sidebar Start -->
<div id="sidebar">
    <ul>
        <!-- ADD LOCATION Section -->
        <li><strong>ADD LOCATION</strong></li>
        <li><a href="district.php">District</a></li>
        <li><a href="place.php">Place</a></li>

        <!-- VERIFICATION Section -->
        <li><strong>VERIFICATION</strong></li>
        <li><a href="TrainerVerification.php">Trainer Verification</a></li>
        <li><a href="NutritionistVerification.php">Nutritionist Verification</a></li>

        <!-- ADD CATEGORY Section -->
        <li><strong>ADD CATEGORY</strong></li>
        <li><a href="category.php">Add Category</a></li>
    </ul>
</div>
<!-- Sidebar End -->

<!-- User, Trainer, and Nutritionist Count Section -->
<div>
    <div>
        <i class="fa fa-user fa-3x text-primary"></i>
        <div>
            <a href="HomePage.php?did">
                <p>Total Users</p></a>
            <?php
                $selQry = "select coalesce(count(*),0) as user from tbl_user";
                $row = $con->query($selQry);
                $data = $row->fetch_assoc();
            ?>
            <h6><?php echo $data["user"] ?></h6>
        </div>
    </div>
    <div>
        <i class="fa fa-users fa-3x text-primary"></i>
        <div>
            <a href="HomePage.php?cid">
                <p>Total Trainers</p></a>
            <?php
                $selQr = "select coalesce(count(*),0) as train from tbl_trainer where trainer_status=1";
                $row1 = $con->query($selQr);
                $data1 = $row1->fetch_assoc();
            ?>
            <h6><?php echo $data1["train"] ?></h6>
        </div>
    </div>
    <div>
        <i class="fa fa-users fa-3x text-primary"></i>
        <div>
            <a href="HomePage.php?bid">
                <p>Total Nutritionists</p></a>
            <?php
                $selQ = "select coalesce(count(*),0) as nut from tbl_nutrition where nutrition_status=1";
                $row2 = $con->query($selQ);
                $data2 = $row2->fetch_assoc();
            ?>
            <h6><?php echo $data2["nut"] ?></h6>
        </div>
    </div>
</div>

<!-- User List Section -->
<div>
    <h6>User List</h6>
    <a href="">Show All</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Registration</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET["did"])) {
                $selU = "select * from tbl_user";
                $rowU = $con->query($selU);
                while ($dataU = $rowU->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $dataU["user_name"] ?></td>
                        <td><?php echo $dataU["user_email"] ?></td>
                        <td><?php echo $dataU["user_date"] ?></td>
                        <td><?php echo $dataU["user_contact"] ?></td>
                    </tr>
            <?php
                }
            }

            if (isset($_GET["cid"])) {
                $selU = "select * from tbl_trainer";
                $rowU = $con->query($selU);
                while ($dataU = $rowU->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $dataU["trainer_name"] ?></td>
                        <td><?php echo $dataU["trainer_email"] ?></td>
                        <td><?php echo $dataU["trainer_date"] ?></td>
                        <td><?php echo $dataU["trainer_contact"] ?></td>
                    </tr>
            <?php
                }
            }

            if (isset($_GET["bid"])) {
                $selU = "select * from tbl_nutrition";
                $rowU = $con->query($selU);
                while ($dataU = $rowU->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $dataU["nutrition_name"] ?></td>
                        <td><?php echo $dataU["nutrition_email"] ?></td>
                        <td><?php echo $dataU["nutrition_date"] ?></td>
                        <td><?php echo $dataU["nutrition_contact"] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php
ob_flush();
?>
