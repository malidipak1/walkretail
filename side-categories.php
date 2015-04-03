<?php
include_once 'Util.php';
$arrMenu = Util::getCategoryList();
//print_r($arrMenu);
?>


<div class="left-panel">
    
    
     <div id="cat-bg">Categories</div>
    <div class="demo-container clear">
<div class="test">

<ul id="mega-1" class="mega-menu">

<?php foreach($arrMenu as $parentMenu => $menu) {?>
  <li><a href="#"><?php echo $parentMenu;?> </a>
    <ul>
    <li>
      <ul>
      
   <?php foreach ($menu as $id =>$catName) {   ?>
      <li><a href="search-display-product.php?category=<?php echo $id;?>"><?php echo $catName;?></a></li>
	 <?php } ?> 
      </ul>
    </li>

	</ul>
 </li>
<?php } ?>
</ul>





</div>
</div>
    
    
    
    
    
    
    
     
      
    </div>