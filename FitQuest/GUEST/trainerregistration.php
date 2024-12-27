
<?php
ob_start();

include("../ASSETS/Connection/connection.php");

if(isset($_POST["trainer_submit"]))
{
  $email=$_POST["trainer_email"];
  $selUser="select * from tbl_user where user_email='".$email."'";
  $selNutri="select * from tbl_nutrition where nutrition_email='".$email."'";
  $selTrainer="select * from tbl_trainer where trainer_email='".$email."'";
  $dataUser=$con->query($selUser);
  $dataNutri=$con->query($selNutri);
  $dataTrainer=$con->query($selTrainer);
  if( $dataUser->num_rows>0 || $dataNutri->num_rows>0 || $dataTrainer->num_rows>0)
  {
    ?>
    <script>
      alert('Email-id Already used');
	  		window.location="trainerRegistration.php";

    </script>
    <?php
  }
  else
  {
	
  $category=$_POST["trainer_category"];
	$tname=$_POST["trainer_name"];
	$contact=$_POST["trainer_contact"];
	$password=$_POST["trainer_password"];
	$cpassword=$_POST["trainer_cpassword"];
	$gender=$_POST["trainer_gender"];
	$address=$_POST["trainer_address"];
	$place=$_POST["txtplace"];
	$photo=$_FILES["txtphoto"]["name"];
	$photopath=$_FILES["txtphoto"]["tmp_name"];
	$proof=$_FILES["txtproof"]["name"];
	$proofpath=$_FILES["txtproof"]["tmp_name"];
	move_uploaded_file($photopath,"../ASSETS/Files/Trainer/Photo/".$photo);
	move_uploaded_file($proofpath,"../ASSETS/Files/Trainer/Proof/".$proof);
	
	
	if($password == $cpassword)
	{
	    $insQry="insert into tbl_trainer(trainer_name,trainer_contact,trainer_address,trainer_email,trainer_photo,trainer_proof,trainer_password,trainer_gender,place_id,trainer_category) value('".$tname."','".$contact."','".$address."','".$email."','".$photo."','".$proof."','".$password."','".$gender."','".$place."','".$category."')";
     	 if($con->query($insQry))
	{
		?>
        <script>
		alert("VERIFICATION PENDING (wait until admin verify you)");
		window.location="../GUEST/HomePage.html";
		</script>
        <?php
	}
	else{
		?>
        <script>
		alert("Failed");
		window.location="trainerregistration.php";
		</script>
        <?php
	
	}

	}
  }
} 
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TRAINER-REGISTRATION</title>

</head>

<body>
<br>

  
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table align="center" border="1">
            <tr>
                <td colspan=2 align="center">TRAINER-REGISTRATION</td>
            </tr>
            <tr>
                <td>NAME</td>
                <td><input type="text" id="trainer_name" name="trainer_name" placeholder="Enter Name" required></td>
            </tr>
            <tr>
                <td>CONTACT</td>
                <td><input type="number" id="trainer_contact" name="trainer_contact" placeholder="Enter Conatct Number" required></td>
            </tr>
            <tr>
                <td>EMAIL</td>
                <td><input type="email" id="trainer_email" name="trainer_email" placeholder="Enter Email Id" required></td>
            </tr>
            <tr>
                <td>GENDER</td>
                <td><input type="radio" name="trainer_gender" id="trainer_gender1" value="male" required />
                    <label for="trainer_gender1">&nbsp;MALE</label>
                    <br><input type="radio" name="trainer_gender" id="trainer_gender2" value="Female" required /> 
                    <label for="trainer_gender2">&nbsp;FEMALE</label></td>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <td>
                    <textarea name="trainer_address" id="trainer_address"  placeholder="Enter Address" cols="45" rows="5"  required ></textarea></td>
            </tr>
            <tr>
                <td>DISTRICT</td>
                <td><select name="txtdistrict" id="txtdistrict" onChange="getPlace(this.value)">
       <option>---district---</option>
       <?php
	
	   //$i=0;
	   	$selQry="select * from tbl_district";
	$row=$con->query($selQry);
	while($data=$row->fetch_assoc())
		{
			//$i++;
		?>	
        <option value="<?php echo $data["district_id"];?> "> <?php echo $data["district_name"        ];?> </option>
        <?php
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td ><br>Place</td>
      <td><label for="txtplace"></label>
        <select name="txtplace" id="txtplace">
        <option>----select----</option>
        
      </select></td>
    </tr>
            </tr>

            <tr>
    <td>Trainer Type</td>
    <td>
        <select name="trainer_category" id="trainer_category" required>
            <option value="">--- Select Trainer Type ---</option>
            <?php
            $selQry = "select * from tbl_category";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
            ?>
                <option value="<?php echo $data["category_id"]; ?>"> <?php echo $data["category_name"]; ?> </option>
            <?php
            }
            ?>
        </select>
    </td>
</tr>

    <tr>
      <td><br>Photo</td>
      <td>
      <br><input type="file" name="txtphoto" id="txtphoto" /></td>
    </tr>
    <tr>
      <td><br>Proof</td>
      <td>
      <br><input type="file" name="txtproof" id="txtproof" /></td>
    </tr>
            <tr>
                <td>PASSWORD</td>
                <td><input required type="password" name="trainer_password" id="trainer_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="aA,0-9,symbol,Min 8 Char"/></td>
            </tr>
            <tr>
                <td>CONFIRM-PASSWORD</td>
                <td><input type="password" name="trainer_cpassword" id="trainer_cpassword" required /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" name="trainer_submit" id="trainer_submit" value="Submit" />
                <input type="reset" name="trainer_cancel" id="trainer_cancel" value="cancel" /></td>
              </tr>
        </table>
</form>
  </div>

  </div>


</body>
<script src="../ASSETS/JQ/jQuery.js"></script>
<script>
  function getPlace(did){
	  $.ajax({
		  url:"../ASSETS/AjaxPages/AjaxPlace.php?did=" + did,
		  success:function(html){
			  $("#txtplace").html(html);
		  }
	  });
  }
  </script>
<?php

ob_flush();
?>
</html>
</html>

