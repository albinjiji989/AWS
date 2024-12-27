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

if(isset($_POST["place_submit"]))
{
    $place=$_POST["place_name"];
    $dis=$_POST["district"];
    $insQry="insert into tbl_place(place_name,district_id)value('".$place."','".$dis."')";
    $con->query($insQry); 
}
if(isset($_GET["did"]))
{
    $delqry="delete from tbl_place where place_id='".$_GET["did"]."'";
    $con->query($delqry);
    header("location:place.php");
}
?>
    <form method="post">
      <table border="1" align="center" width="15%">
        <tr>
          <td align="center" colspan="2">PLACE</td>
        </tr>
        <tr>
          <td>DISTRICT</td>
          <td width="300"><label for="district"></label>
        <select name="district" id="district">
        <option>---select---</option>
       <?php
        $selQry="select * from tbl_district";
        $row=$con->query($selQry);
        while($data=$row->fetch_assoc())
        {
        ?>  
        <option value="<?php echo $data["district_id"];?> "> <?php echo $data["district_name"];?> </option>
        <?php
        }
        ?>
      </select></td>
    </tr>
        <tr>
          <td>PLACE</td>
          <td><input type="text" name="place_name" id="place_name"  placeholder ="Enter Place" required/></td>
        </tr>
        <tr>
          <td align="center" colspan="2" id="submit"><input type="submit" name="place_submit" id="place_submit" value="Submit" />
          &nbsp;&nbsp;&nbsp;<input type="reset" name="place_cancel" id="place_cancel" value="Cancel" />
          </td>
        </tr>
      </table>
      <br>
      <table align="center" width="50%" height="134" border="1">
        <tr>
          <td>SL.NO</td>
          <td>District Name</td>
          <td>Place Name</td>
          <td>Action</td>
        </tr>
        <?php
        $i=0;
        $selQry="select * from tbl_place p inner join tbl_district d on d.district_id=p.district_id";
        $row=$con->query($selQry);
        while($data=$row->fetch_assoc())
        {
        $i++;
        ?>
        <tr>
          <td><?php echo $i;?></td>
          <td><?php echo $data["place_name"];?></td>
          <td><?php echo $data["district_name"];?></td>
          <td>
            <form method="get" action="place.php">
              <input type="hidden" name="did" value="<?php echo $data["place_id"];?>">
              <input type="submit" value="Delete">
            </form>
            <form method="get" action="edit_place.php">
              <input type="hidden" name="eid" value="<?php echo $data["place_id"];?>">
              <input type="submit" value="Edit">
            </form>
          </td>
        </tr>
        <?php
        }
        ?>
      </table>
    </form>
</body>
</html>
