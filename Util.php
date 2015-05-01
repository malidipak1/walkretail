<?php
include_once 'lib/config.php';
include_once 'DBUtil.php';
class Util {
	
	public static function getAdsImage($image) {
		$image = DOWNLOAD_IMAGE_ADS . $image;
		return $image;
	}
	
	
	public static function uploadImage($fileName, $ads=false) {
		$image = "";
		if(!empty($_FILES[$fileName]["tmp_name"])) {
			$check = getimagesize($_FILES[$fileName]["tmp_name"]);			
			if($check !== false) {
	
				$image = date('Ymd_Hms') . "_" . basename($_FILES[$fileName]["name"]);
				
				if($ads) {
					$target_file = UPLOAD_IMAGE_ADS . $image;
				} else {
					$target_file = UPLOAD_IMAGE_DIR . $image;	
				}
				
				if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $target_file)) {
					//echo "File is valid, and was successfully uploaded.\n";
					//echo " image moved....";
				} else {
					// 		/echo "Possible file upload attack!\n";
					$image = "";
					//echo "here..";
				}
				$uploadOk = true;
			} else {
				//echo "File is not an image.";
				$uploadOk = false;
			}
		}
		return $image;
	}
	
	public static function uploadDocument($fileName) {
		$docName = "";
		if(!empty($_FILES[$fileName]["tmp_name"])) {
			$docName = date('Ymd_Hms') . "_" . basename($_FILES[$fileName]["name"]);
			$target_file = UPLOAD_DOCS_DIR . $docName;
			if (!move_uploaded_file($_FILES[$fileName]['tmp_name'], $target_file)) {
				$docName = "";
			}
		}
		return $docName;
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
		if(!empty($arrPost['category']))
			$category = implode(",", $arrPost['category']);
		
		$strFile = Util::readMailFile($type);
		
		foreach ($arrPost as $key => $value) {
			$search = "{" . strtoupper ($key) . "}";
			
			if($key == 'category') {
				$strFile = str_replace($search, $category, $strFile);
			} else {
				$strFile = str_replace($search, $value, $strFile);
			}
		}
		
		if("quote" == $type ) {
			$subject = "Want Quotation for - " . $arrPost['prod_name'];
		} else {
			$subject = "Want to Buy Product - " . $arrPost['prod_name'];
		}
		
		self::sendMail(MAILTO, $subject, $strFile, Util::getMailHeader());
	}
	
	
	public static function sendMail ($to, $subject, $body, $header = '') {
		if(empty($header)) {
			$header = Util::getMailHeader();
		}
		
		mail($to, $subject, $body, $header);
	}
	
	public static function getImage($image) {
		$image = DOWNLOAD_IMAGE_DIR . $image;
		return $image;	
	}

	public static function sendNotification($type, $arrParam) {
		$subject = "";
		switch ($type) {
			case 'NEW_PRODUCT' : 
				$subject = "New Product Added by " . Util::getSupplierName($arrParam['supplier_id']);
				$body = "New Product Added by " . Util::getSupplierName($arrParam['supplier_id']);
				$body .= "<br> Product Name: " . $arrParam['prod_name'];
				break;
		}
		
		self::sendMail(MAILTO, $subject, $body);
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
	
	public static function getCategoryName($catid) {
		$dbObj = new DBUtil();
		$param = array('catid' => $catid);
		$arrCat = $dbObj->getCategories($param);
		return $arrCat[0]['catname'];
	}
	
	public static function getCategoryList() {
		$return_array = array();
		
		$dbObj = new DBUtil();
		$param = array('parent_id' => 0, 'cat_status' => 1);
		$arrParent = $dbObj->getCategories($param);
	
		foreach ($arrParent as $parent) {
			$param = array('parent_id' => $parent['catid'], 'cat_status' => 1);
			$arrChild = $dbObj->getCategories($param);
			
			foreach ($arrChild as $child) {
				$return_array[$parent['catname']][$child['catid']] =  $child['catname']; 
			}
		}
		//print_r($return_array);
		return $return_array;
	}
	
	static function getUrl($skipKey){
		$pagingUrl = $_SERVER['PHP_SELF'] . "?&";
		foreach ($_GET as $key => $val) {
			if($key != $skipKey)
				$pagingUrl .= $key . "=" . $val . "&";
		}
		return $pagingUrl;
	}

	static function getPagination ($page, $lastPage = 1) {
		$paginationDisplay = "";
		
		/* $pagingUrl = $_SERVER['PHP_SELF'] . "?&";
		foreach ($_GET as $key => $val) {
			if($key != "page")
				$pagingUrl .= $key . "=" . $val . "&";
		} */
		$pagingUrl = self::getUrl('page'); 
		
		if($lastPage > 1) {
	
			$centerPages = "";
			$sub1 = $page - 1;
			$sub2 = $page - 2;
			$add1 = $page + 1;
			$add2 = $page + 2;
	
			if ($page == 1) {
				$centerPages .= '&nbsp; <div class="page active">&nbsp;' . $page . '&nbsp;</div> &nbsp;';
				$centerPages .= '&nbsp; <a  class="page" href="' .$pagingUrl . 'page=' . $add1 . '">&nbsp;' . $add1 . '&nbsp;</a> &nbsp;';
			} else if ($page == $lastPage) {
				$centerPages .= '&nbsp; <a  class="page" href="' .$pagingUrl . 'page=' . $sub1 . '">&nbsp;' . $sub1 . '&nbsp;</a> &nbsp;';
				$centerPages .= '&nbsp; <div class="page active">&nbsp;' . $page . '&nbsp;</div> &nbsp;';
			} else if ($page > 2 && $page < ($lastPage - 1)) {
				$centerPages .= '&nbsp; <a  class="page" href="' .$pagingUrl . 'page=' . $sub2 . '">&nbsp;' . $sub2 . '&nbsp;</a> &nbsp;';
				$centerPages .= '&nbsp; <a  class="page" href="' .$pagingUrl . 'page=' . $sub1 . '">&nbsp;' . $sub1 . '&nbsp;</a> &nbsp;';
				$centerPages .= '&nbsp; <div class="page active">&nbsp;' . $page . '&nbsp;</div> &nbsp;';
				$centerPages .= '&nbsp; <a  class="page" href="' .$pagingUrl . 'page=' . $add1 . '">&nbsp;' . $add1 . '&nbsp;</a> &nbsp;';
				$centerPages .= '&nbsp; <a class="page" href="' .$pagingUrl . 'page=' . $add2 . '">&nbsp;' . $add2 . '&nbsp;</a> &nbsp;';
			} else if ($page > 1 && $page < $lastPage) {
				$centerPages .= '&nbsp; <a class="page" href="' .$pagingUrl . 'page=' . $sub1 . '">&nbsp;' . $sub1 . '&nbsp;</a> &nbsp;';
				$centerPages .= '&nbsp; <div class="page active">&nbsp;' . $page . '&nbsp;</div> &nbsp;';
				$centerPages .= '&nbsp; <a class="page" href="' .$pagingUrl . 'page=' . $add1 . '">&nbsp;' . $add1 . '&nbsp;</a> &nbsp;';
			}
	
			$paginationDisplay = 'Page <strong>' . $page . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
	
			if($page != 1) {
				$previous = 1;//$page - 1;
				$paginationDisplay .= '<a class="page" href="' .$pagingUrl . 'page=' . $previous . '">&nbsp;first&nbsp;</a>';
			}
			$paginationDisplay .=  $centerPages ;
			if ($page != $lastPage) {
				//$nextPage = $page + 1;
				$paginationDisplay .= '<a class="page" href="'. $pagingUrl . 'page=' . $lastPage . '">&nbsp;last&nbsp;</a>';
			}
		}
		return $paginationDisplay;
	}
	
	public static function getPagingOffset($perPage ) {
		$arrResult = array();
	
		if (isset($_GET['page'])) {
			$page = preg_replace('#[^0-9]#i', '', $_GET['page']); // filter everything but numbers for security(new)
		} else { // If the pn URL variable is not present force it to be value of page number 1
			$page = 1;
		}
	
		$offset = $perPage * ($page-1) ;
		$arrResult['page'] = $page;
		$arrResult['offset'] = $offset;
		return $arrResult;
	}
	
	public static function validateSize() {
		$flag = true;
		
		$max_allowed_file_size = 2048; // size in KB
		
		if($size_of_uploaded_file > $max_allowed_file_size ) {
			$flag = false;
			//$errors .= "\n Size of file should be less than $max_allowed_file_size";
		}
		
		return $flag;
	}
	public static function validateFormat() {
	
		$allowed_extensions = array("jpg", "jpeg", "gif", "bmp");
	
		//------ Validate the file extension -----
		$allowed_ext = false;
		for($i=0; $i<sizeof($allowed_extensions); $i++) {
			if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0) {
				$allowed_ext = true;
			}
		}
		return $allowed_ext;
	}
	
	
}

?>