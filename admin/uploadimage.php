<?php
session_start();
if(!isset($_SESSION['login']))
{
	header('Location: index.php');
	exit;
}
include_once '../DBUtil.php';
include_once '../Util.php';

$message = "";
$dbObj = new DBUtil();
if($_POST) {
	$image = Util::uploadImage("image1");
	$image1 = Util::uploadImage("image2");
	$image2 = Util::uploadImage("image3");
	$image3 = Util::uploadImage("image4");
	$image4 = Util::uploadImage("image5");
	
	if(!empty($_POST['prod_id']) && $image != "") {
		$id = $dbObj->updateImage($image, $image1, $image2, $image3, $image4, $_POST['prod_id']);
		$message = "Images Uploaded Successfully!";
		$uri = "edit-product.php?prod_id=" . $_REQUEST['prod_id'] . "&category=" . $_POST['category'];
		//header("Location: $uri");
	}
}

?>
<html>
<body>

<?php echo $message?>

<form action="" enctype="multipart/form-data" method="post">
<input type="hidden" name="prod_id" value="<?php echo $_REQUEST['prod_id']?>">
<input type="hidden" name="supplier_id" value="<?php echo $_REQUEST['supplier_id']?>">
<input type="file" name="image1">
<input type="file" name="image2">
<input type="file" name="image3">
<input type="file" name="image4">
<input type="file" name="image5">
<input type="submit" name="Upload Image">
</form>

</body>

</html>