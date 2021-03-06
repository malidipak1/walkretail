<?php
include_once 'lib/ini_settings.php';
include_once 'lib/config.php';
include_once ("lib/class.db.mysql.php");
include_once 'Util.php';

class DBUtil {
	private $dbConn;
	
	public $isPaging = false;
	public $pagingPerPage = 0;
	public $page = 0;
	public $lastPage = 0;
	public $totalRecords = 0;
	
	function DBUtil() {
		$this->dbConn = DbMysql::getConnection ();
	}
	
	public function getCount($query = '') {
		
		$pos = strpos($query, "FROM");
		
		if ($pos !== false) {
			$query = "SELECT count(1) as count " .  substr($query, $pos);
		}
		
		$stmt = $this->dbConn->query ( $query );
		$arrCount = $stmt->fetchAll ( PDO::FETCH_ASSOC);
		
		return $arrCount[0]['count'];
	}
	public function getAll($query = '') {
		if (empty ( $query )) {
			return;
		}
		
		if($this->isPaging) {
			if($this->pagingPerPage == 0) {
				$perPage = PER_PAGE;
			} else {
				$perPage = $this->pagingPerPage;
			}
			$totalCount = $this->getCount($query);
			$arrOffset = Util::getPagingOffset($perPage);
			$page = $arrOffset['page'];
			$offSet = $arrOffset['offset'];
				
			$recLeft = $totalCount - ($page * $perPage);
				
			//$arrReturn['total_count'] = $totalCount;
			//$arrReturn['page'] = $page;
			//$arrReturn['offset'] = $offSet;
			//$arrReturn['per_page'] = $perPage;
			//$arrReturn['record_left'] = $recLeft;
			//$arrReturn['first_page'] = 1;
			//$arrReturn['last_page'] = ceil($totalCount / $perPage);
			$this->totalRecords = $totalCount;
			$this->page = $page;
			$this->lastPage = ceil($totalCount / $perPage);
			
			$query .= " limit " . $offSet . ", " . $perPage;
		}

		$stmt = $this->dbConn->query ( $query );
		
		return Util::stripSlashes($stmt->fetchAll ( PDO::FETCH_ASSOC ));
	}
	public function getRow($query = '') {
		$result = $this->getAll ( $query );
		return $result [0];
	}
	public  function executeUpdate($sql, $data) {
		$stmt = $this->dbConn->prepare ( $sql );
		
		foreach ( $data as $key => $val ) {
			
			$stmt->bindValue ( $key, $val ); // should not use bindParam();
		}
		$flag = $stmt->execute ();
		
		if(substr ($sql, 0, 6) == 'INSERT') {
			return $this->dbConn->lastInsertId();
		}
		
		return $flag;
	}
	
	 function getWhereClause ($param = array()) {
		$whereClause = '';
	
		$flag = false;
		foreach ($param as $key => $value) {
			if($flag) {
				$whereClause .= " and " . $key . " = '" . addslashes($value) . "' " ;
			} else {
				$whereClause .= " " . $key . " = '" . addslashes($value) . "' " ;
				$flag = true;
			}
		}
	
		if ($whereClause == '') {
			$whereClause = " 1=1 ";
		}
	
		return $whereClause;
	}
	
	public function deletePremiumAds($id) {
		$arrData = array('id' => $id);
		$sql = "DELETE FROM `ads` WHERE id=:id";
		return $this->executeUpdate($sql, $arrData);
	}
	
	public function addStaticPage($pageId,$pageTitle,$desc,$pageCode) {
		$sql = "";
		if ($pageId == 0) {
			$sql = "INSERT INTO `static_page`(`page_id`, `page_title`, `page_description`, `page_code`) VALUES (:page_id,:page_title,:page_description,:page_code)";
		} else {
			$sql = "UPDATE `static_page` SET `page_title`=:page_title,`page_description`=:page_description
					WHERE `page_code`=:page_code AND `page_id`=:page_id";
		}
		$arrData = array (
				':page_id'  => $pageId,
				':page_title' => $pageTitle,
				':page_description' => $desc,
				':page_code' => $pageCode
		);
		return $this->executeUpdate($sql, $arrData);
	}
	
	public function getPremiumAds($ads_type='MAIN_ADS') {
		
		$arrParam = array('ads_type' => $ads_type);
		$sql = "SELECT * FROM `ads` WHERE " . $this->getWhereClause($arrParam) . " order by seq ";
		return $this->getAll($sql);
	}
	
	public function getPremiumAdsById($id) {
		
		$arrParam = array('id' => $id);
		$sql = "SELECT * FROM `ads` WHERE " . $this->getWhereClause($arrParam) . " order by seq ";
		return $this->getAll($sql);
	}
	public function addEditAds($image_name, $image_alt,$image_link,$ads_type='MAIN_ADS',$seq=0, $id=0) {
		
		if(empty($id)) {
			$sql = "INSERT INTO `ads`(`id`, `image_name`, `image_alt`, `image_link`, `ads_type`, `seq`) VALUES (:id, :image_name, :image_alt, :image_link, :ads_type,:seq)";
		} else {
			$sql = "UPDATE `ads` SET `image_name`=:image_name,`image_alt`=:image_alt,`image_link`=:image_link,`ads_type`=:ads_type, `seq`=:seq WHERE `id`=:id";
		}

		$arrData = array (
				':id' => $id,
				':image_name'  => $image_name,
				':image_alt' => $image_alt,
				':image_link' => $image_link,
				':ads_type' => $ads_type,
				':seq' => $seq
			);
		$this->executeUpdate($sql, $arrData);
	}
	
	
	public function getStaticPageByPage($pageTitle = 'ABOUT_US') {
	
		$arrParam = array('page_code' => $pageTitle);
	
		$sql = "select * from static_page where " . $this->getWhereClause($arrParam);
		return $this->getAll($sql);
	}
	
	public function getStaticPage($arrSearch = array()) {
	
		$sql = "SELECT * FROM static_page WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function deleteCategories($catId) {
		$sql = "DELETE FROM product_categories WHERE catid = :catid";
		$arrData = array ( ':catid'  => $catId );
		return $this->executeUpdate($sql, $arrData);
	}
	
	
	public function getCategories($arrSearch = array()) {
		$sql = "SELECT * FROM product_categories WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	
	public function getSupplierProd($supplier_id =0) {
		$sql = "SELECT category, count(prod_id) as count FROM `product` where supplier_id= " . $supplier_id . " group by category";
		
		$return_array = $this->getAll($sql);
		
		foreach ($return_array as $key => $result) {
			$arrSearch = array('catid' => $result['category']);
			 $catDetails = $this->getCategories($arrSearch);
			 $return_array[$key]['catname'] = $catDetails[0]['catname'];
		}
		return $return_array;
	}
	
	public function addAdsProduct($arrProdSeq, $pageTitle) {
		$arrData = array('adv_id' => $pageTitle);
		$sql = "DELETE FROM `walkreta_walk`.`advertise` WHERE adv_id=:adv_id";
		$this->executeUpdate($sql, $arrData);
		
		$sql = "INSERT INTO `walkreta_walk`.`advertise` (`prodid`, `adv_id`, `sequence`) VALUES (:prodid, :adv_id , :sequence)";
		foreach ($arrProdSeq as $prodId => $seq) {
			$arrData = array (
				':adv_id' => $pageTitle, 
				':prodid'  => $prodId,
				':sequence' => $seq
			);
			
			$this->executeUpdate($sql, $arrData);
		}
		return;
	}
	
	public function getAdsProductByPage($pageTitle = 'HOME_PAGE') {
		
		$arrParam = array('adv_id' => $pageTitle);
		
		$sql = "select * from product, advertise where prodid = prod_id and " . $this->getWhereClause($arrParam) ." order by sequence " ;
		return $this->getAll($sql);
	}
	
	public function getAds($arrSearch = array()) {
		
		$sql = "SELECT * FROM advertise WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function getProducts($arrSearch = array()) {
		//print_r($arrSearch);
		$sql = "SELECT * FROM product WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function getActiveProducts($arrSearch = array()) {
		
		$sql = "SELECT id, name, catid, catname, product.* FROM product,supplier,product_categories WHERE catid=category and id=supplier_id  " 
				. " and prod_status = 'Yes' and status=1 and cat_status = 1 and "	
				. $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function deleteProducts($prodId) {
		$sql = "DELETE FROM product WHERE prod_id = :prod_id";
		$arrData = array ( ':prod_id'  => $prodId );
		return $this->executeUpdate($sql, $arrData);
	}

	public function searchProductByName($prodName, $min = 0, $max = 0) {
		$sql = "select * from product, product_categories,supplier where catid=category and id=supplier_id and (prod_name like '%" . $prodName . "%' OR catname like '%" . $prodName . "%' )"
				. " and prod_status = 'Yes' and status=1 and cat_status = 1 ";
					
		if($min > 0 || $max > 0) {
			$sql .= " AND (min_quantity between $min and $max or max_quantity between $min and $max)";
		}
		return $this->getAll($sql);
	}	
		
	public function getProductList($prodName = '', $arrSearch = array(), $orderByKey = PRODTBL_DEFAULT_ORDER_KEY, $order = PRODTBL_DEFAULT_ORDER) {
		//print_r($arrSearch);
		$sql = "SELECT id, name, catid, catname, product.* FROM product,supplier,product_categories WHERE catid=category and id=supplier_id and " . $this->getWhereClause($arrSearch);

		if(!empty($prodName)) {
			$sql .= " and (prod_name like '%" . $prodName . "%' OR name like '%" . $prodName . "%' )";
		}
		
		$sql .= " order by $orderByKey $order";
	//echo $sql;	
		return $this->getAll($sql);
	}
	
	public function getProdList($prodName = '', $arrSearch = array()) {
		//print_r($arrSearch);
		$sql = "SELECT id, name, catid, catname, product.* FROM product,supplier,product_categories WHERE catid=category and id=supplier_id and " . $this->getWhereClause($arrSearch);
	
		if(!empty($prodName)) {
			$sql .= " and (prod_name like '%" . $prodName . "%' OR name like '%" . $prodName . "%' )";
		}
	
		return $this->getAll($sql);
	}
	
	public function deleteSupplier($id) {
	
		$sql = "delete from  `supplier` WHERE `id`=:id";
		$arrData = array ( ':id'  => $id );
		return $this->executeUpdate($sql, $arrData);
	}
	
	public function getSupplier($arrSearch = array()) {
		$sql = "SELECT * FROM supplier WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function getMenu($arrSearch = array()) {
		$sql = "SELECT * FROM product_categories WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function deleteMenu($catid=0) {
		$sql = "delete from  `product_categories` WHERE `catid`=:catid";
		
		$arrData = array ( ':catid'  => $catid );

		return $this->executeUpdate($sql, $arrData);
	}
	
	public function addMenu($catname,$parent_id=0,$status=1,$catid=0) {
		$sql = "";
		if ($catid == 0) {
			$sql = "INSERT INTO `product_categories`(`catid`, `parent_id`, `catname`, `cat_link`, `cat_status`) VALUES (:catid,:parent_id,:catname,:cat_link,:cat_status)";
		} else {
			$sql = "UPDATE `product_categories` SET `parent_id`=:parent_id,`catname`=:catname,`cat_link`=:cat_link,`cat_status`=:cat_status WHERE `catid`=:catid";
		}
		$arrData = array (
				':catid'  => $catid,
				':catname' => $catname,
				':parent_id' => $parent_id,
				':cat_link' => "",
				':cat_status' => $status
		);
		return $this->executeUpdate($sql, $arrData);
	}
	
	public function  addEditSupplier($id,$name,$user_name,$password,$status,$mobile,$email,$company,$address,$city,$state,$zipcode,$company_pan,$gumasta_lic,
			$registration_lic,$is_partner,$website, $logo, $company_type, $registration) {
		$sql = "";
		if ($id == 0) {
			$sql = "INSERT INTO `supplier`(`id`, `name`, `user_name`, `password`, `status`, `mobile`, `email`, `company`, `address`, `city`, `state`, `zipcode`,
					 `company_pan`, `gumasta_lic`, `registration_lic`, `is_partner`, `website`, `logo`,`company_type`, `registration`) VALUES (:id, :name, :user_name, :password, :status,
					 :mobile, :email, :company, :address, :city, :state, :zipcode, :company_pan, :gumasta_lic, :registration_lic, :is_partner, :website, 
					:logo, :company_type, :registration)";
		} else {
			$sql = "UPDATE `supplier` SET `name`=:name,`password`=:password,`status`=:status,`mobile`=:mobile,`company`=:company,`address`=:address,`email`=:email,
					`city`=:city,`state`=:state,`zipcode`=:zipcode,`company_pan`=:company_pan,`gumasta_lic`=:gumasta_lic,`registration_lic`=:registration_lic,
					`is_partner`=:is_partner,`website`=:website, `logo`=:logo, `company_type`=:company_type, `registration`=:registration  
					WHERE `id`=:id and `user_name`=:user_name ";
		}
		$arrData = array (
				':id'  => $id,
				':name'  => $name,
				':user_name'  => $user_name,
				':password'  => $password,
				':status'  => $status,
				':mobile'  => $mobile,
				':email'  => $email,
				':company'  => $company,
				':address'  => $address,
				':city'  => $city,
				':state'  => $state,
				':zipcode'  => $zipcode,
				':company_pan'  => $company_pan,
				':gumasta_lic'  => $gumasta_lic,
				':registration_lic'  => $registration_lic,
				':is_partner'  => $is_partner,
				':website'  => $website,
				':logo'  => $logo,
				':company_type' => $company_type,
				':registration' => $registration
				
		);
		return $this->executeUpdate($sql, $arrData);
	}
	
	public function getImages($prod_id) {
		$arrSearch = array('prod_id' => $prod_id);
		$sql = "SELECT * FROM product_image WHERE " . $this->getWhereClause($arrSearch);
		return $this->getRow($sql);
	}
	
	public function updateImage($image1, $image2,$image3,$image4,$image5, $prod_id) {
		$sql = "";
		
		$arrImage = $this->getImages($prod_id);
		if (count($arrImage) <= 0) {
			$sql = "INSERT INTO `product_image`(`prod_id`, `image5`,`image1`, `image2`, `image3`, `image4`) VALUES
					(:prod_id, :image5, :image1, :image2, :image3, :image4)";
		} else {
			$sql = "UPDATE `product_image` SET `image5`=:image5,`image1`=:image1,`image2`=:image2,`image3`=:image3,`image4`=:image4
					WHERE `prod_id`=:prod_id";
		}
		$arrData = array (
				':prod_id'	=> $prod_id ,
				':image5'	=> $image5,
				':image1'	=> $image1,
				':image2' 	=> 	$image2,
				':image3' 	=> 	$image3,
				':image4' 	=> 	$image4
		);
		
		return $this->executeUpdate($sql, $arrData);
	}
	
	public function updateProductImage($image,$prod_id) {
			$sql = "UPDATE `product` SET `image`=:image WHERE `prod_id`=:prod_id";
			$arrData = array (
				':prod_id'	 => $prod_id ,
				':image'	 => $image
			);
		return $this->executeUpdate($sql, $arrData);
	}
	public function addEditProduct($prod_name,$category,$desc,$TOS,$minPrice,$maxPrice,$min_quantity,$max_quantity,$prod_status,$supplier_id,
			$order_range, $supply_ability, $home_delivery,$quntity_type,$price_type='', $prod_id = 0) {
		$sql = "";
		if ($prod_id == 0) {
			$sql = "INSERT INTO `product`(`create_date`,`prod_id`, `prod_name`, `category`, `desc`, `TOS`, `min_price`,`max_price`, `min_quantity`,`max_quantity`, `prod_status`, `supplier_id`, `order_range`, `quntity_type`,`price_type`, `home_delivery`) VALUES 
					(NOW(),:prod_id, :prod_name, :category, :desc, :TOS, :min_price,:max_price, :min_quantity,:max_quantity, :prod_status, :supplier_id,  :order_range, :quntity_type,:price_type, :home_delivery)";
		} else {
			$sql = "UPDATE `product` SET `prod_name`=:prod_name, `category`=:category,`desc`=:desc,`TOS`=:TOS,`min_price`=:min_price,`max_price`=:max_price,`min_quantity`=:min_quantity, `max_quantity`=:max_quantity,
					`prod_status`=:prod_status,`supplier_id`=:supplier_id,`order_range`=:order_range, `quntity_type`=:quntity_type,`price_type`=:price_type, `home_delivery`=:home_delivery
					WHERE `prod_id`=:prod_id";
		}
		$arrData = array (
			':prod_id'	 => $prod_id ,
			':prod_name'	 => $prod_name,
			':category'	 => $category,
			':desc'	 => $desc,
			':TOS'	 => $TOS,
			':min_price'	 => $minPrice,
			':max_price'	 => $maxPrice,
			':min_quantity'	 => $min_quantity,
			':max_quantity' => $max_quantity,
			':prod_status' => $prod_status,
			':supplier_id'	 => $supplier_id,
			':order_range' => $order_range,
			':quntity_type' => $quntity_type,
			':price_type' => $price_type,
			':home_delivery' => $home_delivery
		);
		
		return $this->executeUpdate($sql, $arrData);
	}
}

?>