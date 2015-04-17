<?php if($nume >$limit){ ?>
	<tr align="center" bgcolor="#f5f5f5" valign="top">
	  <td  height="20" colspan="12" bgcolor="#ffffff">&nbsp;
	  <?php for($i=0; $i < $nume; $i=$i+$limit){	  
	  if($i == $eu){
	  $previous_button	=	$eu;
	    //$previous_button	= 	$previous_button-2;
	  	if($previous_button==0 ){
		  	$previous_button	=0;
	  	}
		
	  }
	  
	}?>
	 	<?php if(isset($previous_button) && $previous_button!='0'){ ?>
	    <a href="#" onClick="javascript:view_sub_category1('<?php echo $category_id;?>','0');" >&lt; &lt first</a>&nbsp;&nbsp;
		<a href="#" onClick="javascript:view_sub_category1('<?php echo $category_id;?>','<?php echo $previous_button-$limit;?>');">&lt;previous&nbsp;&nbsp;&nbsp;</a>
	   <?php }?>
	   
	      <?php $i=0;
		$l=1;
		for($i=0;$i < $nume;$i=$i+$limit){
			 if($i == $eu){
			  $next_button	=	$eu;
		  		//$previous_button	= 	$previous_button-2;
	  			if($next_button==$nume){
			  	$next_button	=$nume;
	  		}
		}
		//javascript:alert(\"ssssssssss\"); view_sub_category1(\"$category_id\",\"0\");
		if($i <> $eu){
		echo " <a href='#' onClick='view_sub_category1($category_id,$i);' ><font face='Verdana' size='2'>$l</font></a> | ";
		$last_page=$i;
		}
		else { echo "<font face='Verdana' size='4' color=red> $l </font>|";
		$next_button=$i;
		$last_page=$i;
		}        
		$l=$l+1;
		}?>
		<?php if(isset($next_button) && $next_button < $nume-$limit){ ?>
		 &nbsp;&nbsp;&nbsp; <a href="#" onClick="javascript:view_sub_category1('<?php echo $category_id;?>',<?php echo $next_button+$limit;?>);">next&gt;</a>&nbsp;&nbsp;
		 <a href="#" onClick="javascript:view_sub_category1('<?php echo $category_id;?>',<?php echo $last_page;?>);" >last &gt;&gt;</a></div></td>
		 <?php }?>
	  </tr>
	  <?php }?>