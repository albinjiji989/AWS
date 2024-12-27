<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
ob_start();

include("../ASSETS/Connection/connection.php");
$dis="";
$disid="";

if(isset($_POST["district_submit"]))
{
	
	$district=$_POST["district_name"];
	$hid=$_POST["txthid"];
	if($hid!="")
			{
				$update="update tbl_district set district_name='".$district."' where district_id='".$hid."'";
				$con->query($update);
				header("location:district.php");
			}
			else{
	              $insQry="insert into tbl_district(district_name)value('".$district."')";
	             $con->query($insQry); 
			}
  
	
}
if(isset($_GET["eid"]))
 {
	 $selq="select * from tbl_district where district_id='".$_GET["eid"]."'";
	 $res=$con->query($selq);
	 $result=$res->fetch_assoc();
	 $dis=$result["district_name"];
	 $disid=$result["district_id"];
 }

 if (isset($_GET["did"])) {
  $deleteId = $_GET["did"];
  $delQry = "DELETE FROM tbl_district WHERE district_id='$deleteId'";
  if ($con->query($delQry)) {
      header("location:district.php");
  } else {
      echo "<p>Error deleting record: " . $con->error . "</p>";
  }
}

?>
    <form id="district_form" name="district_form" method="post" action="">
      <table border="1" align="center" width="15%">
        <tr>
          <td align="center" colspan="2">DISTRICT</td>
        </tr>
        <tr>
          <td>DISTRICT</td>
          <td>
            <input type="text" name="district_name" id="district_name"  placeholder ="Enter District" value="<?php echo $dis ?>" required/>
            <input type="hidden" name="txthid" value="<?php echo $disid ?>"/>
          </td>
        </tr>
        <tr>
          <td align="center" colspan="2" id="submit"><input type="submit" name="district_submit" id="district_submit" value="Submit" />
          &nbsp;&nbsp;&nbsp;<input type="reset" name="district_cancel" id="district_cancel" value="Cancel" />
       
          </td>
        </tr>
      </table>
      <br>


      
      <table align="center" width="20%" height="134" border="1">
        <tr>
          <td>SL.NO</td>
          <td>District Name</td>
          <td>Action</td>
        </tr>
        <?php
	$i=0;
	$selQry="select * from tbl_district";
	$row=$con->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
    ?>
     <tr>
      <td  align='center'><?php  echo $i; ?></td>
      <td  align='center'><?php  echo $data["district_name"]; ?></td>
      <td align='center'>
      <a href="district.php?eid=<?php echo $data["district_id"]?>">Edit</a>
      <a href="district.php?did=<?php echo $data["district_id"]?>">Delete</a>
      </td>
    </tr>
    <?php
	}
	?>
      </table>
    </form>
</body>
</html>