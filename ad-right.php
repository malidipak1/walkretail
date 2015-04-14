<?php 
include_once 'DBUtil.php';
$dbObj = new DBUtil();
$arrResult = $dbObj->getAdsProductByPage('SEARCH_PAGE');
?>
<div class="right-panel">
    <div class="side-ad">
      <ul>
      <?php  foreach ($arrResult as $result) { ?>
      <li class="border">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="v-height">
          <tr valign="middle">
            <td align="center"><a href="product-discription.php?prod_id=<?php echo $result['prod_id']?>"> <img src="<?php echo Util::getImage($result['image']);?>" width="170"  alt="" /></a></td>
          </tr>
          <tr valign="middle">
            <td align="center" class="pro-head"><?php echo $result['prod_name']?></td>
          </tr>
          <tr align="center" valign="top" class="prod-border">
            <td height="26" align="center" valign="middle" class="price1">Price : &#8377; <?php echo $result['min_price']?> - <?php echo $result['max_price']?></td>
          </tr>
          <tr valign="middle">
            <td align="center" class="g-text">Order Range : <?php echo $result['min_quantity']?> - <?php echo $result['max_quantity']?></td>
          </tr>
        </table>
      </li>
      <?php }?>
      </ul> 
    </div>   
 </div>