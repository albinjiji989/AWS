<?php
ob_start();

include("../Assets/Connection/connection.php");

if(isset($_POST["user_submit"]))
{
	$email=$_POST["user_email"];
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
		  		window.location="userregistration.php";

          </script>
              <?php
	   }
	    else{
			
	
							$username=$_POST["user_name"];
							$contact=$_POST["user_contact"];
	
							$password=$_POST["user_password"];
							$cpassword=$_POST["user_cpassword"];
							$gender=$_POST["user_gender"];
							$address=$_POST["user_address"];
							$district=$_POST["txtdistrict"];
							$place=$_POST["txtplace"];
							$photo=$_FILES["user_photo"]["name"];
							$path=$_FILES["user_photo"]["tmp_name"];
							move_uploaded_file($path,"../ASSETS/Files/User/".$photo);
				
	if($password == $cpassword)
	{
	    $insQry="insert into tbl_user(user_name,user_email,user_password,user_gender,user_address,user_photo,place_id,user_contact,district_id) value('".$username."','".$email."','".$password."','".$gender."','".$address."','".$photo."','".$place."','".$contact."','".$district."')";
     	$con->query($insQry);
		?>
          <script>
          alert('registered, login now');
		  		window.location="login.php";

          </script>
              <?php
		
	} 
	
 }
     
} 

	

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER-REGISTRATION</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table align="center" border="1">
            <tr>
                <td colspan=2 align="center">USER-REGISTRATION</td>
            </tr>
            <tr>
                <td>NAME</td>
                <td><input type="text" id="user_name" name="user_name" placeholder="Enter Name" required></td>
            </tr>
            <tr>
                <td>CONTACT</td>
                <td><input type="number" id="user_contact" name="user_contact" placeholder="Enter Conatct Number" required></td>
            </tr>
            <tr>
                <td>EMAIL</td>
                <td><input type="email" id="user_email" name="user_email" placeholder="Enter Email Id" required></td>
            </tr>
            <tr>
                <td>GENDER</td>
                <td><input type="radio" name="user_gender" id="user_gender1" value="male" required />
                    <label for="user_gender1">&nbsp;MALE</label>
                    <br><input type="radio" name="user_gender" id="user_gender2" value="Female" required /> 
                    <label for="user_gender2">&nbsp;FEMALE</label></td>
            </tr>
            <tr>
                <td>ADDRESS</td>
                <td>
                    <textarea name="user_address" id="user_address"  placeholder="Enter Address" cols="45" rows="5"  required ></textarea></td>
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
                <td>PHOTO</td>
                <td><label for="user_photo"></label>
                    <input type="file" name="user_photo" id="user_photo" required></td>
            </tr>
            <tr>
                <td>PASSWORD</td>
                <td><input required type="password" name="user_password" id="user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="aA,0-9,symbol,Min 8 Char"/></td>
            </tr>
            <tr>
                <td>CONFIRM-PASSWORD</td>
                <td><input type="password" name="user_cpassword" id="user_cpassword" required /></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" name="user_submit" id="user_submit" value="Submit" />
                <input type="reset" name="user_cancel" id="user_cancel" value="cancel" /></td>
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