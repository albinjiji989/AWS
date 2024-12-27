<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category</title>
</head>
<body>

<?php
ob_start();
include("../ASSETS/Connection/connection.php");

if(isset($_POST["btnedit"]))
{
	
	$category=$_POST["txtcategory"];
	$photo=$_FILES["txtimage"]["name"];
	$photopath=$_FILES["txtimage"]["tmp_name"];
	move_uploaded_file($photopath,"../ASSETS/Files/Category/".$photo);
	$insQry="update tbl_category set category_name= '".$category."'";
	$con->query($insQry);
}
	if(isset($_GET["did"]))
{
	$delqry="delete from tbl_category where category_id='".$_GET["did"]."'";
	$con->query($delqry);
	header("location:Category.php");
}
?>

<div id="tab">
<form action="" method="post" enctype="multipart/form-data" name="form1">
  <table  border="1" align='center' >
    <tr>
      <td >Category</td>
      <td  ><input type="text" name="txtcategory" id="txtcategory" placeholder='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;category name' required></td>
    </tr>
    <tr>
      <td><br>Image</td>
      <td><br><input type="file" name="txtimage" id="txtimage"></td>
    </tr>
    <tr>
      <td colspan="2" align="center" id='submit'>
            <br><input type="submit" name="btnsubmit" id="btnsubmit" value="Submit"></td>
    </tr>
    
  </table>
  
  <p>&nbsp;</p>
  <table  border="1" align='center'>
    <tr>
      <th >SL.NO</th>
      <th >Category</th>
      <th >Image</th>
      <th></th>
      <th>&nbsp;Action</th>
    </tr>
    <tr>     <?php
	$i=0;
	$selQry="select * from tbl_category";
	$row=$con->query($selQry);
	while($data=$row->fetch_assoc())
	{
	$i++
	?>

    <tr>
    
      <td><?php echo $i;?></td>
      <td><?php echo $data["category_name"];?></td>
      <td colspan='2'>
  <img src="../ASSETS/Files/Category/<?php echo $data['image'] ?>" width="200px"  />
  </td>
    
      <td id="submit" align="center"><input type="submit" name="btnedit" id="btnedit" style="font-size: 20px;" value="Edit"><a href="update.php?did=<?php echo $data["category_id"]?>">Update</a></td>
    </tr>
    <?php
	}
	?>
  </table>
  <p>&nbsp;</p>
</form>
</div>
</body>
</html>
<?php
ob_flush();
?>