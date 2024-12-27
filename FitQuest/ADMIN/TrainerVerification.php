<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Trainer Verification</title>
</head>

<body>
<?php
ob_start();

include("../ASSETS/Connection/connection.php");

if(isset($_GET["eid"])) {
    $upQ = "update tbl_trainer set trainer_status=1 where trainer_id='".$_GET["eid"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Trainer Accepted"); window.location="TrainerVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Accept Trainer"); window.location="TrainerVerification.php"; </script>
    <?php }
}

if(isset($_GET["did"])) {
    $upQ = "update tbl_trainer set trainer_status=2 where trainer_id='".$_GET["did"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Trainer Rejected"); window.location="TrainerVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Reject Trainer"); window.location="TrainerVerification.php"; </script>
    <?php }
}

if(isset($_GET["rid"])) {
    $upQ = "update tbl_trainer set trainer_status=2 where trainer_id='".$_GET["rid"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Trainer Rejected"); window.location="TrainerVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Reject Trainer"); window.location="TrainerVerification.php"; </script>
    <?php }
}

if(isset($_GET["aid"])) {
    $upQ = "update tbl_trainer set trainer_status=1 where trainer_id='".$_GET["aid"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Trainer Accepted"); window.location="TrainerVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Accept Trainer"); window.location="TrainerVerification.php"; </script>
    <?php }
}
?>

<div id="tab">
    <form id="form1" name="form1" method="post" action="">
        <br><br><br>
        <!-- Pending List Table -->
        <table align="center" width="100%" border="1">
            <tr>
                <td height="44" colspan="12" align="center" id='login-details'>PENDING LIST</td>
            </tr>
            <tr>
                <th>SL.NO</th>
                <th>NAME</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>GENDER</th>
                <th>PHOTO</th>
                <th>PROOF</th>
                <th>ACTION</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "select * from tbl_trainer where trainer_status=0";
            $row = $con->query($selQry);
            while($data = $row->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $data["trainer_name"];?></td>
                <td><?php echo $data["trainer_contact"];?></td>
                <td><?php echo $data["trainer_email"];?></td>
                <td align='center'><?php echo $data["trainer_gender"];?></td>
                <td>
                    <img src="../ASSETS/Files/Trainer/Photo/<?php echo $data['trainer_photo'] ?>" width="200px" class="modalImage" data-image="../ASSETS/Files/Trainer/Photo/<?php echo $data['trainer_photo'] ?>"/>
                    <br>
                    <a href="../ASSETS/Files/Trainer/Photo/<?php echo $data['trainer_photo'] ?>" download class="DFG">Download</a>
                </td>
                <td>
                    <img src="../ASSETS/Files/Trainer/Proof/<?php echo $data['trainer_proof'] ?>" width="200px" class="modalImage" data-image="../ASSETS/Files/Trainer/Proof/<?php echo $data['trainer_proof'] ?>"/>
                    <br>
                    <a href="../ASSETS/Files/Trainer/Proof/<?php echo $data['trainer_proof'] ?>" download class="DFG">Download</a>
                </td>
                <td align="center">
                    <a href="TrainerVerification.php?eid=<?php echo $data["trainer_id"]?>" class="GFG">ACCEPT</a>
                    <a href="TrainerVerification.php?did=<?php echo $data["trainer_id"]?>" class="RFG">REJECT</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <!-- Accepted List Table -->
        <br><br><br>
        <table width="100%" border="1">
            <tr>
                <td height="44" colspan="12" align="center" id='login-details'>ACCEPTED LIST</td>
            </tr>
            <tr>
                <th>SL.NO</th>
                <th>NAME</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>GENDER</th>
                <th>PHOTO</th>
                <th>PROOF</th>
                <th>ACTION</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "select * from tbl_trainer where trainer_status=1";
            $res = $con->query($selQry);
            while($value = $res->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $value["trainer_name"];?></td>
                <td><?php echo $value["trainer_contact"];?></td>
                <td><?php echo $value["trainer_email"];?></td>
                <td align='center'><?php echo $value["trainer_gender"];?></td>
                <td>
                    <img src="../ASSETS/Files/Trainer/Photo/<?php echo $value['trainer_photo'] ?>" width="200px" class="modalImage" data-image="../ASSETS/Files/Trainer/Photo/<?php echo $value['trainer_photo'] ?>"/>
                    <br>
                    <a href="../ASSETS/Files/Trainer/Photo/<?php echo $value['trainer_photo'] ?>" download class="DFG">Download</a>
                </td>
                <td>
                    <img src="../ASSETS/Files/Trainer/Proof/<?php echo $value['trainer_proof'] ?>" width="200px" class="modalImage" data-image="../ASSETS/Files/Trainer/Proof/<?php echo $value['trainer_proof'] ?>"/>
                    <br>
                    <a href="../ASSETS/Files/Trainer/Proof/<?php echo $value['trainer_proof'] ?>" download class="DFG">Download</a>
                </td>
                <td align="center">
                    <a href="TrainerVerification.php?rid=<?php echo $value["trainer_id"]?>" class="RFG">REJECT</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <!-- Rejected List Table -->
        <br><br><br>
        <table width="100%" border="1">
            <tr>
                <td height="44" colspan="12" align="center" id='login-details'>REJECTED LIST</td>
            </tr>
            <tr>
                <th>SL.NO</th>
                <th>NAME</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>GENDER</th>
                <th>PHOTO</th>
                <th>PROOF</th>
                <th>ACTION</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "select * from tbl_trainer where trainer_status=2";
            $result = $con->query($selQry);
            while($val = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $val["trainer_name"];?></td>
                <td><?php echo $val["trainer_contact"];?></td>
                <td><?php echo $val["trainer_email"];?></td>
                <td align='center'><?php echo $val["trainer_gender"];?></td>
                <td>
                    <img src="../ASSETS/Files/Trainer/Photo/<?php echo $val['trainer_photo'] ?>" width="200px" class="modalImage" data-image="../ASSETS/Files/Trainer/Photo/<?php echo $val['trainer_photo'] ?>"/>
                    <br>
                    <a href="../ASSETS/Files/Trainer/Photo/<?php echo $val['trainer_photo'] ?>" download class="DFG">Download</a>
                </td>
                <td>
                    <img src="../ASSETS/Files/Trainer/Proof/<?php echo $val['trainer_proof'] ?>" width="200px" class="modalImage" data-image="../ASSETS/Files/Trainer/Proof/<?php echo $val['trainer_proof'] ?>"/>
                    <br>
                    <a href="../ASSETS/Files/Trainer/Proof/<?php echo $val['trainer_proof'] ?>" download class="DFG">Download</a>
                </td>
                <td align="center">
                    <a href="TrainerVerification.php?aid=<?php echo $val["trainer_id"]?>" class="GFG">ACCEPT</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </form>
</div>
</body>
</html>
