<?php 
include_once 'DBUtil.php';
include_once 'Util.php';
$dbObj = new DBUtil();
$arrResult = $dbObj->getAdsProductByPage('THANKS_PAGE');
?><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="middle"  align="center">
             <?php 
             $count=1;
             foreach ($arrResult as $result) {?>
              <td width="33%">
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top" align="center">
                <td><p>&nbsp;</p>
                <p><a href="product-discription.php?prod_id=<?php echo $result['prod_id']?>"><img src="<?php echo Util::getImage($result['image'])?>" width="170"  alt="" /></a></p></td>
              </tr>
             <tr valign="top" align="center">
                <td height="40" valign="middle" class="pro-head"><?php echo $result['prod_name']?></td>
              </tr>
              <tr valign="top" align="center">
                <td height="26" valign="middle" class="price1">Price : &#8377; <?php echo $result['min_price']?> - <?php echo $result['max_price']?></td>
              </tr>
             <tr valign="top" align="center">
                 <td valign="middle" class="g-text">Order Range : <?php echo $result['min_quantity']?> - <?php echo $result['max_quantity']?></td>
              </tr>
            </table>
            </td>
            <?php 
            if($count%5 == 0) {?>
            	 </tr><tr valign="middle"  align="center">
            <?php }
             $count++; 
            } ?>
          </tr>
          
         </table>