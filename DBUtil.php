<?php

include_once 'lib/config.php';
include ("lib/class.db.mysql.php");
class DBUtil {
	private $dbConn;
	
	function DBUtil() {
		$this->dbConn = DbMysql::getConnection ();
	}
	
	public function getAll($query = '') {
		if (empty ( $query )) {
			return;
		}
		$stmt = $this->dbConn->query ( $query );
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	public function getRow($query = '') {
		$result = DBUtil::getAll ( $query );
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
				$whereClause .= " and " . $key . " = '" . $value . "' " ;
			} else {
				$whereClause .= " " . $key . " = '" . $value . "' " ;
				$flag = true;
			}
		}
	
		if ($whereClause == '') {
			$whereClause = " 1=1 ";
		}
	
		return $whereClause;
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
	
	
	public function getProducts($arrSearch = array()) {
		//print_r($arrSearch);
		$sql = "SELECT * FROM product WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}

	
	public function searchProductByName($prodName, $min = 0, $max = 0) {
		$sql = "select * from product where 1=1 and prod_name like '%" . $prodName . "%' ";
				
		if($min > 0 || $max > 0) {
			$sql .= " AND (min_quantity between $min and $max or max_quantity between $min and $max)";
		}
		return $this->getAll($sql);
	}	
		
	public function getSupplier($arrSearch = array()) {
		$sql = "SELECT * FROM supplier WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function getMenu($arrSearch = array()) {
		$sql = "SELECT * FROM product_categories WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	public function addMenu($catname,$parent_id=0,$status=1,$catid=0) {
		$sql = "";
		if ($catid == 0) {
			$sql = "INSERT INTO `product_categories`(`catid`, `parent_id`, `catname`, `cat_link`, `status`) VALUES (:catid,:parent_id,:catname,:cat_link,:status)";
		} else {
			$sql = "UPDATE `product_categories` SET `parent_id`=:parent_id,`catname`=:catname,`cat_link`=:cat_link,`status`=:status WHERE `catid`=:catid";
		}
		$arrData = array (
				':catid'  => $catid,
				':catname' => $catname,
				':parent_id' => $parent_id,
				':cat_link' => "",
				':status' => $status
		);
		return $this->executeUpdate($sql, $arrData);
	}
	
	public function  addEditSupplier($id,$name,$user_name,$password,$status,$mobile,$email,$company,$address,$city,$state,$zipcode,$company_pan,$gumasta_lic,$registration_lic,$is_partner,$website) {
		$sql = "";
		if ($id == 0) {
			$sql = "INSERT INTO `supplier`(`id`, `name`, `user_name`, `password`, `status`, `mobile`, `email`, `company`, `address`, `city`, `state`, `zipcode`,
					 `company_pan`, `gumasta_lic`, `registration_lic`, `is_partner`, `website`) VALUES (:id, :name, :user_name, :password, :status,
					 :mobile, :email, :company, :address, :city, :state, :zipcode, :company_pan, :gumasta_lic, :registration_lic, :is_partner, :website)";
		} else {
			$sql = "UPDATE `supplier` SET `name`=:name,`user_name`=:user_name,`password`=:password,`status`=:status,`mobile`=:mobile,`email`=:email,
				`company`=:company,`address`=:address,`city`=:city,`state`=:state,`zipcode`=:zipcode,`company_pan`=:company_pan,
				`gumasta_lic`=:gumasta_lic,`registration_lic`=:registration_lic,`is_partner`=:is_partner,`website`=:website WHERE `id`=:id";
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
				':website'  => $website
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
	public function addEditProduct($prod_name,$category,$desc,$TOS,$minPrice,$maxPrice,$min_quantity,$max_quantity,$stock_availability,$supplier_id,
			$order_range, $supply_ability, $home_delivery,$quntity_type, $prod_id = 0) {
		$sql = "";
		if ($prod_id == 0) {
			$sql = "INSERT INTO `product`(`prod_id`, `prod_name`, `category`, `desc`, `TOS`, `min_price`,`max_price`, `min_quantity`,`max_quantity`, `stock_availability`, `supplier_id`, `order_range`, `quntity_type`, `home_delivery`) VALUES 
					(:prod_id, :prod_name, :category, :desc, :TOS, :min_price,:max_price, :min_quantity,:max_quantity, :stock_availability, :supplier_id,  :order_range, :quntity_type, :home_delivery)";
		} else {
			$sql = "UPDATE `product` SET `prod_name`=:prod_name, `category`=:category,`desc`=:desc,`TOS`=:TOS,`min_price`=:min_price,`max_price`=:max_price,`min_quantity`=:min_quantity, `max_quantity`=:max_quantity,
					`stock_availability`=:stock_availability,`supplier_id`=:supplier_id,`order_range`=:order_range, `quntity_type`=:quntity_type,`home_delivery`=:home_delivery
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
			':stock_availability' => $stock_availability,
			':supplier_id'	 => $supplier_id,
			':order_range' => $order_range,
			':quntity_type' => $quntity_type,
			':home_delivery' => $home_delivery
		);
		
		return $this->executeUpdate($sql, $arrData);
	}
}

?>