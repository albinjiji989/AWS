<?php
ob_start();

include("../Assets/Connection/connection.php");

if(isset($_POST["nutritionist_submit"]))
{
	$email=$_POST["nutritionist_email"];
	 $selUser="select * from tbl_user where user_email='".$email."'";
 	 $selNutri="select * from tbl_nutrition where nutrition_email='".$email."'";
     $selTrainer="select * from tbl_trainer where trainer_email='".$email."'";
     $dataUser=$con->query($selUser);
     $dataNutri=$con->query($selNutri);
  	 $dataTrainer=$con->query($selTrainer);
  				
	if(	$dataUser->num_rows>0 || $dataNutri->num_rows>0 || $dataTrainer->num_rows>0)
       {
		   ?>
          <script>
          alert('Email-id Already used');
		  		window.location="nutritionistregistration.php";

          </script>
              <?php
	   }
	    else{
			
	
							$username=$_POST["nutritionist_name"];
							$contact=$_POST["nutritionist_contact"];
	
							$password=$_POST["nutritionist_password"];
							$cpassword=$_POST["nutritionist_cpassword"];
							$gender=$_POST["nutritionist_gender"];
							$address=$_POST["nutritionist_address"];
							$district=$_POST["txtdistrict"];
							$place=$_POST["txtplace"];
							$photo=$_FILES["txtphoto"]["name"];
	                        $photopath=$_FILES["txtphoto"]["tmp_name"];
	                        $proof=$_FILES["txtproof"]["name"];
	                        $proofpath=$_FILES["txtproof"]["tmp_name"];
	                        move_uploaded_file($photopath,"../ASSETS/Files/Nutritionist/Photo/".$photo);
	                        move_uploaded_file($proofpath,"../ASSETS/Files/Nutritionist/Proof/".$proof);
				
	if($password == $cpassword)
	{
	    $insQry="insert into tbl_nutrition(nutrition_name,nutrition_email,nutrition_password,nutrition_gender,nutrition_address,nutrition_photo,nutrition_proof,place_id,nutrition_contact,district_id) value('".$username."','".$email."','".$password."','".$gender."','".$address."','".$photo."','".$proof."','".$place."','".$contact."','".$district."')";
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
		window.location="nutritionistregistration.php";
		</script>
        <?php
	
	}

	}
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUTRITIONIST-REGISTRATION</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table align="center" border="1">
            <tr>
                <td colspan=2 align="center">NUTRITIONIST-REGISTRATION</td>
            </tr>
            <tr>
                <td>NAME</td>
                <td><input type="text" id="nutritionist_name" name="nutritionist_name" placeholder="Enter Name" required></td>
            </tr>
            <tr>
                <td>CONTACT</td>
                <td><input type="number" id="nutritionist_contact" name="nutritionist_contact" placeholder="Enter Conatct Number" required></td>
            </tr>
            <tr>
                <td>EMAIL</td>
                <td><input type="email" id="nutritionist_email" name="nutritionist_email" placeholder="Enter Email Id" required></td>
            </tr>
            <tr>
                <td>GENDER</td>
                <td><input type="radio" name="nutritionist_gender" id="nutritionist_gender1" value="male" required />
                    <label for="nutritionist_gender1">&nbsp;MALE</label>
                    <br><input type="radio" name="nutritionist_gender" id="nutritionist_gender2" value="Female" required /> 
                    <label for="nutritionist_gender2">&nbsp;FEMALE</label></td>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <td>
                    <textarea name="nutritionist_address" id="nutritionist_address"  placeholder="Enter Address" cols="45" rows="5"  required ></textarea></td>
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
      <td  id='login'><br>Place</td>
      <td><label for="txtplace"></label>
        <select name="txtplace" id="txtplace">
        <option>----select----</option>
        
      </select></td>
    </tr>
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
                <td><input required type="password" name="nutritionist_password" id="nutritionist_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="aA,0-9,symbol,Min 8 Char"/></td>
            </tr>
            <tr>
                <td>CONFIRM-PASSWORD</td>
                <td><input type="password" name="nutritionist_cpassword" id="nutritionist_cpassword" required /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" name="nutritionist_submit" id="nutritionist_submit" value="Submit" />
                <input type="reset" name="nutritionist_cancel" id="nutritionist_cancel" value="cancel" /></td>
              </tr>
        </table>
    </form>
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
</body>
<?php

ob_flush();
?>
</html>