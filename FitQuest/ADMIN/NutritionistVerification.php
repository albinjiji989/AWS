<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Verification</title>
<!-- <style> 
    .GFG { 
        background-color: green; 
        border: 2px solid black; 
        color: green; 
        padding: 5px 10px; 
        text-align: center; 
        display: inline-block; 
        font-size: 20px; 
        margin: 10px 30px; 
        cursor: pointer; 
    } 

    .RFG { 
        background-color: red; 
        border: 2px solid black; 
        color: green; 
        padding: 5px 10px; 
        text-align: center; 
        display: inline-block; 
        font-size: 20px; 
        margin: 10px 30px; 
        cursor: pointer; 
    }

    .DFG { 
        background-color: dodgerblue; 
        border: 2px solid black; 
        color: green; 
        padding: 5px 10px; 
        text-align: center; 
        display: inline-block; 
        font-size: 20px; 
        margin: 10px 30px; 
        cursor: pointer; 
    }

    #login-details {
        margin-top: 3rem;
        margin-left: 1rem;
        font-size: 1.5rem;
    }
    
    label {
        font-family: 'Inter', sans-serif;  
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 80%;
        max-height: 80%;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }
    .trainerModalImage {
            cursor: pointer;
        }
</style> -->
</head>

<body>
<?php
ob_start();
include("../ASSETS/Connection/connection.php");

if(isset($_GET["eid"])) {
    $upQ = "update tbl_nutrition set nutrition_status=1 where nutrition_id='".$_GET["eid"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Nutritionist Accepted"); window.location="NutritionistVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Accept Nutritionist"); window.location="NutritionistVerification.php"; </script>
    <?php }
}

if(isset($_GET["did"])) {
    $upQ = "update tbl_nutrition set nutrition_status=2 where nutrition_id='".$_GET["did"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Nutritionist Rejected"); window.location="NutritionistVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Reject Nutritionist"); window.location="NutritionistVerification.php"; </script>
    <?php }
}

if(isset($_GET["rid"])) {
    $upQ = "update tbl_nutrition set nutrition_status=2 where nutrition_id='".$_GET["rid"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Nutritionist Rejected"); window.location="NutritionistVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Reject Nutritionist"); window.location="NutritionistVerification.php"; </script>
    <?php }
}

if(isset($_GET["aid"])) {
    $upQ = "update tbl_nutrition set nutrition_status=1 where nutrition_id='".$_GET["aid"]."' ";
    if($con->query($upQ)) { ?>
        <script> alert("Nutritionist Accepted"); window.location="NutritionistVerification.php"; </script>
    <?php } else { ?>
        <script> alert("Failed to Accept Nutritionist"); window.location="NutritionistVerification.php"; </script>
    <?php }
}
?>


    <form id="form1" name="form1" method="post" action="">
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
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "select * from tbl_nutrition where nutrition_status=0";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["nutrition_name"]; ?></td>
                    <td><?php echo $data["nutrition_contact"]; ?></td>
                    <td ><?php echo $data["nutrition_email"]; ?></td>
                    <td align='center'><?php echo $data["nutrition_gender"]; ?></td>
                    <td >
                        <img src="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>" width="200px"
                             class="modalImage"
                             data-image="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>"/>
                             <br>
                             <a href="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>" download
                                      
                                      class="DFG">Download</a>
                    </td>
                    <td ><img src="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>" width="200px"
                             class="modalImage"data-image="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>"/>
                            <br>
                        <a href="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>" download
                                      
                                      class="DFG">Download</a></td>
                    <td align="center">
                        <a href="NutritionistVerification.php?eid=<?php echo $data["nutrition_id"] ?>"
                            class="GFG">ACCEPT</a>
                        <a href="NutritionistVerification.php?did=<?php echo $data["nutrition_id"] ?>"
                            class="RFG">REJECT</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <table align="center" width="100%" border="1">
            <tr>
                <td align="center" colspan="12" id='login-details'>ACCEPTED LIST</td>
            </tr>
            <tr>
                <th>SL.NO</th>
                <th>NAME</th>
                <th>CONTACT</th>
                
                <th>EMAIL</th>
                
                <th>GENDER</th>
                
                <th>PHOTO</th>
                
                <th>PROOF</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "select * from tbl_nutrition where nutrition_status=1";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["nutrition_name"]; ?></td>
                    <td><?php echo $data["nutrition_contact"]; ?></td>
                    <td><?php echo $data["nutrition_email"]; ?></td>
                    <td  align='center'><?php echo $data["nutrition_gender"]; ?></td>
                    <td >
                        <img src="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>" width="200px"
                             class="modalImage"
                             data-image="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>"/>
                             <br>
                             <a href="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>" download
                                      
                                      class="DFG">Download</a>
                    </td>
                    <td ><img src="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>" width="200px"
                             class="modalImage"data-image="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>"/>
                            <br>
                        <a href="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>" download
                                      
                                      class="DFG">Download</a></td>
                    <td align="center">
                        <a href="NutritionistVerification.php?did=<?php echo $data["nutrition_id"] ?>"
                            class="RFG">REJECT</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <table align="center" width="100%" border="1">
            <tr>
                <td align="center" colspan="12" id='login-details'>REJECTED LIST</td>
            </tr>
            <tr>
                <th>SL.NO</th>
                <th>NAME</th>
                <th>CONTACT</th>
                
                <th>EMAIL</th>
                
                <th>GENDER</th>
                
                <th>PHOTO</th>
                
                <th>PROOF</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "select * from tbl_nutrition where nutrition_status=2";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["nutrition_name"]; ?></td>
                    <td><?php echo $data["nutrition_contact"]; ?></td>
                    <td ><?php echo $data["nutrition_email"]; ?></td>
                    <td  align='center'><?php echo $data["nutrition_gender"]; ?></td>
                    <td >
                        <img src="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>" width="200px"
                             class="modalImage"
                             data-image="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>"/>
                             <br>
                             <a href="../ASSETS/Files/Nutritionist/Photo/<?php echo $data['nutrition_photo'] ?>" download
                                      
                                      class="DFG">Download</a>
                    </td>
                    <td ><img src="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>" width="200px"
                             class="modalImage"data-image="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>"/>
                            <br>
                        <a href="../ASSETS/Files/Nutritionist/Proof/<?php echo $data['nutrition_proof'] ?>" download
                                      
                                      class="DFG">Download</a></td>
                    <td align="center">
                        <a href="NutritionistVerification.php?eid=<?php echo $data["nutrition_id"] ?>"
                            class="GFG">ACCEPT</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </form>
</div>

<!-- Modal structure... -->
<div id="photoModal" class="modal">
    <span class="close" id="closeModal">&times;</span>
    <img src="" alt="Nutrition Photo" id="modalContent">
</div>

<?php
ob_flush();

?>

<script>
    // JavaScript to handle the modal
    const modal = document.getElementById('photoModal');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    const modalImages = document.querySelectorAll('.modalImage');

    modalImages.forEach(image => {
        image.onclick = function() {
            modal.style.display = 'block';
            modalContent.src = this.getAttribute('data-image');
        }
    });

    closeModal.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
</body>
</html>
