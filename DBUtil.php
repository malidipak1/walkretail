<?php
define ( "DB_HOST", 'localhost' );
define ( "DB_NAME", 'walkreta_walk' );
define ( 'DB_PASSWD', '' );
define ( 'DB_USER', 'root' );

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
	
	public function getProducts($arrSearch = array()) {
		$sql = "SELECT * FROM PRODUCT WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function getSupplier($arrSearch = array()) {
		$sql = "SELECT * FROM supplier WHERE " . $this->getWhereClause($arrSearch);
		return $this->getAll($sql);
	}
	
	public function  addEditSupplier($id,$name,$user_name,$password,$status,$mobile,$email,$company,$address,$city,$state,$zipcode,$category,$company_pan,$gumasta_lic,$registration_lic,$is_partner,$website) {
		$sql = "";
		if ($id == 0) {
			$sql = "INSERT INTO `supplier`(`id`, `name`, `user_name`, `password`, `status`, `mobile`, `email`, `company`, `address`, `city`, `state`, `zipcode`,
					 `category`, `company_pan`, `gumasta_lic`, `registration_lic`, `is_partner`, `website`) VALUES (:id, :name, :user_name, :password, :status,
					 :mobile, :email, :company, :address, :city, :state, :zipcode, :category, :company_pan, :gumasta_lic, :registration_lic, :is_partner, :website))";
		} else {
			$sql = "UPDATE `supplier` SET `name`=:name,`user_name`=:user_name,`password`=:password,`status`=:status,`mobile`=:mobile,`email`=:email,
				`company`=:company,`address`=:address,`city`=:city,`state`=:state,`zipcode`=:zipcode,`category`=:category,`company_pan`=:company_pan,
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
				':category'  => $category,
				':company_pan'  => $company_pan,
				':gumasta_lic'  => $gumasta_lic,
				':registration_lic'  => $registration_lic,
				':is_partner'  => $is_partner,
				':website'  => $website
		);
	
		return $this->executeUpdate($sql, $arrData);
		
	}
	
	public function addEditProduct($name, $desc, $manufacturer, $accessories, $price, $min_order_quant, $supply_ability, $stock, $home_delivery, $supplier_id, $image, $id = null) {
		$sql = "";
		if ($id == 0) {
			$sql = "INSERT INTO `product`(`prod_id`, `prod_name`, `desc`, `manufacture`, `accessories`, `price`, `min_order_quant`, `supply_ability`, `stock_availability`, 
					`home_delivery`, `supplier_id`, `image`) VALUES (:prod_id,:prod_name, :desc, :manufacture, :accessories, :price, :min_order_quant, 
					:supply_ability, :stock_availability, :home_delivery, :supplier_id, :image)";
		} else {
			$sql = "UPDATE `product` SET `prod_name`=:prod_name,`desc`=:desc,`manufacture`=:manufacture,`accessories`=:accessories,`price`=:price,
					`min_order_quant`=:min_order_quant,`supply_ability`=:supply_ability,`stock_availability`=:stock_availability,`home_delivery`=:home_delivery,
					`supplier_id`=:supplier_id,`image`=:image WHERE `prod_id`=:prod_id";
		}
		$arrData = array (
				':prod_id' => $id,
				':prod_name' => $name,
				':desc' => $desc,
				':manufacture' => $manufacturer,
				':accessories' => $accessories,
				':price' => $price,
				':min_order_quant' => $min_order_quant,
				':supply_ability' => $supply_ability,
				':stock_availability' => $stock,
				':home_delivery' => $home_delivery,
				':supplier_id' => $supplier_id,
				':image' => $image 
		);
		
		//print_r($arrData);
		return $this->executeUpdate($sql, $arrData);
	}
}

?>