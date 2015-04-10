<script type="text/javascript">
function changeSelectOption(selobj, value) {
    var length = selobj.length;
    for(var i=0; i<length; i++) {
            if(selobj.options[i].value.toLowerCase()== value.toLowerCase()) {
                    selobj.selectedIndex = i;
            }
    }
}

    document.body.onload = function() {
        changeSelectOption(document.search.min, '<?php echo $_REQUEST['min']?>');
    	changeSelectOption(document.search.max, '<?php echo $_REQUEST['max']?>');
     }

  function val(form) {
	  var min = parseInt(form.min.value);
	  var max = parseInt(form.max.value);
	if(min >= max) {
		alert("Minimun Quantity should be less than Maximum Quantity");
		return false;
	}
	return true;
  }  
</script>

<form onsubmit="javascript: return val(this);" action="search-display-product.php" method="get" style="padding:0 0 10px 0; width:100%; float:left;" name="search">
          <div class="btn">Select Quantity</div>
         <div style="float:left;">
            <select name="min" class="sell5">      
                        <option value="">Min</option>
						 <option class="" value="0">1</option>
						 <option class="" value="11">11</option>
						 <option class="" value="21">21</option>
						 <option class="" value="51">51</option>
						 <option class="" value="101">101</option>
						 <option class="" value="1001">1001</option>
           </select>
          </div>
         <div style="float:left">
         <select name="max" class="sell5">                   
                          <option value="">Max</option>
						 <option class="" value="10">10</option>
						 <option class="" value="20">20</option>
						 <option class="" value="50">50</option>
						 <option class="" value="100">100</option>
						 <option class="" value="1000">1000</option>
						 <option class="" value="10000">10000</option>
                       
           </select></div>
        <div style="float:left">
        <input type="submit" value="." src="images/search.jpg" align="right" class="search-btn" />
  <input name="search" type="text" value=" <?php echo $_REQUEST['search']?>" class="search" placeholder="Search by Product Title" /></div>
          <div style="float:left"></div>
      </form> 