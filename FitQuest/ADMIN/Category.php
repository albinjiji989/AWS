<?php
ob_start();
include("../ASSETS/Connection/connection.php");

// Insert a new category
if (isset($_POST["btnsubmit"])) {
    $category = $_POST["txtcategory"];
    $photo = $_FILES["txtimage"]["name"];
    $photopath = $_FILES["txtimage"]["tmp_name"];

    // Upload the image file
    if (!empty($photo)) {
        move_uploaded_file($photopath, "../ASSETS/Files/Category/" . $photo);
    }

    // Insert query
    $insQry = "INSERT INTO tbl_category (category_name, image) VALUES ('$category', '$photo')";
    $con->query($insQry);
}

// Delete a category
if (isset($_GET["did"])) {
    // Delete the image file
    $getImgQry = "SELECT image FROM tbl_category WHERE category_id = '" . $_GET["did"] . "'";
    $result = $con->query($getImgQry);
    if ($result->num_rows > 0) {
        $imgData = $result->fetch_assoc();
        $imagePath = "../ASSETS/Files/Category/" . $imgData['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image file
        }
    }

    // Delete query
    $delqry = "DELETE FROM tbl_category WHERE category_id = '" . $_GET["did"] . "'";
    $con->query($delqry);
    header("location:Category.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Category</title>
</head>
<body>
<div id="tab">
    <form action="" method="post" enctype="multipart/form-data" name="form1">
        <table border="1" align="center">
            <tr>
                <td>Category</td>
                <td><input type="text" name="txtcategory" id="txtcategory" placeholder="Category Name" required></td>
            </tr>
            <tr>
                <td>Image</td>
                <td><input type="file" name="txtimage" id="txtimage" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit">
                </td>
            </tr>
        </table>

        <table border="1" align="center">
            <tr>
                <th>SL.NO</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_category";
            $row = $con->query($selQry);
            while ($data = $row->fetch_assoc()) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["category_name"]; ?></td>
                    <td>
                        <img src="../ASSETS/Files/Category/<?php echo $data['image']; ?>" width="200px" />
                    </td>
                    <td>
                        <a href="Category.php?did=<?php echo $data["category_id"]; ?>">Delete</a> |
                        <a href="update.php?did=<?php echo $data["category_id"]; ?>">Update</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </form>
</div>
</body>
</html>

<?php
ob_end_flush();
?>
