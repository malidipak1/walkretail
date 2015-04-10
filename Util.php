<?php
include_once 'lib/config.php';
include_once 'DBUtil.php';
class Util {
	
	public static function uploadImage($fileName) {
		$image = "";
		if(!empty($_FILES[$fileName]["tmp_name"])) {
			$check = getimagesize($_FILES[$fileName]["tmp_name"]);
			if($check !== false) {
	
				$target_dir = UPLOAD_IMAGE_DIR;
				$image = date('Ymd_Hms') . "_" . basename($_FILES[$fileName]["name"]);
				$target_file = $target_dir . $image;
	
				if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $target_file)) {
					//echo "File is valid, and was successfully uploaded.\n";
				} else {
					// 		/echo "Possible file upload attack!\n";
					$image = "";
				}
				$uploadOk = true;
			} else {
				//echo "File is not an image.";
				$uploadOk = false;
			}
		}
		return $image;
	}
	
	public static function getMailHeader() {
		$headers = 'From: enquiry@walkretail.com' . "\r\n" .
		    'Reply-To: enquiry@walkretail.com' . "\r\n".
			"Content-Type: text/html; charset=ISO-8859-1\r\n" .
			"MIME-Version: 1.0\r\n" ;
			
		return $headers;
	}
	
	public static function readMailFile($type="buynow") {
		$filename = "";
		
		switch ($type) {
			case "buynow":
				$filename = FILEPATH ."buynow.txt";
				break;
			case "quote":
				$filename = FILEPATH ."quote.txt";
				break;
		}
		
		$file = fopen($filename, "r");
		$fileStr = "";
		while(!feof($file)) {
			$fileStr .= fgetc($file);
		}
		fclose($file);
		return $fileStr;
	}
	
	public static function enquiryMail ($type, $arrPost) {
		
		$strFile = Util::readMailFile($type);
		
		foreach ($arrPost as $key => $value) {
			$search = "{" . strtoupper ($key) . "}";
			$strFile = str_replace($search, $value, $strFile);
		}
		
		if("quote" == $type ) {
			$subject = "Want Quotation for - " . $arrPost['prod_name'];
		} else {
			$subject = "Want to Buy Product - " . $arrPost['prod_name'];
		}
		
		mail(MAILTO, $subject, $strFile, Util::getMailHeader());
	}
	
	
	public static function getImage($image) {
		$image = "/supplier/image/" . $image;
		return $image;	
	}
	
	public static function redirect($url, $admin = false) {
		$urlStr = "/";
		if($admin) {
			$urlStr .= "admin/";
		}
		
		header("Location: " . $urlStr . $url);
	}

	public static function getParentCategoryList() {
		$dbObj = new DBUtil();
		$param = array('parent_id' => 0);
		return $dbObj->getCategories($param);
	}
	
	public static function getSupplierName($supplier_id) {
		$dbObj = new DBUtil();
		$param = array('id' => $supplier_id);
		$arrSupplier = $dbObj->getSupplier($param);
		return $arrSupplier[0]['company'];
	}
	
	public static function getCategoryList() {
		$return_array = array();
		
		$dbObj = new DBUtil();
		$param = array('parent_id' => 0, 'status' => 1);
		$arrParent = $dbObj->getCategories($param);
	
		foreach ($arrParent as $parent) {
			$param = array('parent_id' => $parent['catid'], 'status' => 1);
			$arrChild = $dbObj->getCategories($param);
			
			foreach ($arrChild as $child) {
				$return_array[$parent['catname']][$child['catid']] =  $child['catname']; 
			}
		}
		//print_r($return_array);
		return $return_array;
	}
	
	
}

?>