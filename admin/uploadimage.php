<?php
session_start ();
if (! isset ( $_SESSION ['login'] )) {
	header ( 'Location: index.php' );
	exit ();
}
include_once '../DBUtil.php';
include_once '../Util.php';

$message = "";
$dbObj = new DBUtil ();
if ($_POST) {
	$image = Util::uploadImage ( "image1" );
	$image1 = Util::uploadImage ( "image2" );
	$image2 = Util::uploadImage ( "image3" );
	$image3 = Util::uploadImage ( "image4" );
	$image4 = Util::uploadImage ( "image5" );
	
	if (! empty ( $_POST ['prod_id'] ) && $image != "") {
		$id = $dbObj->updateImage ( $image, $image1, $image2, $image3, $image4, $_POST ['prod_id'] );
		$message = "Images Uploaded Successfully!";
		$uri = "edit-product.php?prod_id=" . $_REQUEST ['prod_id'] . "&category=" . $_POST ['category'];
		// header("Location: $uri");
	}
}
?>
<html>
<body>
	<table width="100%" height="100%" align="center" cellpadding="0"
		cellspacing="0" bordercolor="#5181BF">
		<tr>
			<td height="92"><?php include('head.php');?></td>
		</tr>
		<tr>
			<td bordercolor="#FFFFFF" valign="top"><table width="100%"
					height="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>

						<td width="182" align="left" valign="top" bgcolor="#D6E7F6"
							class="red" style="padding: 0px; margin: 0px;"><?php include('left_mnu.php');?></td>
						<td width="100%" align="center" valign="top" bgcolor=""
							class="red"><table width="100%" border="0" align="center"
								cellpadding="0" cellspacing="0" bordercolor="#000000">
								<tr>
									<td valign="middle" height="20" align="left"><table width="767"
											border="0" cellspacing="0" cellpadding="0">
											<tr>

												<td width="399" height="57" class="head_ing">Add / Edit
													Product Images</td>
												<td width="368" align="right">&nbsp;</td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td bordercolor="#FFFFFF" valign="top" align="center"><table
											width="100%" border="0" cellspacing="4" cellpadding="0">
											<tr>
												<td align="center" class="red">
											
											</tr>
											<tr>
												<td align="center" valign="top">

													<form action="" enctype="multipart/form-data" method="post">
														<input type="hidden" name="prod_id"
															value="<?php echo $_REQUEST['prod_id']?>"> <input
															type="hidden" name="supplier_id"
															value="<?php echo $_REQUEST['supplier_id']?>">
														<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
													<?php if(isset($message)){?>
													 <tr align="center">
															<td height="25" colspan="2" align="center"> <?php echo $message;?></td>
													</tr>
														<?php }?>
 													<tr align="center" bgcolor="#7D4B00">
																<td height="25" colspan="2" align="center"
																	bgcolor="#3c7701">
																	<div class="white">Add / Edit Product Image</div>
																</td>
															</tr>
															<tr align="center" bgcolor="#FFFFFF">
																<td>
																	<div class="supplier-panel-bg1">
																		<div class="supplier-panel-left1">Image 1</div>
																		<div class="supplier-panel-right1">
																			<input type="file" name="image1">
																		</div>
																	</div>
																	<div class="supplier-panel-bg1">
																		<div class="supplier-panel-left1">Image 2</div>
																		<div class="supplier-panel-right1">
																			<input type="file" name="image2">
																		</div>
																	</div>
																	<div class="supplier-panel-bg1">
																		<div class="supplier-panel-left1">Image 3</div>
																		<div class="supplier-panel-right1">
																			<input type="file" name="image3">
																		</div>
																	</div>
																	<div class="supplier-panel-bg1">
																		<div class="supplier-panel-left1">Image 4</div>
																		<div class="supplier-panel-right1">
																			<input type="file" name="image4">
																		</div>
																	</div>
																	<div class="supplier-panel-bg1">
																		<div class="supplier-panel-left1">Images 5</div>
																		<div class="supplier-panel-right1">
																			<input type="file" name="image5">
																		</div>
																	</div>
																	</div> <br />
																<br />
																	</div>
																</td>
															</tr>
															<tr bgcolor="#7D4B00">
																<td height="33" colspan="5" align="center"
																	bgcolor="#3c7701"><input name="submit" type="submit"
																	value="Upload Image" /></td>
															</tr>
														</table>
													</form>
												</td>
											</tr>
										</table></td>
								</tr>
							</table></td>
					</tr>
				</table></td>
		</tr>
		<tr>
			<td bordercolor="#FFFFFF" valign="top" height="20"><?php include("footer.inc.php"); ?></td>
		</tr>
	</table>

</body>

</html>